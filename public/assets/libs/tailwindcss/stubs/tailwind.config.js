/** @type {import('tailwindcss').Config} */
export default {
    content: [
      './index.html',
      './src/**/*.{js,ts,jsx,tsx,vue,html}', // sesuaikan dengan struktur proyek kamu
    ],
    safelist: [
      'bg-gray-400',
      'bg-blue-400',
      'bg-teal-400',
      'bg-amber-400',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }
  