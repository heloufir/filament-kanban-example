import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./packages/heloufir/filament-kanban/resources/**/*.blade.php"
    ],
    theme: {
        extend: {},
    },
    plugins: [forms, typography],
}

