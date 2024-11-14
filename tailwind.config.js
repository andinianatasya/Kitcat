/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./publik/**/*.{html,js}"],
  theme: {
    extend: {
      backgroundImage: {
        'bgBeranda' : "url('/publik/img/bgberanda.png')",
        'bgKamarTdr' : "url('/publik/img/bgtidur.png')",
        'bgDapur' : "url('/publik/img/bgdapur.png')",
        'bgKmrMandi' : "url('/publik/img/bgkmrMandi.png')",
        'bgMain' : "url('/publik/img/bgmain.png')",
        'bgLogin' : "url('/publik/img/bglogin.png')",
        'bgProfil' : "url('/publik/img/bgProfil.png')"
      },

      colors : {
        'cream' : "#fbba72",
        'merahTua' : "#691e06",
        'merah' : "#8f250c",
        'orenTua' : "#bb4d00",
        'oren' : "#ca5310"
      },

      boxShadow : {
        'cartoon': "0 10px rgb(187, 77, 0)",
        'squashed-cartoon': "0 5px rgb(187, 77, 0)"
      }
    },
  },
  plugins: [],
}
