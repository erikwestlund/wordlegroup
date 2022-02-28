module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      sans: ['Inter', 'sans-serif'],
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
