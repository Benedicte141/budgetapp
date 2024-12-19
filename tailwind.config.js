/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig', // Inclure vos fichiers Twig
    './templates/security/login.html.twig', // Inclure vos fichiers Twig
    './templates/base.html.twig', // Inclure vos fichiers Twig
    './assets/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'), // Ajouter DaisyUI comme plugin
  ],
}

