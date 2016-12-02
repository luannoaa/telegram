<?php require'cabecalho.php'; ?>
<?php

require './Conexao.php';
require './Utilidades.php';

$file = 'updateId.txt';
$str = file_get_contents($file);
$arrUpdateId = explode(',', $str);
$resultado = Utilidades::getUpdate();

$var = count($resultado['result']) - 1;

for ($i = $var; $i > -1; $i--) {
    $data = $resultado ['result'][$i]['message']['date'];
    $nome = $resultado['result'][$i] ['message']['from']['first_name'];
    //$texto = $resultado['result'][$i]['message']['text'];
    $id = $resultado ['result'] [$i] ['message']['chat']['id'];
    $updateId = $resultado ['result'][$i]['update_id'];

    $dataRetorno = Utilidades::tratarData($data);
    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
    $dataTratada = utf8_encode(strftime('%A, %d de %B de %Y', $dataRetorno));
    $horaTratada = strftime('%R', $dataRetorno);


//    echo "<tr>" 
//    . "<td colspan='2' style='background-color: #dddddd;'>" . $dataTratada . "</td>"
//    . "</tr>"
//    . "<tr>"
//    . "<td style='background-color: #dddddd;'>" . $nome . "</td>"
//    . "<td style='background-color: #dddddd;'>" . $horaTratada . "</td>"
//    . "</tr>"
//    . "<tr>"
//    . "<td colspan='2'>" . $texto . "</td>"
//    . "</tr>";

    if (isset($resultado['result'][$i]['message']['text'])) {
        $texto = $resultado['result'][$i]['message']['text'];
        
        $texto1 = preg_match('/^.*\/megasena$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                print ("RESULTADO : ");
                for ($w = 1; $w <= 6; $w++) {
                    $n[$w - 1] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
                }
                sort($n);
                $resultadomegasena = implode(' - ', $n);
                Utilidades::sendMessage($id, $resultadomegasena);
                $stmt = Conexao::pegaConexao()->prepare("insert into tbbotresposta(first_name, nm_comando,resposta,update_id) values(?, ?, ?, ?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $texto);
                $stmt->bindParam(3, $resultadomegasena);
                $stmt->bindParam(4, $updateId);

                $stmt->execute();
                echo $resultadomegasena;
                file_put_contents($file, $updateId . ',', FILE_APPEND);
            }
        }

        echo "<tr>"
        . "<td colspan='2' style='background-color: #dddddd;'>" . $dataTratada . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='background-color: #dddddd;'>" . $nome . "</td>"
        . "<td style='background-color: #dddddd;'>" . $horaTratada . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td colspan='2'>" . $texto . "</td>"
        . "</tr>";
    } else if (isset($resultado['result'][$i]['message']['photo'])) {
        $fileID = $resultado['result'][$i]['message']['photo'][1]['file_id'];
        
    }
    $texto1 = preg_match('/^.*\/megasena$/', $texto);
}
?>
<?php require'rodape.php'; ?>
