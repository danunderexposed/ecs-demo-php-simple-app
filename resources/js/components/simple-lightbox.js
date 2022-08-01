import SimpleLightbox from 'simple-lightbox';

export default {
    init() {
        new SimpleLightbox({elements: '.popup-gallery a'});
    }
};
