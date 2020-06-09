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
    <h3>Editar Emprestimo</h3>
    <?php
    session_start();
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "Select * from tbemprestimos where id=$id";
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) { ?>
                <form name="form1" action="editaremprestimo2.php" method="POST" class="textocentralizado">
                    <label>Id: </label><?php echo $linha['id']; ?> <br>
                    <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                    <label>Pessoa</label>
                    <input type="text" name="idpessoa" value="<?php echo $linha['idpessoa']; ?>" placeholder="Digite o id da pessoa" required><br><br>
                    <label>Data e Hora do Emprestimo</label>
                    <input type="text" name="datahoraemprestimo" value="<?php echo $linha['datahoraemprestimo']; ?>" placeholder="" required><br><br>
                    <label>Data e hora da Devolução</label>
                    <input type="text" name="datahoradevolucao" value="<?php echo $linha['datahoradevolucao']; ?>" placeholder=""><br><br>
                    <label>Obra</label>
                    <input type="text" name="idobra" value="<?php echo $linha['idobra']; ?>" placeholder="Digite o id da obra" required><br><br>
                    <input type="submit" value="Salvar">
                    <input type="reset" value="Cancelar">
                </form>
    <?php
            }
        } else {
            echo "<p>Erro ao receber dados</p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
        }
    } else {
        echo "<h3>Se gostou das obras, cadastre-se para realizar empréstimos!</h3>";
        echo "<a href='cadpessoa.php'>Cadastre-se</a>";
        echo "  ou  ";
        echo "<a href='login.php'>Faça o login</a><br>";
        echo "<a href='index.html'>Home</a><br>";
    }
    ?>
</body>

</html>