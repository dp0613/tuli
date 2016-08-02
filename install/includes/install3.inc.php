<?php 
	require_once( '../../autoload.php' );
	
	/*Modifing config.php file
	========================================*/
	$configFile = ROOT . '/config.php';
	
	$configText = file_get_contents( $configFile );
	$configText = str_replace( 'define( \'INSTALLED\', false );', 'define( \'INSTALLED\', true );', $configText );
	
	@file_put_contents( $configFile, $configText );
	
	/*Set readonly
	========================================*/
	@chmod( $configFile, 0444 ); // Readonly
	
	$html = '
		<p>Chúc mừng bạn đã cài đặt thành công YIT CMS</p>
		<a href="/login.php" title="Đăng nhập" class="dp-login">Đăng nhập</a>
	';
	echo $html;
?>