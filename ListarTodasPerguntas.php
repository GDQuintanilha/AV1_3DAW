<?php
$linhasMultipla = [];
$linhasTexto = [];

if(file_exists("perguntasMultipla.txt")){
    $linhasMultipla = file("perguntasMultipla.txt");
}

if(file_exists("perguntasTexto.txt")){
    $linhasTexto = file("perguntasTexto.txt");
}
?>

<html>
    <head>
        <title>Listar Todas as Perguntas</title>
    </head>
    <body>
        <h1>Todas as Perguntas Cadastradas</h1>

        <h2>Múltipla Escolha</h2>
        <?php
        $i = 0;
        while($i < count($linhasMultipla)){
            $linhaAtual = $linhasMultipla[$i];
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                // Imprime ID, Enunciado e a Resposta Correta
                echo "ID: " . $pedacos[0] . " | Enunciado: " . $pedacos[1] . " | Resposta Correta: " . $pedacos[6] . "<br><br>";
            }
            $i++;
        }
        if(count($linhasMultipla) == 0){
            echo "Nenhuma pergunta de múltipla escolha cadastrada.<br>";
        }
        ?>

        <h2>Texto (Dissertativas)</h2>
        <?php
        $i = 0;
        while($i < count($linhasTexto)){
            $linhaAtual = $linhasTexto[$i];
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                // Imprime ID, Enunciado e a Resposta Esperada
                echo "ID: " . $pedacos[0] . " | Enunciado: " . $pedacos[1] . " | Resposta Esperada: " . $pedacos[2] . "<br><br>";
            }
            $i++;
        }
        if(count($linhasTexto) == 0){
            echo "Nenhuma pergunta de texto cadastrada.<br>";
        }
        ?>
    </body>
</html>