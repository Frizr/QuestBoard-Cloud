import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Cinzel', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                obsidian: '#050816',
                midnight: '#0B1020',
                panel: '#111827',
                card: '#172033',
                surface: '#1E293B',
                arcane: '#6D28D9',
                violet: '#8B5CF6',
                frost: '#38BDF8',
                royal: '#FBBF24',
                bronze: '#B45309',
                crimson: '#DC2626',
                border: '#334155',
            },
            boxShadow: {
                arcane: '0 0 28px rgba(109, 40, 217, 0.28)',
                gold: '0 0 24px rgba(251, 191, 36, 0.22)',
                frost: '0 0 24px rgba(56, 189, 248, 0.18)',
            },
        },
    },

    plugins: [forms],
};
