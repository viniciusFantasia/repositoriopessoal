<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <h1 class="textocentralizado">Biblioteca Pessoal</h1>

    <h3>Realize seu cadastro</h3>
<form name="form1" action="inserirpessoa.php" method="POST">
    <label>Nome</label><input type="text" name="nome" value="" placeholder="Digite o nome" required><br><br>
    <label>E-mail</label><input type="email" name="email" value="" placeholder="Digite o e-mail" required><br><br>
    <label>Telefone</label><input type="text" name="telefone" value="" placeholder="Digite o telefone" required><br><br>
    <label>Senha</label><input type="password" name="senha" value="" placeholder="Digite a senha" required><br><br>
    <label>Onde você estuda(ou)</label><input type="text" name="estudo" value="" 
        placeholder="Digite onde você estuda(ou)" required><br><br>
    <input type="submit" value="Enviar">
    <input type="reset" value="Cancelar">
</form>
<?php
    session_start();
    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim'){
    ?>
    <h2>Pessoas Cadastradas</h2>
    <table>
    <tr><th>id</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Estudos</th><th>Ações</th></tr>
    <?php
        $sql="Select * from tbpessoas order by nome";
        require_once "conexao.php";
        $result = $conn->query($sql);
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados as $linha) {
            echo "<tr><td>".$linha["id"]."</td><td>".$linha["nome"]."</td><td> ".$linha["email"]."</td>".
            "<td>".$linha["telefone"]."</td><td>".$linha["estudos"]."</td>".
            "<td><a href='editarpessoa1.php?id=".$linha["id"]."'><i class='fa fa-pencil'></i></a> ".
            "&nbsp;<a href='excluirpessoa.php?id=".$linha["id"]."'><i class='fa fa-trash'></i></a></td>".
            "</tr>";  
        }
    ?>
    </table><br><br>
    <a href="validarlogin.php">Voltar</a><br>
    <?php } ?>
</body>
</html>