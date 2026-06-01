<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST['idPergunta'];
    $enunciado = $_POST['enunciado'];
    $resposta = $_POST['resposta'];
    
    $nomeArquivo = "perguntasTexto.txt";
    $msg = "";

    if(!file_exists($nomeArquivo)){
        $arqPergunta = fopen($nomeArquivo, "w");
        $cabecalho = "id;enunciado;resposta\n";
        fwrite($arqPergunta, $cabecalho);
        fclose($arqPergunta);
    }

    $arqPergunta = fopen($nomeArquivo, "a");
    
    $linha = $idPergunta . ";" . $enunciado . ";" . $resposta . "\n";
    fwrite($arqPergunta, $linha);
    
    fclose($arqPergunta);

    $msg = "Pergunta de texto cadastrada com sucesso!";

    header('Content-Type: application/json');
    echo json_encode(["mensagem" => $msg]);
    exit;
}
?>

<html>
    <head>
        <title>Criar Pergunta de Texto</title>
    </head>
    <body>
        <h1>Nova Pergunta de Texto</h1>
        <p>Preencha os dados do desafio para o treinamento corporativo.</p>

        <form id="formCriarTexto" onsubmit="criarPerguntaTexto(event)">
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
        
        <p><strong id="mensagemNaTela"></strong></p>

        <script>
            function criarPerguntaTexto(evento) {
                evento.preventDefault();
                
                let formulario = document.getElementById("formCriarTexto");
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
