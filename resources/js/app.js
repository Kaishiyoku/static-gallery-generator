window.$ = window.jQuery = require('jquery');

require('lightgallery/src/js/lightgallery');

import mediumZoom from 'medium-zoom'

mediumZoom('[data-provide="zoomable"]', {
    margin: 0,
    background: '#111111',
    scrollOffset: 40,
});
