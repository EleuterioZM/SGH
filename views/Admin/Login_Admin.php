<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="../../css/forms.css" rel="stylesheet">
    <title>Cadastro de Usuarios</title>


    <style>
        body {
            background-image: url('../../img/pexels-tara-winstead-7723528.jpg');
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            background-size: cover;
            width: 100%;
            height: 80vh;
        }
    </style>

</head>
<?php
include "../Dados/conexao/conexao.php";

function verificarAdmin($conn, $email)
{
    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM administradores WHERE email = ?";

    // Usando Prepared Statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $adminData = verificarAdmin($conn, $email);

    if ($adminData && $senha === $adminData['senha']) {
        // O usuário é um administrador, faça o que for necessário
        echo "<script>
                alert('Login bem-sucedido como administrador!');
                window.location.href = 'admin_profile.php';
              </script>";
        exit();
    } else {
        // O usuário não é um administrador ou a senha está incorreta
        echo "Erro: Usuário não é um administrador ou senha incorreta.";
        // Adicione o script JavaScript para mostrar um alerta e redirecionar
        echo "<script>
                alert('Erro: Usuário não é um administrador ou senha incorreta.');
                window.location.href = '../Administração.php'; // Redireciona para a página inicial
              </script>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
        </div>
    </nav>
    <div class="admin_login"></div>

    <form id="formPost" method="post" style="height: 25vw; width: 30vw;">

        <h3>ADMIN_LOGIN</h3>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit" id="btn">Log In</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.2.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>