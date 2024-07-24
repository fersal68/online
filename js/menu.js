$(document).ready(function() {
    let lastScrollTop = 0;
    $(window).scroll(function(event) {
        let st = $(this).scrollTop();
        if (st > lastScrollTop) {
            $('#navbar').css('top', '-100px');
        } else {
            $('#navbar').css('top', '0');
        }
        lastScrollTop = st;
    });

    $('.checkbtn').on('click', function() {
        $(this).toggleClass('active');
        $('body').toggleClass('lock-scroll');// Desactiva/activa el scroll del fondo
    });

    $('#check').on('change', function() {
        if ($(this).is(':checked')) {
            $('body').addClass('lock-scroll'); // Desactiva el scroll del fondo cuando el menú está abierto
        } else {
            $('body').removeClass('lock-scroll');  // Activa el scroll del fondo cuando el menú está cerrado
        }
    });

    $('.carousel').carousel({
        interval: 3000
    });

    $('.info-link').on('click', function(e) {
        e.preventDefault();
        var info = $(this).data('info');
        $('#infoContainer').html('<p>' + info + '</p>');
    });


});
