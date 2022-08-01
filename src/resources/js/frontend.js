import Alpine from 'alpinejs';
import gridSlider from './components/gridSlider.js';
import Swiper from './components/swiper.js';
import SimpleLightbox from './components/simple-lightbox.js';

Alpine.data('gridSlider', gridSlider);

window.Alpine = Alpine;

Alpine.start();

Swiper.init();

SimpleLightbox.init();

const axios = require('axios').default;

const formElement = document.querySelector('.js-ajax-login')

if (formElement) {
    formElement.addEventListener("submit", function (event) {
        console.log('ajax login')
        event.preventDefault()
        const form = this
        const data = new FormData(form)
        const url = form.getAttribute('action')
        const method = form.getAttribute('method')


            axios({
                method: method,
                url: url,
                data: data,
                headers: {'Content-Type': 'multipart/form-data'}
            })
                .then(({data}) => {

                    // Reload page so you will be redirected to default page defined in Laravel
                    window.location = '/profile?edit=true'
                })
            .catch(error => {
                console.log('login error', error);
                const errorContainer = document.querySelector('#frontend-login-error');
                errorContainer.textContent = 'LOGIN FAILED - PLEASE TRY AGAIN';

            })

        return false;
    })
}
