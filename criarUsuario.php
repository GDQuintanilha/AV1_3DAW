<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $nomeArquivo = "usuarios.txt";

    if(!file_exists($nomeArquivo)){
        $arqUsuario = fopen($nomeArquivo, "w") or die("Erro ao criar arquivo");
        $cabecalho = "nome;email;senha\n";
        fwrite($arqUsuario, $cabecalho);
        fclose($arqUsuario);
    }

    $arqUsuario = fopen($nomeArquivo, "a") or die("Falha ao abrir o arquivo");
    
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arqUsuario, $linha);
    
    fclose($arqUsuario);

    $msg = "Usuário cadastrado com sucesso!";
}
?>

<html>
    <head>
        <title>Criar Usuário</title>
    </head>
    <body>
        <h1>Novo Usuário (Gestor)</h1>

        <form action="" method="POST">
            Nome do Gestor: <br>
            <input type="text" name="nome" required>
            <br><br>
            
            Email: <br>
            <input type="email" name="email" required>
            <br><br>
            
            Senha: <br>
            <input type="password" name="senha" required>
            <br><br>
            
            <input type="submit" value="Salvar Usuário">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>