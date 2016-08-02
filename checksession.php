<?php 
	if( !isset( $_SESSION['dp_logged'] ) || $_SESSION['dp_logged'] !== true ) {
		header( "Location: login.php" );
		exit;
	}
?>