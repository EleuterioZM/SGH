<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Página de Administração</title>
    <style>
        #cardContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20%;
        }

        body {
            background-image: url('../img/pexels-pixabay-265087.jpg');
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
            <a class="navbar-brand" href="#">Página de Administração</a>
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

    <div class="container mt-4">
        <div class="row" id="cardContainer">
            <!-- Cards serão adicionados aqui dinamicamente -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.2.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function adicionarCard(titulo, descricao, tipo, link) {
            var cardContainer = document.getElementById("cardContainer");

            // Criação do card
            var card = document.createElement("div");
            card.className = "col-md-4 mb-4";

            // Estrutura do card
            card.innerHTML = `
               <div class="card shadow-sm">
                   <div class="card-header">
                       <h4 class="my-0 fw-normal">${titulo}</h4>
                   </div>
                   <div class="card-body">
                       <ul class="list-unstyled mt-3 mb-4">
                           <li>${descricao}</li>
                       </ul>
                       <a href="${link}" class="btn btn-${tipo} btn-block">Acessar</a>
                   </div>
               </div>
           `;

            // Adiciona o card ao container
            cardContainer.appendChild(card);
        }

        // Adiciona alguns cards como exemplo
        adicionarCard("Administradores", "Acesso total ao sistema", "danger", "Admin/admin_profile.php");
        adicionarCard("Usuários", "Funcionalidades padrão", "primary", "user_profile.php");
    </script>
</body>

</html>