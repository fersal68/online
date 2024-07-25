<?php 
// Obtener el directorio del archivo actual 
$dir = __DIR__;
//  usando la ruta relativa
require_once $dir . '/../SQLs/consultasSQL.php';
//require_once $dir . '/../SQLs/ConectarSQL.php';

$usuario = $_SESSION['usuario'];
$sql = "SELECT ID, NOMBRE, DIRECCION, TELEFONO, EMAIL, PASSWORD FROM prodes.usuarios WHERE USUARIO = ?";
$stmt = ejecutarSQL($sql, [$usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

/* Convierte los datos del usuario a JSON para pasarlos a JavaScript */
$userJson = json_encode($user);
?>

<div class="menu-user-titulo">
        <h1>Configuración de Usuario</h1>
        <p>Gestiona tu información y preferencias de usuario</p>
    </div>
    <div class="menu-user-container">
        <div class="menu-user-izq">
            <div class="menu-user-item" onclick="showForm('informacion')">
                <img src="<?php echo RUTA_IMG; ?>/info.png" alt="Configuración">
                <span>Mi Información</span>
            </div>
            <div class="menu-user-item" onclick="showForm('contrasena')">
                <img src="<?php echo RUTA_IMG; ?>/Cambiopass.png" alt="Cambiar Contraseña">
                <span>Cambiar Contraseña</span>
            </div>
        </div>
        <div class="menu-user-der" id="menu-user-der">
            <!-- Contenido dinámico aquí -->
            <img src="<?php echo RUTA_IMG; ?>/conf.png" alt="Imagen Central" class="imagen-central">
        </div>
    </div>

    <script>
    // Pasa los datos del usuario de PHP a JavaScript
    const user = <?php echo $userJson; ?>;

    function showForm(formType) {
        const menuUserDer = document.getElementById('menu-user-der');
        menuUserDer.innerHTML = '';

        if (formType === 'informacion') {
            menuUserDer.innerHTML = `
                <h2>Mi Información</h2>
                <form id="ModMiInfoForm" class="ModMiInfoForm">
                <!-- Campo oculto id -->
                <input type="hidden" id="id_usuario" name="id_usuario" value="${user.ID}">
                <!-- Campos para editar la información del usuario -->
                <div>
                    <label for="modnombre"><i class="fa fa-user"></i> Nombre y Apellido:</label>
                    <input type="text" id="modnombre" name="modnombre" value="${user.NOMBRE}">
                </div>
                <div>
                    <label for="moddireccion"><i class="fa fa-map-marker-alt"></i> Dirección:</label>
                    <input type="text" id="moddireccion" name="moddireccion" value="${user.DIRECCION}">
                </div>
                <div>
                    <label for="modtelefono"><i class="fa fa-phone"></i> Teléfono:</label>
                    <input type="text" id="modtelefono" name="modtelefono" value="${user.TELEFONO}">
                </div>
                <div>
                    <label for="modemail"><i class="fa fa-envelope"></i> Email:</label>
                    <input type="email" id="modemail" name="modemail" value="${user.EMAIL}">
                </div>
                <button type="button" id="ModInfSubmit" class="btn btn-primary">Guardar Cambios</button>
            </form>
            `;

            // Actualiza los valores de los campos con los datos del usuario
            //document.getElementById('id_usuario').value = user.ID;
            //document.getElementById('nombre').value = user.NOMBRE;
            //document.getElementById('email').value = user.EMAIL;
            //document.getElementById('telefono').value = user.TELEFONO;
            //document.getElementById('direccion').value = user.DIRECCION;
            //document.getElementById('contrasena-actual').value = user.PASSWORD;

        } else if (formType === 'contrasena') {
            menuUserDer.innerHTML = `
                <h2>Cambiar Contraseña</h2>
                <form id="ModPassForm" class="ModPassForm">
                    <!-- Campo oculto id -->
                    <input type="hidden" id="id_usuario" name="id_usuario" value="${user.ID}">
                    <div>
                        <label for="nueva-contrasena"><i class="fa fa-key"></i> Nueva Contraseña:</label>
                        <input type="password" id="nueva-contrasena" name="nueva-contrasena">
                    </div>
                    <div>
                        <label for="confirmar-contrasena"><i class="fa fa-key"></i> Confirmar Nueva Contraseña:</label>
                        <input type="password" id="confirmar-contrasena" name="confirmar-contrasena">
                    </div>
                    <button type="button" id="ModPassSubmit" class="btn btn-primary" disabled>Cambiar Contraseña</button>
                </form>
            `;

            // Puedes también establecer valores aquí si fuera necesario
            // Habilitar el botón solo si las contraseñas coinciden
            document.getElementById('nueva-contrasena').addEventListener('input', validarContrasenas);
            document.getElementById('confirmar-contrasena').addEventListener('input', validarContrasenas);
        }

    function validarContrasenas() {
        const nuevaContrasena = document.getElementById('nueva-contrasena').value;
        const confirmarContrasena = document.getElementById('confirmar-contrasena').value;
        const botonSubmit = document.getElementById('ModPassSubmit');

        if (nuevaContrasena && confirmarContrasena && nuevaContrasena === confirmarContrasena) {
            botonSubmit.disabled = false;
        } else {
            botonSubmit.disabled = true;
        }
    }
    }





    </script>

    <script>
        
$(document).ready(function() {  //la carga del documento el ID= del form y el ID= del boton
    //menu-user-der ---- es el menu del contenedor
    $('#menu-user-der').on('click', '#ModInfSubmit', function() {
        var formData = {
            formulario: 'ModMiInfoForm',
            id_usuario: $('#id_usuario').val(),
            modnombre: $('#modnombre').val(),
            modemail: $('#modemail').val(),
            modtelefono: $('#modtelefono').val(),
            moddireccion: $('#moddireccion').val()
        };

        $.ajax({
            url: './process/ControlMenuUsuario.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                if (response === 'success') {
                    Swal.fire({
                        title: 'Registro',
                        text: 'Se pudo modificar el registro, ' + formData.modnombre,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo modificar el registro.',
                        icon: 'error'
                    });
                }

                // Limpiar los campos del formulario
                $('#ModMiInfoForm')[0].reset();
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error. Por favor, inténtalo de nuevo.',
                    icon: 'error'
                });
            }
        });
    });
/*   cambio de contraseña*/
    $('#menu-user-der').on('click', '#ModPassSubmit', function() {
        var formData = {
            formulario: 'ModPassForm',
            id_usuario: $('#id_usuario').val(),
            newpass: $('#nueva-contrasena').val(),
            confpass: $('#confirmar-contrasena').val(),

        };

        $.ajax({
            url: './process/ControlMenuUsuario.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                if (response === 'success') {
                    Swal.fire({
                        title: 'Registro',
                        text: 'Se Pudo Cambiar la Contraseña.' ,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se Pudo Cambiar la Contraseña.',
                        icon: 'error'
                    });
                }

                // Limpiar los campos del formulario
                $('#ModPassForm')[0].reset();
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error. Por favor, inténtalo de nuevo.',
                    icon: 'error'
                });
            }
        });
    });




});
        
    </script>