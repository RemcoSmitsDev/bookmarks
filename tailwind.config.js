module.exports = {
  purge: {
    enabled: false,
    content: [
      "./*.html",
      "./inc/templates/*.php",
      "./inc/templates/*.html",
      "./*.php",
      "./post/*.php",
      "./opdracht/*.php",
      "./js/*.js",
    ],
  },
  theme: {},
  variants: {
    appearance: ["responsive"],
    display: ['responsive', 'hover', 'focus','group-hover'],
    backgroundColor: ["responsive", "hover", "focus", "active", "group-hover"],
    opacity: ["responsive", "hover", "focus", "disabled"],
    zIndex: ["responsive", "hover", "focus"],
    borderWidth: ["responsive", "first", "hover", "focus", "group-hover"],
    width: ["responsive", "first", "hover", "focus"],
    space: ["responsive", "hover", "focus"],
    textColor: ["responsive", "hover", "focus", "active", "group-hover"],
  },
  plugins: [],
};
