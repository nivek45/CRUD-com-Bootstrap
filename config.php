<?php

    /** O nome do banco de dados*/
    define("DB_NAME", "wda_crud");

    /** Usuário do banco de dados MySQL */
    define("DB_USER", "root");

    /** Senha do banco de dados MySQL */
    define("DB_PASSWORD", "");

    /** nome do host do MySQL */
    define("DB_HOST", "localhost");

    /** caminho absoluto para a pasta do sistema **/
    if ( !defined("ABSPATH") )
        define("ABSPATH", dirname(__FILE__) . "/");
        
    /** caminho no server para o sistema **/
    if ( !defined("BASEURL") )
        define("BASEURL", "/crud-bootstrap-php/");
        
    /** caminho do arquivo de banco de dados **/
    if ( !defined("DBAPI") )
    	define("DBAPI", ABSPATH . "inc/database.php");

    /** caminhos dos templates de header e footer **/
    define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
    define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
    define('HEADER2_TEMPLATE', ABSPATH . 'inc/header2.php');
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_DATABASE', 'wda_crud');

    function getConnection() {
        $dsn = 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
    
        try {
            $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }
?>