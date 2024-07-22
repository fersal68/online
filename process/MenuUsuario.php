
    <style>


        .menu-user-titulo {
            text-align: center;
            margin: 20px 0;
            font-family: Arial, sans-serif;          
        }

        .menu-user-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu-user-izq,
        .menu-user-der {
            width: 90%;
            margin: 10px 0;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .menu-user-izq {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .menu-user-item {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .menu-user-item img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .imagen-central {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media(min-width: 768px) {
            .menu-user-container {
                flex-direction: row;
                justify-content: center;
                align-items: flex-start;
            }

            .menu-user-izq,
            .menu-user-der {
                width: 45%;
                margin: 0 10px;
            }
        }
    </style>

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
        }
    }
    </script>
