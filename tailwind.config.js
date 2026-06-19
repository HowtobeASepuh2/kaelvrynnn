/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                navy: {
                    DEFAULT: '#0a0e1a',
                    light: '#0f1628',
                    card: '#111827',
                },
                cyan: {
                    DEFAULT: '#06b6d4',
                    light: '#67e8f9',
                },
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
        },
    },
    plugins: [],
}