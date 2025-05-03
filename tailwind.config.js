import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    safelist: [
        // Safelist arbitrary values if needed
        'bg-[#D3D9D4]',
        'text-[#212A31]',
        'border-[#253944]',
        'bg-[#124E66]',
        'text-[#748D92]',
        // Add any other custom colors you use
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Moon Phases Color Palette
                'dark-navy': '#212A31',
                'deep-teal': '#253944',
                'ocean-blue': '#124E66',
                'grey-blue': '#748D92',
                'light-grey': '#D3D9D4',
                
                // Your existing custom color
                'custom-gray': '#D9D9D9',
            },
            screens: {
                'xs': '360px',
            },
        },
    },

    plugins: [forms],
};