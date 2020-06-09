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
if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
    echo "<p>Seja bem vindo(a) ". $_SESSION["nomeusuario"]."</p>";
    echo "<a href='editarpessoa1.php'>Perfil</a><br>";
    echo "<a href='cadobra.php?f=all'>Manutenção de Obras</a><br>";
    echo "<a href='cadobra.php?f=my'>Minhas Obras</a><br>";
    echo "<a href='cadpessoa.php'>Manutenção de Pessoas</a><br>";
    echo "<a href='realizaremprestimo.php'>Realizar Empréstimos</a><br>";
    echo "<a href='listaremprestimos.php?f=all'>Listar livros emprestados/ Devolução</a><br>";
    echo "<a href='listaremprestimos.php?f=my'>Meus livros emprestados/ Devolução</a><br><br>";
    echo "<a href='login.php'>Logout</a><br>";
}else {
    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email=$_POST['email'];
        $senha=$_POST['senha'];
        $sql="Select * from tbpessoas where email='$email' and senha='$senha'";
        require_once "conexao.php";
        $result = $conn->query($sql);
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        if ($result->rowCount() == 1) { //se o login está ok
            foreach ($dados as $linha) { //pega os dados do login (pessoa)
                $_SESSION["logado"] = 'sim';
                $_SESSION["idusuario"] = $linha["id"];
                $_SESSION["nomeusuario"] = $linha["nome"];
                echo "<p>Seja bem vindo(a) ". $_SESSION["nomeusuario"]."</p>";
                echo "<a href='editarpessoa1.php'>Perfil</a><br>";
                echo "<a href='cadobra.php'>Cadastrar Obras/ Devolução</a><br>";
                echo "<a href='cadpessoa.php'>Cadastrar Pessoas</a><br>";
                echo "<a href='realizaremprestimo.php'>Realizar Empréstimos</a><br>";
                echo "<a href='listaremprestimos.php'>Listar livros emprestados</a><br><br>";
                echo "<a href='login.php'>Logout</a><br>";
            }
        }else {
            $_SESSION["logado"] = 'não';
            $_SESSION["idusuario"] = 0;
            echo "<p>Usuário ou senha inválidos<p>";
            echo "<a href='login.php'>Faça o login</a>" ;
        }
    } else {
        $_SESSION["logado"] = 'não';
        $_SESSION["idusuario"] = 0;
        echo "<p>Erro ao receber dados</p>";
        echo "<a href='login.php'>Faça o login</a>" ;
    }
}
    ?>
    </table>
</body>
</html>