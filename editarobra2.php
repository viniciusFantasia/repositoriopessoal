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
    <h3>Dados</h3>
    <?php
    session_start();
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        if (isset($_POST['nome']) && isset($_POST['email']) 
        && isset($_POST['senha'])  && isset($_POST['telefone'])  && isset($_POST['estudo'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $tel = $_POST['telefone'];
            $estudo = $_POST['estudo'];

            // echo "<p> Nome: $nome</p>";
            // echo "<p> E-mail: $email</p>";
            // echo "<p> Senha: $senha</p>";
            // echo "<p> Tel: $tel</p>";
            // echo "<p> Estudos: $estudo</p>";

            //montar a instrução SQL
            $sql="update tbpessoas set 
            nome = '$nome',
            email = '$email',
            senha = '$senha',
            tel = '$tel',
            estudo = '$estudo'
            where id='$id'";
            //echo $sql;
            require_once "conexao.php";
            $conn->exec($sql);
            echo "<p>Salvo com sucesso</p>";
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