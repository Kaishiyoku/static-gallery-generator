import Zooming from 'zooming'

document.addEventListener('DOMContentLoaded', () => {
    new Zooming({
        bgColor: '#111111',
    }).listen('[data-provide="zoomable"]');
})
