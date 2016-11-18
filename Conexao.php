<?php
/**
 * Description of Utilidades
 * @author lhppaixao
 * @matricula 201613199
 */
class Conexao {

    public static function pegaConexao() {
        try {
            $con = new PDO("mysql:host=localhost:3307;dbname=updateID", "root", "master");
            return $con;
        } catch (SQLException $ex) {
            
        }
    }

}
