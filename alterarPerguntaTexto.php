<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST['idPergunta'];
    $enunciado = $_POST['enunciado'];
    $resposta = $_POST['resposta'];
    
    $perguntaEncontrada = false;
    $listaNova = "";
    
    $nomeArquivo = "perguntasTexto.txt"; 
    $msg = "";

    if(file_exists($nomeArquivo)){
        $linhas = file($nomeArquivo);
        $quantidadeLinhas = count($linhas);
        $i = 0;

        while($i < $quantidadeLinhas){
            $linhaAtual = $linhas[$i];

            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);

                if($pedacos[0] == $idPergunta) {
                    $linhaNova = $idPergunta . ";" . $enunciado . ";" . $resposta . "\n";
                    $listaNova = $listaNova . $linhaNova;
                    $perguntaEncontrada = true;
                } else {
                    $listaNova = $listaNova . $linhaAtual;
                }
            }
            $i++;
        }

        if ($perguntaEncontrada == true) {
            $arqPergunta = fopen($nomeArquivo, "w");
            fwrite($arqPergunta, $listaNova);
            fclose($arqPergunta);
            $msg = "Pergunta de texto alterada com sucesso!";
        } else {
            $msg = "Erro: ID da pergunta não encontrado.";
        }
    } else {
        $msg = "Erro: O arquivo de perguntas de texto ainda não existe.";
    }

    header('Content-Type: application/json');
    echo json_encode(["mensagem" => $msg]);
    exit;
}
?>

<html>
    <head>
        <title>Alterar Pergunta de Texto</title>
    </head>
    <body>
        <h1>Alterar Pergunta de Texto</h1>
        <p>Digite o ID da pergunta que deseja alterar e preencha com os novos dados.</p>

        <form id="formAlterarTexto" onsubmit="alterarDadosTexto(event)">
            ID da Pergunta atual: <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            
            Novo Enunciado do desafio: <br>
            <textarea name="enunciado" rows="4" cols="50" required></textarea>
            <br><br>
            
            Nova Resposta Esperada: <br>
            <input type="text" name="resposta" required>
            <br><br>
            
            <input type="submit" value="Salvar Alterações">
        </form>
        
        <p><strong id="mensagemNaTela"></strong></p>

        <script>
            function alterarDadosTexto(evento) {
                evento.preventDefault();
                
                let formulario = document.getElementById("formAlterarTexto");
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
