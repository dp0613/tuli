<?php 
	require_once( 'autoload.php' );
	
	$security = new Security();
	
	$security -> sec_session_start();
	
	session_destroy();
	
	header( "Location: admin.php" );
	
	exit;
?>