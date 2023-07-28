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
    },
    screens: {
      '2xl': { max: '1535px' },
      xl: { max: '1279px' },
      lg: { max: '1023px' },
      mdl: { max: '830px' },
      md: { max: '767px' },
      sm: { max: '639px' },
      xs: { max: '480px' },
    },
  },
  plugins: [],
}
