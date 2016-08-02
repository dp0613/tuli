<?php 
	require_once( 'autoload.php' );
	$security = new Security();
	$view = new View();
	
	$security -> sec_session_start();
	
	if( INSTALLED ) {
		echo $view -> get_admin_tpl( 'installed' );
		exit;
	}
	
	/*Get templates
	=================================================*/
	$html = $view -> get_install_tpl( 'head' );
	$html .= $view -> get_install_tpl( 'header' );
	$html .= $view -> get_install_tpl( 'main' );
	$html .= $view -> get_install_tpl( 'footer' );
	$html .= $view -> get_install_tpl( 'foot' );
	
	/*Routing
	=================================================*/
	if( isset( $_GET['step'] ) && $_GET['step'] != '' ) {
		/*Check step
		=========================================*/
		$step = isset( $_SESSION['dp_step'] ) ? (int)$_SESSION['dp_step'] : 0 ;
		
		//Had finished
		if( (int)$_GET['step'] < $step ) {
			$install = '
				<section class="status">
					<p>Bạn đã hoàn thành bước này từ trước.</p>
					<a href="/install.php?step=' . $step . '" data-step="' . ( $step - 1 ) . '" class="dp-nextstep" oncontextmenu="return false;">Tiếp theo</a>
				</section>
			';
			$progress = '[ok] Bước này đã xong ^^';
		}
		//Irogne requiring step
		else if ( (int)$_GET['step'] > $step ) {
			$install = '
				<section class="status">
					<p class="error">Bước đằng trước là bắt buộc.</p>
					<a href="/install.php?step=' . $step . '" data-step="' . ( $step - 1 ) . '" class="dp-nextstep" oncontextmenu="return false;">Quay lại</a>
				</section>
			';
			$progress = '[wtf] Bỏ lỡ bước bắt buộc :\'(';
		}
		//Right case
		else {
			$install = $view -> get_install_tpl( 'install'. $_GET['step'] );
			$progress = $view -> get_install_tpl( 'progress'. $_GET['step'] );
		}
	}
	else {
		$install = $view -> get_install_tpl( 'install0' );
		$progress = $view -> get_install_tpl( 'progress0' );
	}
	
	/*Magic keywords
	================================================*/
	$html = str_replace( '{@progress}', $progress, $html );
	$html = str_replace( '{@install}', $install, $html );
	
	/*Echo html
	================================================*/
	echo $html;
?>