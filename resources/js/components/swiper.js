import Swiper, { Navigation, Pagination, Thumbs } from 'swiper';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default {
    init() {
        window.homeHeroSlider = new Swiper('[data-home-hero-slider]', {
            modules: [Pagination],
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
        });

        window.homePortfolioController = new Swiper('[data-home-portfolio-controller]', {
            slideActiveClass: 'active',
            slidesPerView: 4
        });
        window.homePortfolioSlider = new Swiper('[data-home-portfolio-slider]', {
            modules: [Navigation, Thumbs],
            direction: 'vertical',
            thumbs: {
                swiper: window.homePortfolioController,
                slideThumbActiveClass: 'active'
            },
            on: {
                beforeTransitionStart: function(){
                    const headerContainer = document.querySelector('[data-portfolio-slider-header]');
                    const diamond  = document.querySelector('.swiper-slide.diamond');
                    const circle = document.querySelector('.swiper-slide.circle');
                    const hexagon = document.querySelector('.swiper-slide.hexagon');
                    const triangle = document.querySelector('.swiper-slide.triangle');
                    if (diamond.classList.contains('active')) {
                        headerContainer.innerHTML="Fashion / Textiles / Accessories";
                    }
                    if (circle.classList.contains('active')) {
                        headerContainer.innerHTML="Visual Communication";
                    }
                    if (hexagon.classList.contains('active')) {
                        headerContainer.innerHTML="Product / Industrial / Interiors";
                    }
                    if (triangle.classList.contains('active')) {
                        headerContainer.innerHTML="Ceramics / Jewellery / Glass";
                    }
                }
        }
        });

        window.homePortfolioNestedController = new Swiper('[data-home-portfolio-nested-controller]', {});
        window.homePortfolioNestedSlider = new Swiper('[data-home-portfolio-nested-slider]', {
            modules: [Navigation, Thumbs],
            navigation: {
                nextEl: '.home-latest-portfolio .right',
                prevEl: '.home-latest-portfolio .left',
            },
            thumbs: {
                swiper: window.homeSponsorController,
                slideThumbActiveClass: 'active',
                thumbsContainerClass: 'mjc'
            },
            slidesPerView: 1,
            slidesPerGroup: 1,
            breakpoints: {
                // when window width is >= 640px
                640: {
                  slidesPerView: 2,
                  slidesPerGroup: 2
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                1000: {
                    slidesPerView: 4,
                    slidesPerGroup: 4
                },
                1200: {
                    slidesPerView: 5,
                    slidesPerGroup: 5
                }
              }
        });

        window.homeSponsorController = new Swiper('[data-home-sponsor-controller]', {});
        window.homeSponsorSlider = new Swiper('[data-home-sponsor-slider]', {
            modules: [Navigation, Thumbs],
            navigation: {
                nextEl: '.home-sponsors-nav .right',
                prevEl: '.home-sponsors-nav .left',
            },
            thumbs: {
                swiper: window.homeSponsorController,
                slideThumbActiveClass: 'active'
            },
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 10,
            breakpoints: {
                // when window width is >= 640px
                640: {
                  slidesPerView: 2,
                  slidesPerGroup: 2
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                1000: {
                    slidesPerView: 4,
                    slidesPerGroup: 4
                },
                1200: {
                    slidesPerView: 5,
                    slidesPerGroup: 5
                }
              }
        });

        window.footerAdvertsController = new Swiper('[data-footer-controller]', {});
        window.footerAdvertsSlider = new Swiper('[data-footer-slider]', {
            modules: [Navigation],
            navigation: {
                nextEl: '.courses-bottom-content .right',
                prevEl: '.courses-bottom-content .left',
            },
            thumbs: {
                swiper: window.footerAdvertsController,
                slideThumbActiveClass: 'active'
            },
            slidesPerView: 'auto',
            spaceBetween: 2
        });

        const slidersEls = document.querySelectorAll('[data-project-slider]');
        slidersEls.forEach((slider, index) => {
            const next = slider.querySelector('.nav.next');
            const prev = slider.querySelector('.nav.prev');
            new Swiper(slider, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 2,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                }
            });
        });
        const slidersFooter = document.querySelectorAll('[data-footer-slider]');
        slidersFooter.forEach((slider, index) => {
            const next = slider.querySelector('.mini-nav .right');
            const prev = slider.querySelector('.mini-nav .left');
            new Swiper(slider, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 2,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                }
            });
        });
        const slidersSchool = document.querySelectorAll('[data-school-slider]');
        slidersSchool.forEach((slider, index) => {
            const next = slider.querySelector('.mini-nav .right');
            const prev = slider.querySelector('.mini-nav .left');
            new Swiper(slider, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 2,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                }
            });
        });

        const slidersGDGS = document.querySelectorAll('[data-gsds-slider]');
        slidersGDGS.forEach((slider, index) => {
            const next = slider.querySelector('.gdgs-nav .right');
            const prev = slider.querySelector('.gdgs-nav .left');
            new Swiper(slider, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 2,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                },
                breakpoints: {
                    // when window width is >= 640px
                    640: {
                      slidesPerView: 2,
                      slidesPerGroup: 2
                    },
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 3
                    },
                    1000: {
                        slidesPerView: 4,
                        slidesPerGroup: 4
                    }
                  }
            });
        });

        const slidersPortfolio = document.querySelectorAll('[data-portfolio-slider]');
        slidersPortfolio.forEach((slider, index) => {
            const next = slider.querySelector('.mini-nav .right');
            const prev = slider.querySelector('.mini-nav .left');
            new Swiper(slider, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 2,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                }
            });
        });

    }
};
