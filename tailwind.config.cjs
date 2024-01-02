// https://tailwindcss.com/docs/configuration
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

let leading = (level, lh, ratio = 1.125, base = 16) => {
  return lh / (base * (Math.pow(ratio, level)));
}

let toRem = (px, base = 16) => {
  return px / base + 'rem';
}

module.exports = {
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    screens: {
      'xs': '360px',
      ...defaultTheme.screens,
      '2xl': '1366px',
      '3xl': '1440px',
      '4xl': '1600px',
      '5xl': '1920px',
    },
    fontFamily: {
      primary: ['Poppins', 'Helvetica', 'Arial', 'sans-serif'],
    },
    letterSpacing: {
      tightest: '1px',
      wide: '10.4px',
    },
    extend: {
      borderRadius: {
        'hero': '480px',
        'bg': '300px',
        'bg-xl': '200px',
        'bg-lg': '100px',
        'bg-md': '50px',
        'bg-sm': '25px',
        'bg-xs': '10px',
      },
      boxShadow: {
        'cien-1': '20px 20px 40px 0px rgba(56, 52, 54, 0.40)',
        'cien-1-mobile': '10px 10px 20px 0px rgba(56, 52, 54, 0.4)'
      },
      dropShadow: {
        'cien-1': '20px 20px 40px 0px rgba(56, 52, 54, 0.40)',
        'cien-2': '30px 30px 60px rgba(56, 52, 54, 0.20)',
      },
    colors: {
      
      current: "currentColor",
      transparent: "transparent",
      color1: '#95C11F',
      color2: '#1F294C',
      color3: '#0296D8',
      color4: '#F7F7F7',
      color5: "#FFFFFF",
      color6: "#0F1425",

    },
    spacing: {
      'half': '50px',
      'full': '100px',
      '30': '30px',
      '60': '60px',
    },
    fontSize: {
      'smallest': [12, {
        lineHeight: 1.67,
      }],
      'caption':[14, {
        lineHeight: 1.214,
        letterSpacing: '0.05em',
      }],
      'menu' : [18, {
        lineHeight: 1.44,
       
      }],
      'base': [15, 1.73],
      'desc': [18, 1.67],
      'button': [16, 1.875],
      // 44/26 = 1.6923076923076923
      'badge': ['clamp(1.375rem, 1vw + 1rem, 1.625rem);', {
        lineHeight: 1.70,
        letterSpacing: '10.4px',
        fontWeight: 300,
      }],
      // https://modern-fluid-typography.vercel.app/
      // where u can get fluid typography

      //h5 - 20px - to 18px - rwd
      // 30/20 = 1.5
      '5xl': ['clamp(1.125rem, 0.3vw + 1rem, 1.25rem);', {
        lineHeight: 1.5,
      }],
      //h4 = 26px - to 22px - rwd
      // 36/26 = 1.3846153846153846
      '6xl': ['clamp(1.375rem, 1vw + 1rem, 1.625rem);', {
        lineHeight: 1.38,
      }],
      //h3 - 34px - to 26px - rwd
      // 42/34 = 1.2352941176470589
      '7xl': ['clamp(1.625rem, 1.5vw + 1rem, 2.125rem);', {
        lineHeight: 1.29,
      }],
      //h2 - 48px - to 36px - rwd
      // 58/48 = 1.2083333333333333
      '8xl': ['clamp(2.25rem, 3vw + 1rem, 3rem);', {
        lineHeight: 1.20,
      }],
      //h1 - 58px to 42px - rwd
      // 64/58 = 1.103448275862069
      '9xl': ['clamp(2.625rem, 3vw + 1rem, 3.625rem);', {
        lineHeight: 1.10,
      }],
  },
    },
  },
  plugins: [
    plugin(function ({addBase, addComponents, addUtilities, theme}) {
      addComponents({
        ".container": {
          paddingLeft: "1.25rem",
          paddingRight: "1.25rem",
          width: "100%",
          maxWidth: "1640px",
          margin: "0 auto",
        },
        ".wrapper": {
          paddingLeft: "1.25rem",
          paddingRight: "1.25rem",
        },
        '.font-size-inherit': {
          fontSize: 'inherit',
        },
        '.color-inherit': {
          color: 'currentColor !important',
        },
        '.theme-radius-base': {
          borderRadius: toRem(6)
        },
        '.theme-radius-base-md': {
          borderRadius: toRem(8)
        },
        '.theme-radius-base-lg': {
          borderRadius: toRem(10)
        },
        '.theme-radius-base-xl': {
          borderRadius: toRem(12)
        },
      })
    })
  ],
};