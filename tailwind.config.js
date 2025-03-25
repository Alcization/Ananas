/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      fontFamily: {
        BeVietnam: ['Be Vietnam Pro', 'sans-serif']
      },
      colors: {
        Cam_Ananas: '#F15E2C',
        be: '#FDFBEF',
        xanh_duong: '#1B497B',
        nau: '#86543B',
      },
    },
  },
  plugins: [],
}

