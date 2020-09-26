module.exports = {
  purge: {
    enabled: true,
    content: [
      "./*.html",
      "./*.php",
      "./js/*.js",
      "./lib/*.php",
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
    space: ["responsive"],
    textColor: ["responsive", "hover", "focus", "active", "group-hover", "first"]
  },
  plugins: [],
};
