<?php
    include('conector.php');
    if(!empty($_POST)){
        $usuario=mysqli_real_escape_string($con,$_POST['Usuario']);
        $pass=mysqli_real_escape_string($con,$_POST['Clave']);
        $pass_encrip = sha1($pass);

        $consultaSql = "SELECT idUsuario FROM usuarios WHERE usuario='$usuario' AND clave='$pass_encrip'";
        #ejecucion de la sentencia de sql
        $resultado = $con->query($consultaSql);
        $rows = $resultado->num_rows;
        
        if($rows>0){
            $row=$resultado->fetch_assoc();
            $_SESSION['iduser'] = $row['idUsuario'];
            echo"<script>
                 alert('se logueo con exito')
                 window.location='usuarios.php'
                 </script>";
           #header("Location:usuarios.php");
        }else{
            echo"<script>
                 alert('usuario o password incorrecto')
                 window.location='../views/login.html'
                 </script>";
        }
        
    }

?>