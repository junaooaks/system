<?php
class Firebird extends PDO {
//usando este metodo consigo conectar sem problema
        public $dsn = 'firebird:dbname=localhost:C:\BASE.FDB';
        public $user = 'SYSDBA';
        public $password = 'masterkey';
        public $handle = null;
        
        function __construct() {
           
            try {
                        if ( $this->handle == null ) {
                                $dbh = parent::__construct( $this->dsn , $this->user , $this->password);
                                $this->handle = $dbh;
                                return $this->handle;
                        }
                }
                catch ( PDOException $e ) {
                        echo 'FALHA NA CONEXAO: ' . $e->getMessage( );
                        return false;
                }
        }

        function __destruct( ) {
                $this->handle = NULL;
        }
}

?>

