<?php 
    include('includes/db.php');
    if(isset($_GET['estado']) == TRUE){//ACTIVAR O INACTIVAR
        $estado = $_GET['estado'];
        $id = $_GET['id'];
        if($estado=="activo"){
            $es = "inactivo";
        }else{
            $es = "activo";
        }
        $sql = "UPDATE usuarios set estado='$es' WHERE id='$id'";
    }else{
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $estado = $_POST['estado'];

        if(isset($id) == false){//GUARDAR USUARIO NUEVO
            if($email=="" || $password==""){
                echo "<script>
                        alert('Es necesario llenar los campos obligatorios');
                        window.history.go(-1);
                    </script>
                    ";
                die;
            }else{
                $comprobar_email = "SELECT * FROM usuarios WHERE email = '$email'";
                $comprobar_password = "SELECT * FROM usuarios WHERE password = MD5('$password')";
                $remail = DB::query($comprobar_email);
                $rpassword = DB::query($comprobar_password);
                if(mysqli_num_rows($remail) > 0)
                {
                    echo "<script>
                            alert('El correo ya esta registrado');
                            window.history.go(-1);
                        </script>
                        ";
                    die;
                }else if(mysqli_num_rows($rpassword) > 0){
                    echo "<script>
                            alert('La contraseña ya esta registrada');
                            window.history.go(-1);
                        </script>
                        ";
                    die;
                }else{
                    $estado = "activo";
                    $sql = "insert into usuarios(nombres,apellidos,email,password,estado) values('$nombre','$apellido','$email',MD5('$password'),'$estado')"; 
                }
            }
        }else{//EDITAR UN REGISTRO
            if($email==""){
                echo "  <script>
                        alert('Es necesario llenar los campos obligatorios');
                        window.history.go(-1);
                        </script>
                    ";
                die;
            }else{
                if($password != ""){
                    $sql = "UPDATE usuarios set nombres='$nombre', apellidos='$apellido',email='$email',password=MD5('$password'),estado='$estado' WHERE id='$id'";
                }else{
                    $sql = "UPDATE usuarios set nombres='$nombre', apellidos='$apellido',email='$email',estado='$estado' WHERE id='$id'";
                }
            }
        }
    }
    DB::query($sql);
    header('Location: index.php');
?>
