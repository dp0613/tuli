<?php 
	require_once( 'config.php' );
	
	spl_autoload_register( function( $className ) {
		$classPath = _CORE . strtolower( $className ) . '.cls.php';
		if( isset( $classPath ) ) {
			include $classPath;
		}
		return false;
	} )
?>