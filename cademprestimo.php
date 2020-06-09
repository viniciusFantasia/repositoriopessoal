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
    <?php
    session_start();
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
    ?>
        <h3>Cadastro</h3>
        <form name="form1" action="inseriremprestimo.php" method="POST">
            <label>Obra</label><br>
            <!--<input type="text" name="idpessoa" value="" placeholder="Digite o ID da obra" required>-->
            <select name="idobra">
            <?php
            $sqlobras="Select * from tbobras order by descricao";
            require_once "conexao.php";
            $resultobras = $conn->query($sqlobras);
            $dadosobras = $resultobras->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadosobras as $linhaobra) {
                echo "<option value='".$linhaobra["id"]."'>"
                .$linhaobra["descricao"]."</option>";                
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
        <a href="index.php">Voltar</a><br>

        <h2>Emprestimos</h2>
        <table>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Pessoa
                </th>
                <th>
                    Data e Hora do Emprestimo
                </th>
                <th>
                    Data e Hora da Devolução
                </th>
                <th>
                    Obra
                </th>
                <th>
                    Ações
                </th>
            </tr>
            <?php
            //$sql = "Select * from tbemprestimos order by datahoraemprestimo";
            $sql="Select e.id, e.idpessoa, p.nome as nomepessoa, 
            e.datahoraemprestimo,e.datahoradevolucao, e.idobra, o.descricao as descricaoobra 
            from tbemprestimos e JOIN tbpessoas p ON p.id = e.idpessoa 
            JOIN tbobras o ON o.id = e.idobra 
            order by datahoraemprestimo";
            /* Select e.id, concat(e.idpessoa,' - ',p.nome) as idpessoa, 
            e.datahoraemprestimo, e.datahoradevolucao, concat(e.idobra,' - ',o.descricao) 
            as idobra from tbemprestimos e JOIN tbpessoas p ON p.id = e.idpessoa 
            JOIN tbobras o ON o.id = e.idobra order by datahoraemprestimo
            */
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) {
                echo "<tr><td>" . $linha["id"] . "</td><td>" . $linha["nomepessoa"] . "</td><td> " . $linha["datahoraemprestimo"] . "</td>" .
                    "<td>" . $linha["datahoradevolucao"] . "</td><td>" . $linha["descricaoobra"] . "</td>" .
                    "<td><a href='editaremprestimo1.php?id=" . $linha["id"] . "'><i class='fa fa-pencil'></i></a> " .
                    "&nbsp;<a href='excluiremprestimo.php?id=" . $linha["id"] . "'><i class='fa fa-trash'></i></a> ";
                //if(empty($linha["datahoradevolucao"]) 
                //    || $linha["datahoradevolucao"]=="0000-00-00 00:00:00"){    
                    echo "&nbsp;<a href='devolucao.php?id=".$linha["id"]."'><i class='fa fa-check-circle'></i></a>";
                //}
                echo "</td></tr>";
            }
            ?>
        </table>
    <?php
    } else {
        echo "
        <h2>Obras Cadastradas</h2>
        <table>
        <tr>
            <th>
                ID
            </th>
            <th>
                Descrição
            </th>
            <th>
                Ano
            </th>
            <th>
                Tipo
            </th>
        </tr>";
        $sql = "Select * from tbobras order by descricao";
        require_once "conexao.php";
        $result = $conn->query($sql);
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados as $linha) {
            echo "<tr><td>" . $linha["id"] . "</td><td>" . $linha["descricao"] . "</td><td> " . $linha["ano"] . "</td>" .
                "<td>" . $linha["tipo"] . "</td>" .
                "</tr>";
        }
        ?>
    </table>
    <?php
    echo "<h3>Se gostou das obras, cadastre-se para realizar empréstimos!</h3>";
    echo "<a href='cadpessoa.php'>Cadastre-se</a>";
    echo "  ou  ";
    echo "<a href='login.php'>Faça o login</a><br>";
    echo "<a href='index.html'>Home</a><br>";
    }
    ?>
    
</body>

</html>