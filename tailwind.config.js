/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: [
      "./resources/**/*.js",
      './resources/js/**/*.vue'
  ],
  darkMode: ['class'],
  theme: {
    extend: {},
  },
  plugins: [],
  important: '.greeter'
}