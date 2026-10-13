<?php

/**
 * Author: Oscar Ruben Martinez Sanchez
 * (c) 2026 - Personal Project
 * Identity: @signature orms-kermint-2000
 */

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

/**
 * Componente Livewire principal para la interfaz de Chat de TheoLogic AI.
 *
 * Gestiona el envio de prompts y la persistencia de chats/favoritos por usuario localmente.
 * Próximamente se conectará por HTTP a RAGains Core para resolver el contenido.
 */
class RagChat extends Component
{
    public string $prompt = '';
    public array $messages = [];
    public ?int $activeChatId = null;
    public string $searchChat = '';
    public array $promptStarters = [
        "¿Cuáles son los dogmas principales?",
        "Explica el concepto de la Trinidad",
    ];
    public array $frontConfig = ['name' => 'TheoLogic AI'];

    public function mount()
    {
        $this->initGreeting();
    }

    private function initGreeting()
    {
        $this->messages = [
            [
                'role' => 'assistant',
                'content' => "¡Hola! Estoy listo para ayudarte a consultar la biblioteca de TheoLogic AI. ¿Qué deseas saber?",
                'sources' => []
            ]
        ];
    }

    public function getChatsProperty()
    {
        return Chat::where('user_id', Auth::id())
            ->when($this->searchChat, function ($q) {
                $q->where('title', 'like', '%' . $this->searchChat . '%');
            })
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->get();
    }

    public function selectChat($chatId)
    {
        $this->activeChatId = $chatId;
        $chat = Chat::with('messages')->findOrFail($chatId);
        
        if ($chat->user_id !== Auth::id()) abort(403);

        $this->messages = $chat->messages->map(function ($msg) {
            return [
                'role' => $msg->role,
                'content' => $msg->content,
                'sources' => $msg->sources ?? []
            ];
        })->toArray();
    }

    public function startNewChat()
    {
        $this->activeChatId = null;
        $this->initGreeting();
    }

    public function togglePinChat($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        if ($chat->user_id !== Auth::id()) abort(403);
        $chat->is_pinned = !$chat->is_pinned;
        $chat->save();
    }

    public function deleteChat($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        if ($chat->user_id !== Auth::id()) abort(403);
        
        $chat->messages()->delete();
        $chat->delete();

        if ($this->activeChatId == $chatId) {
            $this->startNewChat();
        }
    }

    public function exportToMarkdown($messageIndex)
    {
        if (!isset($this->messages[$messageIndex])) return;
        
        $message = $this->messages[$messageIndex];
        $content = $message['content'];
        $title = "Exportación_" . date('Y-m-d_H-i-s');
        
        $markdown = "# {$title}\n\n" . $content;
        
        return response()->streamDownload(function () use ($markdown) {
            echo $markdown;
        }, "{$title}.md", [
            'Content-Type' => 'text/markdown',
        ]);
    }

    public function sendMessage()
    {
        $question = trim($this->prompt);
        if (empty($question)) return;

        if (!$this->activeChatId) {
            $chat = Chat::create([
                'user_id' => Auth::id(),
                'title' => substr($question, 0, 40) . (strlen($question) > 40 ? '...' : '')
            ]);
            $this->activeChatId = $chat->id;
            
            ChatMessage::create([
                'chat_id' => $chat->id,
                'role' => 'assistant',
                'content' => $this->messages[0]['content'],
                'sources' => []
            ]);
        }

        $this->messages[] = ['role' => 'user', 'content' => $question, 'sources' => []];
        ChatMessage::create([
            'chat_id' => $this->activeChatId,
            'role' => 'user',
            'content' => $question,
            'sources' => []
        ]);
        
        $this->prompt = '';
        
        try {
            $apiUrl = env('RAGAINS_API_URL', 'http://127.0.0.1:8000');
            $apiKey = env('RAGAINS_API_KEY', 'rag_tenant_theologic_ai_live_key_2026');

            $httpResponse = Http::timeout(60)
                ->withHeaders([
                    'X-Tenant-Key' => $apiKey,
                    'Accept' => 'application/json',
                ])
                ->post("{$apiUrl}/api/v1/chat", [
                    'message' => $question,
                    'session_id' => 'chat_' . $this->activeChatId,
                ]);

            if ($httpResponse->successful()) {
                $data = $httpResponse->json();
                $response = $data['response'] ?? 'Sin respuesta disponible.';
                $sources = $data['sources'] ?? [];
            } else {
                $err = $httpResponse->json('error') ?? 'Error en la respuesta del motor RAGains.';
                $response = "⚠️ Error de comunicación con RAGains Core: {$err}";
                $sources = [];
            }

            $this->messages[] = ['role' => 'assistant', 'content' => $response, 'sources' => $sources];
            ChatMessage::create([
                'chat_id' => $this->activeChatId,
                'role' => 'assistant',
                'content' => $response,
                'sources' => $sources
            ]);

        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Error conectando con RAGains Core: " . $e->getMessage());
            $this->messages[] = [
                'role' => 'assistant', 
                'content' => 'Error de conexión con el motor RAGains Core (' . $e->getMessage() . '). Por favor verifica que el servidor esté activo.', 
                'sources' => []
            ];
        }
    }

    public function setPromptAndSend(string $text)
    {
        $this->prompt = $text;
        $this->sendMessage();
    }

    public function render()
    {
        return view('livewire.rag-chat')->layout('layouts.chat')->title('TheoLogic AI');
    }
}
/* _ñacañacaStatus: active */
