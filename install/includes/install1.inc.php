<?php 
	require_once( '../../autoload.php' );
	
	if( isset( $_POST['mysql_host'] ) ) {
		
		/*Get data
		===========================================*/
		$host = $_POST['mysql_host'];
		$user = $_POST['mysql_user'];
		$pass = $_POST['mysql_pass'];
		$dbName = $_POST['mysql_db'];
		
		$database = new Database( $host, $user, $pass, $dbName );
		$server = $database -> get_server();
		
		/*Creating database
		==========================================*/
		$hadDb = $database -> create_database( $dbName );
		
		/*Building tables
		==========================================*/
		if( $hadDb ) {
			$sqlFile = ROOT . '/docs/sql.sql';
			$hadCreated = $database -> build_tables( $sqlFile );
		}
		
		/*Modifing config.php file
		=========================================*/
		if( $hadCreated ) {
			
			$configFile = ROOT . '/config.php';
			
			//Ensure isset config.php
			if( !is_file( $configFile ) ) {
				$html = '
					<p class="error">Không tìm được file <b>config.php</b>. Hãy đảm bảo đổi tên file <b>config.sample.php</b> thành <b>config.php</b>.</p>
					<a href="javascript:void(0);" onclick="location.reload();">Làm lại</a>
				';
				echo $html;
				exit;
			}
			
			//Ensure have write permission
			if( !is_writable( $configFile ) ) {
				$html = '
					<p class="error">Không có quyền ghi file <b>config.php</b>. Hãy đảm bảo file không bị "readonly".</p>
					<a href="javascript:void(0);" onclick="location.reload();">Làm lại</a>
				';
				echo $html;
				exit;
			}
			
			//Get config.php's contents
			$configText = file_get_contents( $configFile );
			
			//Replace config value
			$configText = str_replace( '{@host}', $host, $configText );
			$configText = str_replace( '{@user}', $user, $configText );
			$configText = str_replace( '{@pass}', $pass, $configText );
			$configText = str_replace( '{@dbname}', $dbName, $configText );
		
			//Put back contents
			$hadModified = @file_put_contents( $configFile, $configText ); //Silent error for permission denied
			
			if( $hadModified ) {
				$html = '
					<p>Tạo cơ sở dữ liệu thành công.</p>
					<a href="/install.php?step=2" data-step="1" class="dp-nextstep" oncontextmenu="return false;">Tiếp theo</a>
				';
			}
		}
		else {
			$html = '
				<p class="error">Đã có lỗi xảy ra. Vui lòng thử lại.</p>
			';
		}
		echo $html;
	}
?>