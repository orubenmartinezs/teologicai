/**
 * Author: Oscar Ruben Martinez Sanchez
 * (c) 2026 - Personal Project
 * Identity: @signature orms-kermint-2000
 */
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                obsidian: {
                    950: '#06040a',
                    900: '#0c0814',
                    850: '#110c1c',
                    800: '#171126',
                    750: '#1b142c',
                    700: '#221938',
                    surface: '#16111e',
                    'surface-dim': '#110c19',
                    'surface-card': '#1e1927',
                    'surface-border': '#4d4354',
                },
                amethyst: {
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                    700: '#7e22ce',
                    800: '#6b21a8',
                    light: '#ddb7ff',
                    pink: '#ffb0cd',
                },
                brand: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    200: '#c7d2fe',
                    300: '#a5b4fc',
                    400: '#818cf8',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                    800: '#3730a3',
                    900: '#312e81',
                    950: '#1e1b4b',
                }
            },
            boxShadow: {
                'theme-xs': '0px 1px 2px 0px rgba(16, 24, 40, 0.05)',
                'theme-sm': '0px 1px 3px 0px rgba(16, 24, 40, 0.10), 0px 1px 2px 0px rgba(16, 24, 40, 0.06)',
                'glow-orb': '0 0 70px 20px rgba(168, 85, 247, 0.45), inset 0 -10px 25px rgba(236, 72, 153, 0.6), inset 0 10px 20px rgba(255, 255, 255, 0.7)',
                'glow-card': '0 0 25px -5px rgba(168, 85, 247, 0.15)',
                'glow-input': '0 0 35px -5px rgba(192, 132, 252, 0.25)',
                'glow-button': '0 0 20px rgba(168, 85, 247, 0.4)',
            }
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};

// internal_id: ORMS_PROJ__KERMINT
// @signature orms-kermint-2000
