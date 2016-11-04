
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));


 const app = new Vue({
    el: 'body'
});


//FELS Style
$(document).ready(function (e) {

    $('.menu-bar').on('click', function (e) {
        $(this).toggleClass('change');
    });

    $(window).scroll(function (e) {
        var y = $(window).scrollTop();
        $('.welcome').css('bottom', -y * 0.5 + 'px');
    });

    $('.menu-bar').on('click', function (e) {
        $('.fullscreen-menu').toggle('slow');
        e.stopPropagation();
    });

    $(window).on('click', function (e) {
        if ($('.fullscreen-menu').css('display') == 'block') {
            $('.menu-bar').trigger('click');
        }
    })

    function changeLoginSignUp (e) {
        $('.modal-body.login').toggle(400);
        $('.modal-body.sign-up').toggle(400);
    }

    $('.sign-up-button').on('click', changeLoginSignUp);

    $('.back-to-login').on('click', changeLoginSignUp);

})
