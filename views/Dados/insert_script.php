<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../css/form.css" rel="stylesheet">
    <title>Cadastro de Usuarios</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&display=swap">
    <style>
        a {
            text-decoration: none;
            color: aliceblue;
        }
    </style>
</head>

<body>


    <nav>
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="false">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="bgimage1"></div>
    <div class="container">
        <div class="row">
            <?php

            include "conexao/conexao.php";

            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];

            $sql = "INSERT INTO `pacientes`(`id`, `username`, `password`, `phone`) VALUES ($id, '$username', '$password', '$phone')";

            if (mysqli_query($conn, $sql)) {
                msg("$username Cadastrado com sucesso", 'succes');
                header("Location: ../Pesquisar.php");
            } else {
                msg("$username Nao foi cadastrado", 'danger');
            }
            ?>
            <a href="../Pesquisar.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.2.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>