<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['chat_id', 'role', 'content', 'sources'];

    protected $casts = [
        'sources' => 'array',
    ];
}
