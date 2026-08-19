/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.js"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Manrope", "sans-serif"],
                display: ["Newsreader", "Georgia", "serif"],
                mono: ["DM Mono", "monospace"],
            },
        },
    },
    plugins: [],
};
