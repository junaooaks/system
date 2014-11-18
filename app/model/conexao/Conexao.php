<?php
class Conexao extends PDO {
	private $dsn = 'mysql:dbname=sisgew_webcom;host=127.0.0.1';
	private $user = 'sisgew_webcom';
	private $password = 'xpto/45';
	public $handle = null;

	function __construct( ) {
		try {
			if ( $this->handle == null ) {
				$dbh = parent::__construct( $this->dsn , $this->user , $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
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
