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
    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim'){
?>
    <h3>Cadastre sua obra</h3>
    <form name="form1" action="inserirobra.php" method="POST">
    <label>Descrição</label><input type="text" name="descricao" value="" placeholder="Digite a descrição" required><br><br>
    <label>Ano</label><input type="number" name="ano" value="" placeholder="Digite o ano" required><br><br>
    <label>Pessoa</label>
    
    <!-- <input type="text" name="pessoa" value="" placeholder="Digite a Pessoa" required><br><br> -->
    <select name="pessoa">
    <?php
    $sqlpessoas="Select * from tbpessoas order by nome";
    require_once "conexao.php";
    $resultpessoas = $conn->query($sqlpessoas);
    $dadospessoas = $resultpessoas->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadospessoas as $linhapessoa) {
        if($_SESSION["idusuario"]==$linhapessoa["id"])
            echo "<option value='".$linhapessoa["id"]."' selected>";
        else
            echo "<option value='".$linhapessoa["id"]."'>";
        echo $linhapessoa["nome"]."</option>";                
    }
    ?>
    </select><br><br>    
    <label>Tipo</label>
    <select name="tipo">
        <option value="Livro">Livros</option>
        <option value="Revista">Revistas</option>
        <option value="Jogo">Jogos</option>
        <option value="Software">Softwares</option>
        <option value="Equipamento">Equipamentos</option>
        <option value="Outros">Outros itens</option>
    </select>
    <br><br>
    <input type="submit" value="Enviar">
    <input type="reset" value="Cancelar">
</form>

    <h2>Obras Cadastradas</h2>
    <table>
    <tr><th>id</th><th width="60%">Descrição</th><th>Ano</th><th>Pessoa</th><th>Tipo</th><th>Ações</th></tr>
    <?php
        $sql="Select o.*,p.id as idpessoa, p.nome from tbobras o, tbpessoas p
        where o.idpessoa=p.id order by o.descricao";
        require_once "conexao.php";
        $result = $conn->query($sql);
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados as $linha) {
            echo "<tr><td>".$linha["id"]."</td><td>".$linha["descricao"]."</td><td> ".$linha["ano"]."</td>".
            "<td>".$linha["nome"]."</td><td>".$linha["tipo"]."</td>".
            "<td><a href='editarobra1.php?id=".$linha["id"]."'><i class='fa fa-pencil'></i></a> ".
            "&nbsp;<a href='excluirobra.php?id=".$linha["id"]."'><i class='fa fa-trash'></i></a></td>".
            "</tr>";  
        }
        echo "</table><br><br>";
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