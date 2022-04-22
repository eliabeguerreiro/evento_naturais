<?php


define('DB_HOST'        , "10.7.0.4");
define('DB_USER'        , "redeph.suporte");
define('DB_PASSWORD'    , "R5@Od$4=6!3");
define('DB_NAME'        , "RedePharmaProducao");
define('DB_DRIVER'      , "sqlsrv");

class Conexao
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        $pdoConfig  = DB_DRIVER . ":". "Server=" . DB_HOST . ";";
        $pdoConfig .= "Database=".DB_NAME.";";

        try {
            if(!isset($connection)){
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
         } catch (PDOException $e) {
            
            $mensagem = "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
         }
     }
}

define('HOST', 'redepharma.com.br:3306');
define('USUARIO', 'redeph12_inventario');
define('SENHA', 'redeph@inventario');
define('DB', 'redeph12_simposio_naturais');

$conn = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Falha na conexão com o Banco de Dados!');