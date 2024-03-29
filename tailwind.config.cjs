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
  darkMode: 'class',
  theme: {
    screens: {
      'xs': '375px',
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
      boxShadow: {
        'cien-1': '-20px 30px 40px 0px rgba(114, 114, 114, 0.20)',
        'cien-2': '10px 10px 10px 0px rgba(40, 50, 80, 0.20);',
       
      },
      dropShadow: {
        'cien-1': '10px 10px 10px 0px rgba(255, 248, 50, 0.2);',
      },
    colors: {
      
      current: "currentColor",
      transparent: "transparent",
      colorObramowanie: 'rgba(15, 20, 37, 0.20)',
      color1: '#95C11F',
      color2: '#1F294C',
      color3: '#0296D8',
      color4: '#F7F7F7',
      color5: "#FFF",
      color6: "#0F1425",
      color7: '#8F94A5',
      colorContrast: '#fff832'

    },
    spacing: {
      'half': '50px',
      'half-mobile': '25px',
      'full': '100px',
      '30': '30px',
      '60': '60px',
    },
    fontSize: {
      // 'smallest': [12, {
      //   lineHeight: 1.67,
      // }],
      // 'caption':[14, {
      //   lineHeight: 1.214,
      //   letterSpacing: '0.05em',
      // }],
      'menu' : ['1rem', {
        lineHeight: 1.625, // Unitless, relative to the font size
        letterSpacing: '3.2px', // Rounded from 0.046875rem
        fontWeight: 600,
      }],
      'base': ['0.9375rem', 1.6], // Unitless, relative to the font size
      'desc': ['1.125rem', {
        lineHeight: 1.67, // Unitless, relative to the font size
      }],
      'button': [
        '0.75rem', { // Converted font size to rem
          lineHeight: '1.67', // You could use 1.25rem or keep it unitless as 1.25
          letterSpacing: '3.2px', // Converted letter spacing to rem
          fontWeight: 700,
        }
      ],
      // https://modern-fluid-typography.vercel.app/
      // where u can get fluid typography
      'h6': ['clamp(1rem, 3vw - 1rem, 1.125rem);', {
        lineHeight: 1.44,
        fontWeight: 700,
      }],
      'h5': ['clamp(1.125rem, 3vw - 1rem, 1.25rem);', {
        lineHeight: 1.36,
        fontWeight: 600,
      }],
      'h4': ['clamp(1.25rem, 1vw + 1rem, 1.5rem);', {
        lineHeight: 1.42,
        fontWeight: 600,
      }],
      'h3': ['clamp(1.5rem, 1vw + 1rem, 2.125rem);', {
        lineHeight: 1.29,
        fontWeight: 600,
      }],

      'h2': ['clamp(2.125rem, 2vw + 1rem, 3rem);', {
        lineHeight: 1.20,
        fontWeight: 600,
      }],
      'h1': ['clamp(3rem, 2vw + 2.25rem, 4.5rem);', {
        lineHeight: 1.14,
        fontWeight: 700,
      }],
    },
    keyframes: {
      scaleUp: {
        '0%': { transform: 'scale(0.95)', opacity: '0' },
        '100%': { transform: 'scale(1)', opacity: '1' },
      },
      scaleDown: {
        '0%': { transform: 'scale(1)', opacity: '1' },
        '100%': { transform: 'scale(0.95)', opacity: '0' },
      },
      fadeIn: {
        '0%': { opacity: '0' },
        '100%': { opacity: '1' },
      },
    },
    animation: {
      scaleUp: 'scaleUp 0.3s ease-out forwards',
      scaleDown: 'scaleDown 0.2s ease-out forwards',
      'fade-in': 'fadeIn 0.5s ease-out forwards',
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