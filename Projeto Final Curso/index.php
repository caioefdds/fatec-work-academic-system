<?php
//include "class/Connection.php";
include "class/Controller.php";

$__controller = new Controller;
$__conn = new Connection;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Final de Curso</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php?page=reports">Relatórios</a></li>
            <li><a href="index.php?page=create">Adicionar</a></li>
        </ul>
    </nav>

    <div class="main">
        <?php
        if (!empty($_GET['page'])) {
            include ("pages/{$_GET['page']}.php");
        } else {
            ?>
                <div class="presentation">
                    <h1>Bem-vindo!</h1>
                    <hr>
                    <h2>Sistema de Gestão Acadêmico.</h2>
                    <span>Selecione uma das opções acima para dar prosseguimento</span>
                </div>
            <?php
        }
        ?>
    </div>

    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>
