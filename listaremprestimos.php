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
        <h2>Livros emprestados</h2>
        <table>
            <tr>
                <th>
                    ID
                </th>
                <th width="60%">
                    Obra
                </th>
                <th>
                    Data Empréstimo
                </th>
                <th>
                    Ações
                </th>
            </tr>
            <?php
            if (isset($_GET['f']) && $_GET['f']=="my"){
                $filtro = $_GET['f'];
                $sql="SELECT e.*, p.nome, o.descricao 
                    FROM tbemprestimos e JOIN tbpessoas p 
                    ON e.idpessoa = p.id JOIN tbobras o 
                    ON e.idobra = o.id WHERE e.datahoradevolucao is null
                    and p.id = " . $_SESSION['idusuario'].
                    " order by o.descricao";
            } else {
                $sql="SELECT e.*, p.nome, o.descricao 
                FROM tbemprestimos e JOIN tbpessoas p 
                ON e.idpessoa = p.id JOIN tbobras o 
                ON e.idobra = o.id WHERE e.datahoradevolucao is null
                order by o.descricao"; }
           
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) {
                echo "<tr><td>" . $linha["id"] . "</td><td>" 
                    . $linha["descricao"] . "</td>" .
                    "<td>" . $linha["datahoraemprestimo"] . "</td>
                    <td><a href='devolucao.php?id=".$linha["id"]."' alt='Devolver' title='Devolver'><i class='fa fa-check-circle'></i></a>".
                    "</td></tr>";
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