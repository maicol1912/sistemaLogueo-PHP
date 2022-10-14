<?php

    include('conector.php'); // se importa la coneccion

    #hacemos el llamado a travez de metodo post y llamamos a $con que es la conexion y los nombres de los input del formulario
    # mysqli_real_escape_string para evitar el sql inyection
    if(isset($_POST['Registrar'])){
        $nombre = mysqli_real_escape_string($con,$_POST['Nombre']);
        $correo = mysqli_real_escape_string($con,$_POST['Correo']);
        $usuario = mysqli_real_escape_string($con,$_POST['Usuario']);
        $clave = mysqli_real_escape_string($con,$_POST['Clave']);
        #creamos una variable en la que encriptaremos la clave  con un metodo sha1
        $claveEncriptada = sha1($clave);
        // hacemos una consulta para mirar si ya esta el usuario
        $consultaUsuario = "SELECT idUsuario FROM  usuarios WHERE  usuario = '$usuario'";
        $continuar = $con->query($consultaUsuario); //Este es el disparador para la consulta
        
        //recorrido por las filas 
        $filas = $continuar-> num_rows;
        if ($filas > 0) {
            #si encontro una coincidencia
            echo"
            <script>
                alert('El usuario ya existe')
                window.location = '../views/register.html'
            </script>
            
            ";
        }else{
            //insertar si no esta repetida
            $nuevoUsuario = " INSERT INTO usuarios(nombre,correo,usuario,clave) VALUES('$nombre', '$correo', '$usuario', '$claveEncriptada')";
            $continuarUsuario = $con->query($nuevoUsuario); //Este es el disparador para la consulta

            #confirmacion
            if ($continuarUsuario >0) {
                echo"
                <script>
                    alert('Usuario registrado con exito')
                    window.location = '../views/login.html'
                </script>
                
                ";    
            }else{
                echo"
                <script>
                    alert('Error al registrar')
                    window.location = '../views/register.html'
                </script>
                
                ";
            }
        }

    }
?>