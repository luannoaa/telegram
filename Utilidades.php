<?php
/**
 * Description of Utilidades
 * @author lhppaixao
 * @matricula 201613199
 */
define('TOKEN', file_get_contents('./token.txt'));
define("URL", 'https://api.telegram.org/' .TOKEN);

class Utilidades {

    public static function getUpdate() {
        $urlGetUpdate = URL . '/getUpdates';
        $requisicao = file_get_contents($urlGetUpdate);
        $resultado = json_decode($requisicao, true);
        return $resultado;
    }

    public static function sendMessage($id, $texto) {
        $urlSendMessage = URL . '/sendMessage?';
        $textoEnviar = urlencode($texto);
        file_get_contents($urlSendMessage . "chat_id=" . $id . "&text=" . $textoEnviar);
    }

    public static function tratarData($data) {

        $offsetUTC = date('Z');
//        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
//        $formato = '%A, %d de %B de %Y - %R';
        $offsetClean = (int) preg_replace('/[^0-9]/', '', $offsetUTC);
        if (preg_match('/^-.*/', $offsetUTC) == 1) {
//            $dataTratada = $data - $offsetClean;
//            return strftime($formato, $dataTratada);
            return $data - $offsetClean;
        } else {
//            $dataTratada = $data + $offsetClean;
//            return strftime($formato, $dataTratada);
            return $data + $offsetClean;
        }
    }
}