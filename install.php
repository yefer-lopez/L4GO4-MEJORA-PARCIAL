<?php 
    if(isset($_POST["host"])){
        //Escribir en el archivo config las variables de conexión
        $file = fopen("includes/config.php", "w");

        fwrite($file, "<?php" . PHP_EOL);
        fwrite($file, "define('HOST', '" . $_POST['host'] ."');" . PHP_EOL);
        fwrite($file, "define('USER', '" . $_POST['user'] ."');" . PHP_EOL);
        fwrite($file, "define('PASSWORD', '" . $_POST['password'] ."');" . PHP_EOL);
        fwrite($file, "define('DB', '" . $_POST['db'] ."');" . PHP_EOL);
        fwrite($file, "?>");

        fclose($file);

        echo "Creando arcivo de conexion";
        //Importando la base de datos
        $sql = file_get_contents('includes/datos.sql');
        include('includes/db.php');

        if(DB::getConnection()->multi_query($sql)){
            echo "Base de datos importada correctamente";
            header('location: index.php');
            unlink('install.php');
        }else{
            echo "No se ha podido importar la base de datos, verifique los errores";
        }
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="install.php" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2"><font color="black" size="5">Para el correcto funcionamiento del sistema llena la siguiente información:</font></th>
                </tr>
            </thead>

            <tbody class="center">
                <tr>
                    <td><font color="black" size="3"><b>Host:</b></font></td>
                    <td><input type="text" name="host" placeholder="localhost"></td>
                </tr>

                <tr>
                    <td><font color="black" size="3"><b>Usuario DB:</b></font></td>
                    <td><input type="text" name="user" placeholder="root"></td>
                </tr>

                <tr>
                    <td><font color="black" size="3"><b>Contrasña DB:</b></font></td>
                    <td><input type="text" name="password"></td>
                </tr>

                <tr>
                    <td><font color="black" size="3"><b>Base de datos:</b></font></td>
                    <td><input type="text" name="db" placeholder="datos"></td>
                </tr>

                <tr>
                    <td colspan="2"><button class="btn btn-green">Guardar</button></td>
                </tr>
            </tbody>
        </table>
    </form>
    </div>
</body>
</html>