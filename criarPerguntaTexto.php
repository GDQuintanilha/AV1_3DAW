<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST['idPergunta'];
    $enunciado = $_POST['enunciado'];
    $resposta = $_POST['resposta'];
    
    $nome_arquivo = "perguntasTexto.txt";

    if(!file_exists($nome_arquivo)){
        $arqPergunta = fopen($nome_arquivo, "w") or die("Erro ao criar arquivo");
        $cabecalho = "id;enunciado;resposta\n";
        fwrite($arqPergunta, $cabecalho);
        fclose($arqPergunta);
    }

    $arqPergunta = fopen($nome_arquivo, "a") or die("Falha ao abrir o arquivo");
    
    $linha = $idPergunta . ";" . $enunciado . ";" . $resposta . "\n";
    fwrite($arqPergunta, $linha);
    
    fclose($arqPergunta);

    $msg = "Pergunta de texto cadastrada com sucesso!";
}
?>

<html>
    <head>
        <title>Criar Pergunta de Texto</title>
    </head>
    <body>
        <h1>Nova Pergunta de Texto</h1>
        <p>Preencha os dados do desafio para o treinamento corporativo.</p>

        <form action="" method="POST">
            ID da Pergunta (Ex: P01): <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            
            Enunciado da Pergunta: <br>
            <textarea name="enunciado" rows="4" cols="50" required></textarea>
            <br><br>
            
            Resposta Esperada do Gestor: <br>
            <input type="text" name="resposta" required>
            <br><br>
            
            <input type="submit" value="Salvar Pergunta">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>