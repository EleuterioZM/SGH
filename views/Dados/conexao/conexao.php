<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "centro_saude";

if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
    //echo "conexao estabelecida com sucesso";

} else {
    echo "houve um problema na conexao";
}

function msg($texto, $tipo)
{
    echo "<div class='alert alert-$tipo' role='alert'>
$texto
</div>";
}
