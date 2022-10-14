//

<?php
$nombreServidor = 'localhost';
$nombreUsuario = 'root'; //en usuarios 
$clave = '';
$nombreBaseDatos = 'miProyecto';


//creamos la variable de la conexion 

$con = new mysqli ($nombreServidor, $nombreUsuario, $clave, $nombreBaseDatos);


// condicion

if ($con -> connect_error){
    //mensaje si error
    die("Conexion fallida".$con ->connect_error);
}
echo "conexion establecida ";
?>