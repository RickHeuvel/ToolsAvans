// Importing popper, jquery and the jquery bootstrap plugin
// Webpack figures out where to get these files

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

// Smooth scrolling for # links
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});
