module.exports = {
  purge:{
    enabled: true, 
    content: [ './resources/**/**/**/**/*.blade.php', './resources/views/*.blade.php'  ]
  }, 
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
