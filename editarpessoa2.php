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
<body>
    <?php
    session_start();
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        if(isset($_POST['nome']) && isset($_POST['email']) 
        && isset($_POST['senha']) && isset($_POST['telefone'])
        && isset($_POST['estudo'])){
            $id=$_POST['id'];
            $nome=$_POST['nome'];
            $email=$_POST['email'];
            $senha=$_POST['senha'];
            $tel=$_POST['telefone'];
            $estudo=$_POST['estudo'];
            $sql="update tbpessoas set nome='$nome',email='$email',
            senha='$senha',telefone='$tel',estudos='$estudo' where id=$id";
            require_once "conexao.php";
            $conn->exec($sql);
            echo "<p>Atualizado com sucesso</p>"; 
            echo "<a href='validarlogin.php'>Voltar</a>";       
        } else {
            echo "<p>Erro ao receber dados</p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
            }
    }else {
        echo "<h3>Se gostou das obras, cadastre-se para realizar empréstimos!</h3>";
        echo "<a href='cadpessoa.php'>Cadastre-se</a>";
        echo "  ou  ";
        echo "<a href='login.php'>Faça o login</a><br>";
        echo "<a href='index.html'>Home</a><br>";
    }
?>
</body>
</html>