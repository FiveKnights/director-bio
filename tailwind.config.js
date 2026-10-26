/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './config/portfolio.php',
    ],
    theme: {
        extend: {
            colors: {
                cyan: { 400: '#00f0ff', 500: '#00a2ff', 600: '#1d6cd8', 900: '#0a1d37' },
                darkbg: { base: '#090d16', surface: '#0e1420', panel: '#131b2e' },
            },
            fontFamily: {
                tech: ['Share Tech Mono', 'monospace'],
                sans: ['Rajdhani', 'sans-serif'],
            },
        },
    },
}