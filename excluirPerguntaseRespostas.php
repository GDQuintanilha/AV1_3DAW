<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idBusca = $_POST['idPergunta'];
    $apagou = false;
    $msg = "";
    
    if(file_exists("perguntasMultipla.txt")){
        $linhas = file("perguntasMultipla.txt");
        $listaNova = "";
        $i = 0;
        
        while($i < count($linhas)){
            $linhaAtual = $linhas[$i];
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                if($pedacos[0] != $idBusca){
                    $listaNova = $listaNova . $linhaAtual;
                } else {
                    $apagou = true;
                }
            }
            $i++;
        }
        $arq = fopen("perguntasMultipla.txt", "w");
        fwrite($arq, $listaNova);
        fclose($arq);
    }

    if(file_exists("perguntasTexto.txt")){
        $linhas = file("perguntasTexto.txt");
        $listaNova = "";
        $i = 0;
        
        while($i < count($linhas)){
            $linhaAtual = $linhas[$i];
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                if($pedacos[0] != $idBusca){
                    $listaNova = $listaNova . $linhaAtual;
                } else {
                    $apagou = true;
                }
            }
            $i++;
        }
        $arq = fopen("perguntasTexto.txt", "w");
        fwrite($arq, $listaNova);
        fclose($arq);
    }

    if($apagou == true){
        $msg = "Pergunta excluída com sucesso de nossa base de dados!";
    } else {
        $msg = "Erro: ID da pergunta não encontrado em nenhum arquivo.";
    }

    header('Content-Type: application/json');
    echo json_encode(["mensagem" => $msg]);
    exit;
}
?>

<html>
    <head>
        <title>Excluir Pergunta</title>
    </head>
    <body>
        <h1>Excluir Pergunta</h1>
        <p>Atenção: Esta ação apagará a pergunta e suas respostas permanentemente.</p>
        
        <form id="formExcluir" onsubmit="excluirPergunta(event)">
            ID da Pergunta a ser excluída: <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            <input type="submit" value="Excluir Definitivamente">
        </form>
        
        <p><strong id="mensagemNaTela"></strong></p>

        <script>
            function excluirPergunta(evento) {
                evento.preventDefault();
                
                let formulario = document.getElementById("formExcluir");
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
