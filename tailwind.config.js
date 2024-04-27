/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./views/**/*.{html,js,php}",
      "./views/admin/dashboard/partials/*.{html,js,php}",
      "./Components/**/*.{html,js,php}"
  ],
    safelist: [
        { pattern: /from-.+-.+/ },
        { pattern: /to-.+-.+/ },
        { pattern: /shadow-.+-.+\/.+/ }
    ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}