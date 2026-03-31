/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./assets/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'ep-blue-night': '#0B1C38',
        'ep-cyan': '#00B4D8',
        'ep-gray-light': '#F8FAFC',
        'ep-primary': '#0077B6',
      },
      fontFamily: {
        'sans': ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
      },
      boxShadow: {
        'modern': '0 10px 40px -10px rgba(0,0,0,0.08)',
        'modern-hover': '0 20px 40px -10px rgba(0,180,216,0.15)',
      }
    },
  },
  plugins: [],
}
