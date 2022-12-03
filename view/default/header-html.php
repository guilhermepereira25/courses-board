<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= $documentTitle ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
 <?php if ($show_header == true): ?>
        <nav class="navbar navbar-dark bg-dark mb-2">
            <a class="navbar-brand" href="listar-cursos">Home</a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="logout">Sair</a>
                </li>
            </ul>
        </nav>
<?php endif; ?>

    <div class="container">
<?php if ($show_title == true) : ?>
            <div class="jumbotron">
                <h1><?= $titulo ?></h1>
            </div>
<?php endif; ?>
    
<?php  if ($can_show_alerts == true && isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?>">
            <?= $_SESSION['message']; ?>
        </div>

        <?php unset($_SESSION['message']); ?>
        <?php unset($_SESSION['message_type']); ?>
<?php endif; ?>