<?php
if(isset($_GET['acao']) && $_GET['acao'] == 'buscar') {
    $dados = [
        "multipla" => [],
        "texto" => []
    ];

    if(file_exists("perguntasMultipla.txt")){
        $linhasMultipla = file("perguntasMultipla.txt");
        $i = 0;
        while($i < count($linhasMultipla)){
            $linhaAtual = trim($linhasMultipla[$i]);
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                array_push($dados["multipla"], [
                    "id" => $pedacos[0],
                    "enunciado" => $pedacos[1],
                    "resposta" => $pedacos[6]
                ]);
            }
            $i++;
        }
    }

    if(file_exists("perguntasTexto.txt")){
        $linhasTexto = file("perguntasTexto.txt");
        $i = 0;
        while($i < count($linhasTexto)){
            $linhaAtual = trim($linhasTexto[$i]);
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                array_push($dados["texto"], [
                    "id" => $pedacos[0],
                    "enunciado" => $pedacos[1],
                    "resposta" => $pedacos[2]
                ]);
            }
            $i++;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($dados);
    exit;
}
?>

<html>
    <head>
        <title>Listar Todas as Perguntas</title>
    </head>
    <body>
        <h1>Todas as Perguntas Cadastradas</h1>

        <h2>Múltipla Escolha</h2>
        <div id="listaMultipla"></div>

        <h2>Texto (Dissertativas)</h2>
        <div id="listaTexto"></div>

        <script>
            function carregarPerguntas() {
                fetch('listarTodasPerguntas.php?acao=buscar')
                .then(resposta => resposta.json())
                .then(dados => {
                    let htmlMultipla = "";
                    let htmlTexto = "";

                    if(dados.multipla.length > 0){
                        let i = 0;
                        while(i < dados.multipla.length){
                            htmlMultipla += "ID: " + dados.multipla[i].id + " | Enunciado: " + dados.multipla[i].enunciado + " | Resposta Correta: " + dados.multipla[i].resposta + "<br><br>";
                            i++;
                        }
                    } else {
                        htmlMultipla = "Nenhuma pergunta de múltipla escolha cadastrada.<br>";
                    }

                    if(dados.texto.length > 0){
                        let i = 0;
                        while(i < dados.texto.length){
                            htmlTexto += "ID: " + dados.texto[i].id + " | Enunciado: " + dados.texto[i].enunciado + " | Resposta Esperada: " + dados.texto[i].resposta + "<br><br>";
                            i++;
                        }
                    } else {
                        htmlTexto = "Nenhuma pergunta de texto cadastrada.<br>";
                    }

                    document.getElementById("listaMultipla").innerHTML = htmlMultipla;
                    document.getElementById("listaTexto").innerHTML = htmlTexto;
                });
            }

            carregarPerguntas();
        </script>
    </body>
</html>
