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
        <h2>Livros que podem ser emprestados</h2>
        <table>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Obra
                </th>
                <th>
                    Ações
                </th>
            </tr>
            <?php
            $sql="SELECT DISTINCT o.*
            FROM tbobras o
            WHERE o.id
            NOT IN ( -- não está contido
            -- não foram devolvidos ainda select interno
            SELECT DISTINCT e.idobra
            FROM tbemprestimos e
            WHERE e.datahoradevolucao is null)";
           
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) {
                echo "<tr><td>" . $linha["id"] . "</td><td>" 
                    . $linha["descricao"] . "</td>" .
                    "<td><a href='emprestarlivro.php?id=" . $linha["id"] . "' alt='Emprestar' title='Emprestar'><i class='fa fa-share'></i></a>";
                echo "</td></tr>";
            }
            ?>
        </table>
    <?php
        echo "<br><a href='validarlogin.php'>Voltar</a>";       
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