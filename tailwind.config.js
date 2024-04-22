/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./views/**/*.{html,js,php}",
      "./views/admin/dashboard/partials/*.{html,js,php}",
      "./Components/**/*.{html,js,php}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

