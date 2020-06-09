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
        $idobra = $_GET['id'];
    ?>

    <h3>Cadastro</h3>
        <form name="form1" action="inseriremprestimo.php" method="POST">
            <label>Obra</label><br>
            <select name="idobra">
            <?php
            $sqlobras="SELECT DISTINCT o.*
            FROM tbobras o
            WHERE o.id
            NOT IN ( -- não está contido
            -- não foram devolvidos ainda select interno
            SELECT DISTINCT e.idobra
            FROM tbemprestimos e
            WHERE e.datahoradevolucao is null)";

            require_once "conexao.php";
            $resultobras = $conn->query($sqlobras);
            $dadosobras = $resultobras->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadosobras as $linhaobra) {
                if($idobra==$linhaobra["id"])
                    echo "<option value='".$linhaobra["id"]."' selected>";
                else
                    echo "<option value='".$linhaobra["id"]."'>";
                echo $linhaobra["descricao"]."</option>";                
            }
            ?>
            </select>


            <br><br>
            <label>Pessoa</label><br>
            <!--<input type="text" name="idobra" value="" placeholder="Digite ID da pessoa" required>-->
            <select name="idpessoa">
            <?php
            $sqlpessoas="Select * from tbpessoas order by nome";
            require_once "conexao.php";
            $resultpessoas = $conn->query($sqlpessoas);
            $dadospessoas = $resultpessoas->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadospessoas as $linhapessoa) {
                echo "<option value='".$linhapessoa["id"]."'>"
                .$linhapessoa["nome"]."</option>";                
            }
            ?>
            </select>
            <input type="submit" value="Salvar">
            <input type="reset" value="Cancelar">
        </form>
        <?php 
            echo "<p>Erro ao receber dados</p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
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