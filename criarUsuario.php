<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $nomeArquivo = "usuarios.txt";
    $msg = "";

    if(!file_exists($nomeArquivo)){
        $arqUsuario = fopen($nomeArquivo, "w");
        $cabecalho = "nome;email;senha\n";
        fwrite($arqUsuario, $cabecalho);
        fclose($arqUsuario);
    }

    $arqUsuario = fopen($nomeArquivo, "a");
    
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arqUsuario, $linha);
    
    fclose($arqUsuario);

    $msg = "Usuário cadastrado com sucesso!";

    header('Content-Type: application/json');
    echo json_encode(["mensagem" => $msg]);
    exit;
}
?>

<html>
    <head>
        <title>Criar Usuário</title>
    </head>
    <body>
        <h1>Novo Usuário (Gestor)</h1>

        <form id="formCriarUsuario" onsubmit="criarUsuario(event)">
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
        
        <p><strong id="mensagemNaTela"></strong></p>

        <script>
            function criarUsuario(evento) {
                evento.preventDefault();
                
                let formulario = document.getElementById("formCriarUsuario");
                let dados = new FormData(formulario);

                fetch(window.location.href, {
                    method: 'POST',
                    body: dados
                })
                .then(resposta => resposta.json())
                .then(retorno => {
                    document.getElementById("mensagemNaTela").innerHTML = retorno.mensagem;
                    formulario.reset();
                });
            }
        </script>
    </body>
</html>
