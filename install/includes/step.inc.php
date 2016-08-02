<?php 
	require_once( '../../autoload.php' );
	
	$security = new Security();
	
	$security -> sec_session_start();
	
	if( isset( $_POST['step'] ) ) {
		$_SESSION['dp_step'] = (int)$_POST['step'] + 1 ;
	}
?>