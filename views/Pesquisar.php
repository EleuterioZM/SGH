<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
    <?php
    include "Dados/conexao/conexao.php";

    $pesquisa = isset($_POST['Search']) ? $_POST['Search'] : '';
    $itensPorPagina = 4; // Quantidade de itens por página
    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1
    $offset = ($paginaAtual - 1) * $itensPorPagina;

    if (!empty($pesquisa)) {
        $sql = "SELECT * FROM `pacientes` WHERE username LIKE '%$pesquisa%' LIMIT $itensPorPagina OFFSET $offset";
        $sqlCount = "SELECT COUNT(*) as total FROM `pacientes` WHERE username LIKE '%$pesquisa%'";
    } else {
        $sql = "SELECT * FROM `pacientes` LIMIT $itensPorPagina OFFSET $offset";
        $sqlCount = "SELECT COUNT(*) as total FROM `pacientes`";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $dados = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($conn);
    }

    // Contagem total de páginas
    $resultCount = mysqli_query($conn, $sqlCount);
    $totalRegistros = mysqli_fetch_assoc($resultCount)['total'];
    $totalPaginas = ceil($totalRegistros / $itensPorPagina);

    mysqli_free_result($result);
    mysqli_free_result($resultCount);
    mysqli_close($conn);
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
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
                                <form action="Pesquisar.php" method="post">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Operacoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dados as $tupla) {
                            $id = $tupla['id'];
                            $username = $tupla['username'];
                            $password = $tupla['password'];
                            $phone = $tupla['phone'];

                            echo "<tr>
                                <td scope='row'>$username</td>
                                <td>$password</td>
                                <td>$phone</td>
                                <td>
                                  
                                    <a href='Actualizar.php?id=$id' class='btn btn-success'>Actualizar</a>
                                    <a href='Cadastrar.php' class='btn btn-primary'>Adicionar</a>

                                    <a href='Deletar.php?id=$id' class='btn btn-danger' onclick='confirmDelete($id)'>Deletar</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>

                </table>
                <div class="pagination justify-content-center">
                    <ul class="pagination">
                        <?php

                        if ($paginaAtual > 1) {
                            echo "<li class='page-item'><a class='page-link' href='Pesquisar.php?pagina=" . ($paginaAtual - 1) . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                        }

                        for ($i = 1; $i <= $totalPaginas; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='Pesquisar.php?pagina=$i'>$i</a></li>";
                        }


                        if ($paginaAtual < $totalPaginas) {
                            echo "<li class='page-item'><a class='page-link' href='Pesquisar.php?pagina=" . ($paginaAtual + 1) . "' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.2.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function confirmDelete(userId) {
                var result = confirm("Tem certeza que deseja deletar este usuário?");

                if (result) {
                    // Se confirmado, redirecione para o script de exclusão
                    window.location.href = 'Deletar.php?id=' + userId;
                }
            }
        </script>
</body>

</html>