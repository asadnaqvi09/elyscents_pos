// Tailwind config
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./screens/**/*.php",
    "./components/**/*.php",
    "./js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        // Elyscents Branding: Deep Blacks and Clean Off-whites
        'brand-black': '#0a0a0a',
        'brand-gray': '#f5f5f5',
        'brand-accent': '#d4af37', // Subtle Gold for specialized icons
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
        'urdu': ['Noto Nastaliq Urdu', 'serif'],
      },
      height: {
        'topbar': '64px',
        'bottombar': '64px',
        'content': 'calc(100vh - 128px)', // Remaining space for main content
      },
      boxShadow: {
        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
        'top': '0 -4px 10px -1px rgba(0, 0, 0, 0.05)',
      }
    },
  },
  plugins: [],
}