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
    
    $perguntaEncontrada = false;
    $listaNova = "";
    $nome_arquivo = "perguntas_multipla.txt";

    if(file_exists($nome_arquivo)){
        $linhas = file($nome_arquivo);
        $quantidadeLinhas = count($linhas);
        $i = 0;

        while($i < $quantidadeLinhas){
            $linhaAtual = $linhas[$i];

            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);

                if($pedacos[0] == $idPergunta) {
                    
                    $linhaNova = $idPergunta . ";" . $enunciado . ";" . $opA . ";" . $opB . ";" . $opC . ";" . $opD . ";" . $correta . "\n";
                    $listaNova = $listaNova . $linhaNova;
                    $perguntaEncontrada = true;
                    
                } else {
                    $listaNova = $listaNova . $linhaAtual;
                }
            }
            $i++;
        }

        if ($perguntaEncontrada == true) {
            $arqPergunta = fopen($nome_arquivo, "w") or die("Falha ao abrir o arquivo");
            fwrite($arqPergunta, $listaNova);
            fclose($arqPergunta);
            $msg = "Pergunta de múltipla escolha alterada com sucesso!";
        } else {
            $msg = "Erro: ID da pergunta não encontrado.";
        }
    } else {
        $msg = "Erro: O arquivo de perguntas ainda não existe.";
    }
}
?>

<html>
    <head>
        <title>Alterar Múltipla Escolha</title>
    </head>
    <body>
        <h1>Alterar Pergunta (Múltipla Escolha)</h1>
        <p>Digite o ID da pergunta que deseja alterar e preencha todos os novos dados.</p>

        <form action="" method="POST">
            ID da Pergunta atual: <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            
            Novo Enunciado: <br>
            <textarea name="enunciado" rows="3" cols="50" required></textarea>
            <br><br>
            
            Opção A: <input type="text" name="opA" required><br><br>
            Opção B: <input type="text" name="opB" required><br><br>
            Opção C: <input type="text" name="opC" required><br><br>
            Opção D: <input type="text" name="opD" required><br><br>
            
            Qual é a nova opção correta? (A, B, C ou D): <br>
            <input type="text" name="correta" required>
            <br><br>
            
            <input type="submit" value="Salvar Alterações">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>