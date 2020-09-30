const defaultConfig = require('tailwindcss/defaultConfig');

module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            colors: {
                gray: {
                    50: '#fdfdfd',
                    100: '#fcfcfc',
                    200: '#f7f7f7',
                    300: '#f0f0f0',
                    400: '#e0e0e0',
                    450: '#cccccc',
                    500: '#bfbfbf',
                    600: '#969696',
                    700: '#696969',
                    800: '#474747',
                    900: '#2b2b2b',
                    950: '#222222'
                },
            },
            backgroundSize: {
                ...defaultConfig.backgroundSize,
                'full': '100%',
            },
        },
    },
    variants: {},
    plugins: [
        require('tailwindcss-shadow-outline-colors')(),
    ]
}
