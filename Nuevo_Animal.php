<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Nuevo Animal</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <h3>Nuevo Animal</h3>
                <hr>
                <?php
                include('Config.php');
                session_start();

                if (isset($_POST['AgregarUsuario'])) 
                {
                    $nombre_mascota = $_POST['nombre_mascota'];
                    $raza= $_POST['raza'];
                    $password = $_POST['password'];
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $query = $conn->prepare("SELECT * FROM nombre_mascota WHERE raza=:raza");
                    $query->bindParam("raza", $raza, PDO::PARAM_STR);
                    $query->execute();

                    if ($query->rowCount() > 0) 
                    {
                        echo '<div class="alert alert-danger" role="alert">
                                    ¡La dirección de correo electrónico ya está registrada!
                              </div>';
                    }

                    if ($query->rowCount() == 0) {
                        $query = $conn->prepare("INSERT INTO Nombre_mascota (nombre_mascota, Password, raza) VALUES (:nombre_mascota,:password_hash,:raza)");
                        $query->bindParam("nombre_mascota", $nombre_mascota, PDO::PARAM_STR);
                        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                        $query->bindParam("raza", $raza, PDO::PARAM_STR);
                        $result = $query->execute();

                        if ($result) 
                        {
                            echo '<div class="alert alert-success" role="alert">Tu registro fue exitoso!</div>';
                        } 
                        else 
                        {
                            echo '<div class="alert alert-danger" role="alert">¡Algo salió mal!</div>';
                        }
                    }
                }
                ?>

                <form method="post">
                    <div class="form-group">
                        <label for="nombre_mascota">Nombre de la Mascota</label>
                        <input id="nombre_mascota" class="form-control" type="text" name="nombre_mascota">
                    </div>

                    <div class="form-group">
                        <label for="raza">Raza</label>
                        <input id="raza" class="form-control" type="raza" name="raza">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div>

                    <br>

                    <div class="d-grid gap-2 d-md-block text-center">
                        <a class="btn btn-secondary col-5" href="Index.php">Cancelar</a>
                        <button class="btn btn-primary col-5" name="AgregarAnimal" type="submit">Registrar Animal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>