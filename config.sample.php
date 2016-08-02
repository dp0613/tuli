<?php 

	/**
	 * YIT - dp0613
	 * Don't delete this file
	 * Just copy and rename only
	 */

	/*Defining some constants for fixing url
	=====================================================*/
	define( 'ROOT', __dir__ );
	define( '_DEFAULT', ROOT . '/default/' );
	define( '_ADMIN', ROOT . '/admin/' );
	define( '_CORE', ROOT . '/core/' );
	define( '_MODULES', ROOT . '/modules/' );
	define( '_INSTALL', ROOT . '/install/' );
	
	
	/*Defining some constants for connecting database
	=====================================================*/
	define( 'HOST', '{@host}' );
	define( 'USER', '{@user}' );
	define( 'PASS', '{@pass}' );
	define( 'DBNAME', '{@dbname}' );
	
	/*Timezone
	=====================================================*/
	date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
	
	/*Installing information
	====================================================*/
	define( 'INSTALLED', false );
	
?>