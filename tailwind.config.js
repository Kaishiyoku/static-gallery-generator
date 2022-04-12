const defaultTheme = require('tailwindcss/defaultTheme');
const defaultConfig = require('tailwindcss/defaultConfig');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './resources/js/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                serif: ['Merriweather', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                gray: colors.gray,
            },
            backgroundSize: {
                ...defaultConfig.backgroundSize,
                'full': '100%',
            },
            typography: {
                DEFAULT: {
                    css: {
                        color: '#ffffff',
                        a: {
                            color: '#b56ed8',
                            textDecoration: 'none',
                            transition: 'all linear 300ms',
                            borderBottom: '1px solid transparent',
                            '&:hover': {
                                color: '#ceaae5',
                                textDecoration: 'none',
                                borderBottom: '1px solid #d4b0e7',
                            },
                        },
                        h1: {
                            color: '#ffffff',
                        },
                        h2: {
                            color: '#ffffff',
                        },
                        h3: {
                            color: '#ffffff',
                        },
                        h4: {
                            color: '#ffffff',
                        },
                        strong: {
                            color: '#ffffff',
                        },
                    },
                },
            },
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
    ]
}
