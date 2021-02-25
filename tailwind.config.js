const defaultConfig = require('tailwindcss/defaultConfig');
const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            colors: {
                gray: colors.trueGray,
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
    variants: {},
    plugins: [
        require('@tailwindcss/typography'),
    ]
}
