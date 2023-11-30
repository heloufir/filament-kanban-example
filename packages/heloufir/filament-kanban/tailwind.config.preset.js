import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

export default {
    darkMode: 'class',
    content: ['./vendor/heloufir/filament-kanban/**/*.blade.php', './vendor/heloufir/filament-kanban/**/Livewire/Kanban.php'],
    theme: { },
    plugins: [forms, typography],
}
