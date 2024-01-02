<?php
include "Dados/conexao/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];

    $sql = "SELECT * FROM `pacientes` WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Usuário não encontrado.";
        exit;
    }

    mysqli_free_result($result);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $userId = $_POST["id"];
    $newUsername = $_POST["username"];
    $newPassword = $_POST["password"];
    $newPhone = $_POST["phone"];

    $sql = "UPDATE `pacientes` SET username = '$newUsername', password = '$newPassword', phone = '$newPhone' WHERE id = $userId";

    if (mysqli_query($conn, $sql)) {
        header("Location: Pesquisar.php"); // Redireciona para a página de pesquisa após a atualização
        exit;
    } else {
        echo "Erro ao atualizar usuário: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="../css/forms.css" rel="stylesheet">
    <title>Editar Usuário</title>

    <style>
        body {
            background-image: url('../img/pexels-carsten-vollrath-6236665.jpg');
            /* Substitua com o caminho para sua imagem */

            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            background-size: 100%;
            width: 100%;
            height: 90vh;
        }
    </style>


</head>

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



    <form action="Actualizar.php" method="post" style="height: 30vw; width: 27vw;">
        <h3>U P D A T E </h3>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
        <button type="submit" class="btn btn-success" style="margin-top: 15px;">update_form</button>

    </form>
    <script src="https://code.jquery.com/jquery-3.6.2.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>