<?php 
$dir = __DIR__;
require_once $dir . '/config/config.php';
session_start(); // Asegúrate de que la sesión esté iniciada 
// Define $sec si no está definido en $_GET
$sec = isset($_GET['sec']) ? $_GET['sec'] : 'sesiones';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fonts/remixicon.css"> <!-- Iconos de RemixIcon -->
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./sweetalert/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">    me baje el link-->
    <link rel="icon" type="image/x-icon" href="<?php echo NOM_IMG_PAGINA; ?>">

    <?php    // Carga el CSS específico de la sección si existe
        $cssFile = "./css/" . $sec . ".css";
        if (file_exists($cssFile)) {
            echo '<link rel="stylesheet" href="'.$cssFile.'">';
        } 
    ?>
    <style>
   body {
    background: url('<?php echo IMG_FONDO; ?>') no-repeat center center fixed;
    }
    </style>
    <title><?php echo NOM_FANTACIA; ?></title>
</head>
<body>
    <nav id="navbar">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a href="#" class="enlace">
            <img src="<?php echo NOM_FANTACIA_IMG; ?>" alt="" class="logo">
        </a>
        <ul>
            <li><a class="active" href="?sec=sesiones">Inicio</a></li>
            <li><a href="#">Nosotros</a></li>
            <li><a href="?sec=Registracion">Registrarse</a></li>
            <?php 
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == '') {
            ?>
           <li><a href="#" id="loginBtn">
                <i class="ri-user-fill"></i>
                <span>Login</span>
            </a></li>
  
            
            <?php }
            else if ($_SESSION['usuario']=='admin'){
            ?>
            <li><a href="#">Administrador</a></li>
            <li><a href="#" onclick="confirmLogout()" id="logoutBtn">
                <i class="ri-user-fill"></i>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </a></li>
            <?php }
                 else {
            ?>            
            
              <li><a href="?sec=MenuUsuario">Menu</a></li>
              <li><a href="#" onclick="confirmLogout()" id="logoutBtn">
              <i class="ri-user-fill"></i>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </a></li>
 
            <?php
            }
            ?>  

        </ul>
    </nav>

    <div class="container" id="mainContainer">
        <!-- Contenido dinámico cargado aquí -->
        <?php
            if ($_GET) {
                $sec = $_GET["sec"];
                if (file_exists("./process/" . $sec . ".php"))
                    include("./process/" . $sec . ".php");
                elseif (file_exists("./process/" . $sec . ".html"))
                    include("./process/" . $sec . ".html");
                else
                    echo 'Perdón pero la página solicitada no existe';
            } else {
                include("./process/sesiones.php");
                //include("./process/blank.php");
            }
        ?>
    </div>

    <footer>
        <p>Contacto: info@catlover.com | Telefono: (123) 456-7890</p>
        <div class="social-icons">
        <a href="#"><i class="ri-facebook-box-fill"></i><span class="footer-title">Facebook</span></a>
        <a href="#"><i class="ri-instagram-line"></i><span class="footer-title">Instagram</span></a>
    </div>
    <p>&copy; <?php echo TITLE_FOOTER; ?> Todos los derechos reservados.</p>
    </footer>

    <!-- Contenedor del modal de login --  -->
    <div id="loginModalContainer"></div>  
    <!-- Modal -->
  

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script  src="./js/menu.js"></script>
<!-- envia los los datos -->
<script  src="./js/ControlIngreso.js"></script>
<script src="./js/mensajes.js"></script>  
<script  src="./sweetalert/sweetalert2@11.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    -->
<?php        // Carga el JS específico de la sección si existe
    $jsFile = "./js/" . $sec . ".js";
    if (file_exists($jsFile)) {
    echo '<script src="'.$jsFile.'"></script>';
    }
?>

</body>
</html>
