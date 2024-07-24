<?php 
// Obtener el directorio del archivo actual 
$dir = __DIR__;
//  usando la ruta relativa
require_once $dir . '/../SQLs/consultasSQL.php';
//require_once $dir . '/../SQLs/ConectarSQL.php';

$usuario = $_SESSION['usuario'];
$sql = "SELECT USUARIO, EMAIL, TELEFONO, DIRECCION, PASSWORD FROM prodes.usuarios WHERE USUARIO = ?";
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
                <form>
                    <!-- Campos para editar la información del usuario -->
                    <div>
                        <label for="nombre"><i class="fa fa-user"></i> Nombre:</label>
                        <input type="text" id="nombre" name="nombre">
                    </div>
                    <div>
                        <label for="email"><i class="fa fa-envelope"></i> Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div>
                        <label for="telefono"><i class="fa fa-phone"></i> Teléfono:</label>
                        <input type="text" id="telefono" name="telefono">
                    </div>
                    <div>
                        <label for="direccion"><i class="fa fa-map-marker-alt"></i> Dirección:</label>
                        <input type="text" id="direccion" name="direccion">
                    </div>
                    <button type="submit">Guardar Cambios</button>
                </form>
            `;

            // Actualiza los valores de los campos con los datos del usuario
            document.getElementById('nombre').value = user.USUARIO;
            document.getElementById('email').value = user.EMAIL;
            document.getElementById('telefono').value = user.TELEFONO;
            document.getElementById('direccion').value = user.DIRECCION;

        } else if (formType === 'contrasena') {
            menuUserDer.innerHTML = `
                <h2>Cambiar Contraseña</h2>
                <form>
                    <!-- Campos para cambiar la contraseña -->
                    <div>
                        <label for="contrasena-actual"><i class="fa fa-lock"></i> Contraseña Actual:</label>
                        <input type="password" id="contrasena-actual" name="contrasena-actual">
                    </div>
                    <div>
                        <label for="nueva-contrasena"><i class="fa fa-key"></i> Nueva Contraseña:</label>
                        <input type="password" id="nueva-contrasena" name="nueva-contrasena">
                    </div>
                    <div>
                        <label for="confirmar-contrasena"><i class="fa fa-key"></i> Confirmar Nueva Contraseña:</label>
                        <input type="password" id="confirmar-contrasena" name="confirmar-contrasena">
                    </div>
                    <button type="submit">Cambiar Contraseña</button>
                </form>
            `;

            // Puedes también establecer valores aquí si fuera necesario
        }
    }
    </script>