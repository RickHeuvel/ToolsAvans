
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('owl.carousel');
require('./lib/global');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

var smoothScroll = true;
// Smooth scroll
/*$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    if (smoothScroll) {
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    }
});*/
