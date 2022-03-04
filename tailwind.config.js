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
      sans: ['Inter', 'sans-serif'],
      board: ['sans-serif'],
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
