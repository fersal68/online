$(document).ready(function() {
    // Manejar el formulario de login --- al apretar el boton aparece el formulario login
    $('#loginBtn').on('click', function() {
        $('#loginModalContainer').load('./process/login.php', function() {
            $('#loginModal').modal('show');
        });
    });
    // Manejar el formulario de login ---al apretar el boton del modal - envia la informacion
    $('#loginModalContainer').on('click', '#loginSubmit', function() {
        var username = $('#username').val();
        var password = $('#password').val();
        var formulario = 'FormLogin';

        $.ajax({
            url: './process/ControlIngreso.php',
            type: 'POST',
            data: {
                formulario: formulario,
                username: username,
                password: password
            },
            success: function(response) {
                console.log(response);
                if(response == 'success') {
                    Swal.fire({   //mensaje de 
                        title: 'Login exitoso',
                        text: 'Bienvenido, ' + username,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });  //mensaje
                } else if(response == 'error_pass') {
                    Swal.fire({   //mensaje de 
                        title: 'Error',
                        text: 'Usuario o contraseña incorrectos.',
                        icon: 'error'
                    });  //mensaje
                } else  if(response == 'error_no') {
                    Swal.fire({   //mensaje de 
                        title: 'Error',
                        text: ' Usuario no encontrado.',
                        icon: 'error'
                    });  //mensaje
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Credenciales incorrectas',
                        icon: 'error'
                    });
                }
                // Limpiar los campos del formulario
                $('#username').val('');
                $('#password').val('');
            },

            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error. Por favor, inténtalo de nuevo.',
                    icon: 'error'
                    
                });
                // Limpiar los campos del formulario
                $('#username').val('');
                $('#password').val('');
            }
        });
    });
});
