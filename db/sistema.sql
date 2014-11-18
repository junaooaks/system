CREATE TABLE usuarios (
	id_usuario SMALLINT ( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,	
	login VARCHAR ( 20 ) NOT NULL UNIQUE,
	senha CHAR ( 32 ) NOT NULL,
	email VARCHAR ( 64 ) NOT NULL,
	nivel_acesso ENUM ( '0', '1', '2' ) DEFAULT '0'
) TYPE = innodb;