<?php
    include('includes/db.php');
    if(isset($_GET['id']) == false){
        echo "Es necesario enviar un id";
        die;
    }
    $id = $_GET['id'];
    $sql = "select * from usuarios where id= $id";
    $persona = DB::query($sql);
    $persona = mysqli_fetch_object($persona);
    if($persona == false){
        echo "El usuario no existe";
        die;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="center">
        <font color="black" size="7">EDITAR USUARIO</font>
    </div>

    <div>
    <form action="guardar.php" method="post">
    <input type="hidden" name="id" value="<?= $persona->id ?>">
        <table class="table">
            <thead>
            <tr>
                <th>NoOMBRES</th>
                <th>APELLIDOS</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ESTADO</th>
            </tr>
            </thead>

            <tbody class="center">
            <tr>
                <td><input type="text" name="nombre" size="40" value="<?= $persona->nombres ?>" maxlength="50"></td>
                <td><input type="text" name="apellido" size="40" value="<?= $persona->apellidos ?>" maxlength="50"></td>
                <td><input type="text" name="email" size="40" value="<?= $persona->email?>" maxlength="255"></td>
                <td><input type="password" name="password" size="40" value="" maxlength="20"></td>
                <td>
                <?php  if($persona->estado == "activo"){  ?>
                    <input type="radio" name="estado" value="activo" checked>Activo<br>
                    <input type="radio" name="estado" value="inactivo">Inactivo
                <?php  }else{  ?>
                    <input type="radio" name="estado" value="activo" >Activo<br>
                    <input type="radio" name="estado" value="inactivo" checked>Inactivo
                <?php  }  ?>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <br><button type="submit" class="btn btn-yellow">Guardar</button>
                    <a href="index.php" class="btn btn-red">Cancelar</a>

                </td>
            </tr>
            </tbody>
        </table>
    </form>
    </div>
</div>

</body>
</html>