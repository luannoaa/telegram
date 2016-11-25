<?php
/**
 * Description of Utilidades
 * @author lhppaixao
 * @matricula 201613199
 */
class Conexao {

    public static function pegaConexao() {
        try {
            $con = new PDO("mysql:host=127.0.0.1:3306;dbname=updateID", "root", "");
            return $con;
        } catch (SQLException $ex) {
            
        }
    }

}
