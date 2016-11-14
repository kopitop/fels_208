
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
    //Toggle menu fullscreen
    $('.menu-bar').on('click', function (e) {
        $(this).toggleClass('change');
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

    //Parralax effect background
    $(window).scroll(function (e) {
        var y = $(window).scrollTop();
        $('.welcome').css('bottom', -y * 0.5 + 'px');
    });

    //Sign-in sign-up modal
    function changeLoginSignUp (e) {
        $('.modal-body.login').toggle(400);
        $('.modal-body.sign-up').toggle(400);
    }

    $('.sign-up-button').on('click', changeLoginSignUp);

    $('.back-to-login').on('click', changeLoginSignUp);

    //Sidebar menu effect
    $('ul').has('li.active').show();

    $('ul.sidebar li ul li').on('click', function (e) {
        e.stopPropagation();
    });

    $('ul.sidebar>li').on('click', function (e) {
        $('.sidebar li ul').each(function (index, element) {
            if ($(element).has('li.active').length === 0) {
                $(element).hide(400);
            };
        })
        $(this).find('ul').show(400);
    });

    $(document).on('click', function (e) {
        if ($('.sidebar').has(e.target).length === 0 && e.target) {
            $('.sidebar li ul').each(function (index, element) {
                if ($(element).has('li.active').length === 0) {
                    $(element).hide(400);
                };
            })
        }
    });

    $(document).on('click', '.status', function () {
        $('.status').on('click', function () {
            $(this).hide(400);
        });
    }); 

    //Click image to upload file
    $('.edit-photo-container').click(function (e) {
        $('#upload-photo').click();
    });

    //Preview edited photo
    function previewFile() {
        var preview = $('.category-img')[0];
        var file    = $('#upload-photo')[0].files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

    $('#upload-photo').on('change', function (e) {
        previewFile();
        $('.edit-photo-container p').html(previewStatus);
    });

    //Add and remove answer
    function addOrRemoveAnswer () {
        var i = $('#answers input[type="text"]').length;
        var answers = $('#answers');

        var addAnswer = function () {
            var remove = "{{ trans('word.remove') }}";
            var newAnswer = '<div class="answer-container">\
            <label>' + label + '</label>\
            <input type="text" class="form-control" name="answer['+ i +']">\
            <span>' + isCorrect + '</span>\
            <input type="checkbox" name="is_correct['+ i +']"/>\
            <a class="btn btn-default remove-answer" href="Javascript:;">' + remove + '</a>\
            </div>\
            ';
            $(newAnswer).appendTo(answers);
            i++;

            return false;
        }

        $('#addAnswer').on('click', addAnswer);

        $(document).on('click', '.remove-answer', function() { 
            if( i > 1 ) {
                $(this).parents('.answer-container').remove();
                i--;
            }
            return false;
        });
    };

    addOrRemoveAnswer();

})
