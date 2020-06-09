<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1 class="textocentralizado">Biblioteca Pessoal</h1>
<?php
session_start();
session_destroy();
?>
    <h3>Realize seu login</h3>
<form name="form1" action="validarlogin.php" method="POST">
    <label>E-mail</label><input type="email" name="email" value="" placeholder="Digite o e-mail" required><br><br>
    <label>Senha</label><input type="password" name="senha" value="" placeholder="Digite a senha" required><br><br>
    <input type="submit" value="Enviar">
    <input type="reset" value="Cancelar">
</form>
<br><a href="index.html">Voltar</a>
</body>
</html>