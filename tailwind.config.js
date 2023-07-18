/** @type {import('tailwindcss').Config} */
module.exports = {
  important: true,
  content: [
    "./resources/view/**/*.blade.php",
    "./resources/js/**/*.{vue,js,jsx}",
  ],
  theme: {
    extend: {},
    fontFamily: {
      Lobster: 'Lobster'
    }
  },
  plugins: [],
}
