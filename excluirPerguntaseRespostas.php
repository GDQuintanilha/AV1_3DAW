<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idBusca = $_POST['idPergunta'];
    $apagou = false;
    
    if(file_exists("perguntasMultipla.txt")){
        $linhas = file("perguntasMultipla.txt");
        $listaNova = "";
        $i = 0;
        
        while($i < count($linhas)){
            $linhaAtual = $linhas[$i];
            if($linhaAtual != ""){
                $pedacos = explode(";", $linhaAtual);
                if($pedacos[0] != $idBusca){
                    $listaNova = $listaNova . $linhaAtual; // Guarda se for diferente
                } else {
                    $apagou = true; // Ignora se for igual (excluindo)
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
        // Sobrescreve o arquivo
        $arq = fopen("perguntasTexto.txt", "w");
        fwrite($arq, $listaNova);
        fclose($arq);
    }

    if($apagou == true){
        $msg = "Pergunta excluída com sucesso de nossa base de dados!";
    } else {
        $msg = "Erro: ID da pergunta não encontrado em nenhum arquivo.";
    }
}
?>

<html>
    <head>
        <title>Excluir Pergunta</title>
    </head>
    <body>
        <h1>Excluir Pergunta</h1>
        <p>Atenção: Esta ação apagará a pergunta e suas respostas permanentemente.</p>
        
        <form action="" method="POST">
            ID da Pergunta a ser excluída: <br>
            <input type="text" name="idPergunta" required>
            <br><br>
            <input type="submit" value="Excluir Definitivamente">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>
    </body>
</html>