function burgerMenu(icon) {
    icon.classList.toggle("change");
}


$(document).ready(function () {
    $('.owl-carousel_1').owlCarousel({
        loop: true,
        margin: 24,
        nav: true,
        navText: ['', ' '],

        responsive: {
            0: {
                items: 1.2
            },

            1000: {
                items: 3
            }
        }
    });

    if ($(window).width() < 992) {
        $('.owl-carousel_2').owlCarousel({
            loop: true,
            margin: 24,
            nav: true,
            navText: ['', ' '],

            responsive: {
                0: {
                    items: 1
                },

                1000: {
                    items: 3
                }
            }
        })
    } else {
        $('.owl-carousel_2').owlCarousel('destroy')
    }
});


$(document).ready(function(){
    $("#menu").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});

if (document.documentElement.clientWidth >= 768) {
    jQuery(function ($) {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 70) {
                $('header').addClass('header__scroll');
            }
            else if ($(this).scrollTop() < 70) {
                $('header').removeClass('header__scroll');
            }
        });
    });
}


$('.nav-link').on('click', function () {
    $('.navbar-collapse').removeClass('show')({ scrollTop: $a.offset().top - 50}, 500);

});
document.addEventListener("click", addActive);

function addActive(evt) {
    if (evt.target.classList.contains("nav-link")) {
        // remove .active from all li.active
        const allItems = document.querySelectorAll(".active");
        for (let i=0; i<allItems.length; i += 1) {
            allItems[i].classList.toggle("active");
        }
        // add .active to the current (clicked) item
        evt.target.classList.toggle("active");
    }
}
