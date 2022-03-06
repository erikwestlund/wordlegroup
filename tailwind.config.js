module.exports = {
    content: [
        "./app/View/Components/**/*.php",
        "./app/Http/Livewire/**/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ['-apple-system', 'BlinkMacSystemFont', "Segoe UI", 'Roboto', 'Helvetica', 'Arial', 'sans-serif', "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"],
            system: ['-apple-system', 'BlinkMacSystemFont', "Segoe UI", 'Roboto', 'Helvetica', 'Arial', 'sans-serif', "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"],
            serif: ['IBM Plex Serif', 'serif'],
        },
        extend: {
            colors: {
                current: 'currentColor',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
