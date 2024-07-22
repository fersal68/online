
    $(document).ready(function() {

    let lastScrollTop = 0;
    $(window).scroll(function(event) {
        let st = $(this).scrollTop();
        if (st > lastScrollTop) {
            // Baja el scroll
            $('#navbar').css('top', '-100px');
        } else {
            // Sube el scroll
            $('#navbar').css('top', '0');
        }
        lastScrollTop = st;
    });

    $('.checkbtn').on('click', function() {
        $(this).toggleClass('active');
        $('body').toggleClass('lock-scroll'); // Desactiva/activa el scroll del fondo
    });

    $('#check').on('change', function() {
        if ($(this).is(':checked')) {
            $('body').addClass('lock-scroll'); // Desactiva el scroll del fondo cuando el menú está abierto
        } else {
            $('body').removeClass('lock-scroll'); // Activa el scroll del fondo cuando el menú está cerrado
        }
    });

});


// Carousel auto slide
   $('.carousel').carousel({
    interval: 3000
});

// Info links functionality
$('.info-link').on('click', function(e) {
    e.preventDefault();
    var info = $(this).data('info');
    $('#infoContainer').html('<p>' + info + '</p>');
});

   // Alternar visibilidad de la contraseña
   $('#togglePassword').on('click', function() {
        var passwordField = $('#password');
        var passwordToggle = $(this);
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            passwordToggle.removeClass('ri-eye-off-fill').addClass('ri-eye-fill');
        } else {
            passwordField.attr('type', 'password');
            passwordToggle.removeClass('ri-eye-fill').addClass('ri-eye-off-fill');
        }
    });