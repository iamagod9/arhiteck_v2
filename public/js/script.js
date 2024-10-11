'use strict'

let showErrorFields = (errors) => {
    Object.keys(errors).forEach((name) => {
        let field = document.querySelector(`[name="${name}"]`);
        let tooltip = field.nextElementSibling.nextElementSibling;
        tooltip.textContent = errors[name];
        field?.classList?.add('is-invalid');
    })
};

let removeErrorFields = (fields) => fields.forEach(field => field.classList.remove('is-invalid'));

let validationForm = (form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const button = event.target.querySelector('button[type="submit"]');
        const span = button.querySelector('span');

        removeErrorFields(form.querySelectorAll('.is-invalid'));

        try {
            button.disabled = true;
            span.classList.remove('d-none');

            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                showErrorFields(data.errors);
                return;
            }

            swal({
                text: data.message,
                icon: 'success'
            });

            form.reset();
        } catch (e) {
            console.error(e.message)
        } finally {
            button.disabled = false;
            span.classList.add('d-none');
        }
    })
}

document.addEventListener('DOMContentLoaded', () => {
    validationForm(document.querySelector('.form-feedback-modal'));

    let swiperReviews = document.querySelector('.swiper-reviews');
    let swiperBtnPrev = swiperReviews?.querySelector('.swiper-button-prev');
    let swiperBtnNext = swiperReviews?.querySelector('.swiper-button-next');
    swiperReviews?.addEventListener('mouseover', () => {
        swiperBtnPrev.classList.remove('swiper-button-hidden');
        swiperBtnNext.classList.remove('swiper-button-hidden');
    });

    swiperReviews?.addEventListener('mouseout', () => {
        swiperBtnPrev.classList.add('swiper-button-hidden');
        swiperBtnNext.classList.add('swiper-button-hidden');
    });

    new Swiper('.swiper-banks', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 3,
            },
        },

        pagination: {
            clickable: true,
            el: '.swiper-pagination',
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    new Swiper('.swiper-results', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    new Swiper('.swiper-reviews', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 3,
            },
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    const swiperGallery = new Swiper('.swiper-gallery', {
        spaceBetween: 16,
        slidesPerView: 2,
        breakpoints: {
            576: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 4,
            },
        },

        freeMode: true,
        watchSlidesProgress: true,
    });

    const swiperDetailWrapper = document.querySelector('.swiper-detail .swiper-wrapper');
    const swiperDetail = new Swiper('.swiper-detail', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: swiperGallery,
        },

        on: {
            init: function () {
                const lg = lightGallery(swiperDetailWrapper, {
                    plugins: [lgZoom],
                    getCaptionFromTitleOrAlt: false,
                });
                swiperDetailWrapper.addEventListener('lgBeforeClose', () => {
                    swiperDetail.slideTo(lg.index, 0);
                });
            },
        },
    });
});