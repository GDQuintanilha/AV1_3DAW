<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST['idPergunta'];
    $enunciado = $_POST['enunciado'];
    $opA = $_POST['opA'];
    $opB = $_POST['opB'];
    $opC = $_POST['opC'];
    $opD = $_POST['opD'];
    $correta = $_POST['correta'];
    
    $nomeArquivo = "perguntas_multipla.txt";

    if(!file_exists($nomeArquivo)){
        $arqPergunta = fopen($nomeArquivo, "w") or die("Erro ao criar arquivo");
        $cabecalho = "id;enunciado;opA;opB;opC;opD;correta\n";
        fwrite($arqPergunta, $cabecalho);
        fclose($arqPergunta);
    }

    $arqPergunta = fopen($nomeArquivo, "a") or die("Falha ao abrir o arquivo");
    
    $linha = $idPergunta . ";" . $enunciado . ";" . $opA . ";" . $opB . ";" . $opC . ";" . $opD . ";" . $correta . "\n";
    fwrite($arqPergunta, $linha);
    
    fclose($arqPergunta);

    $msg = "Pergunta de múltipla escolha cadastrada com sucesso!";
}
?>

<html>
    <head>
        <title>Criar Múltipla Escolha</title>
    </head>
    <body>
        <h1>Nova Pergunta (Múltipla Escolha)</h1>

        <form action="" method="POST">
            ID da Pergunta: <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            
            Enunciado: <br>
            <textarea name="enunciado" rows="3" cols="50" required></textarea>
            <br><br>
            
            Opção A: <input type="text" name="opA" required><br><br>
            Opção B: <input type="text" name="opB" required><br><br>
            Opção C: <input type="text" name="opC" required><br><br>
            Opção D: <input type="text" name="opD" required><br><br>
            
            Opção Correta (A, B, C ou D): <br>
            <input type="text" name="correta" required>
            <br><br>
            
            <input type="submit" value="Salvar Pergunta">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>