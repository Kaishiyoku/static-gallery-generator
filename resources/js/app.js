import Zooming from 'zooming';

document.addEventListener('DOMContentLoaded', () => {
    new Zooming({
        bgColor: '#111111',
        scaleExtra: 2,
    }).listen('[data-provide="zoomable"]');
})
