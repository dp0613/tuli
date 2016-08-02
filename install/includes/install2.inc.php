<?php 
	require_once( '../../autoload.php' );
	require_once( ROOT . '/admin/includes/btf.inc.php' );
	
	if( isset( $_POST['user_username'] ) ) {
		
		/*Get data
		=======================================*/
		$username = $_POST['user_username'];
		$pass = $_POST['user_pass1'];
		$email = $_POST['user_email'];
		
		/*Encoding password
		========================================*/
		$encodedPass = btf_encode( $pass );
		
		/*Inserting into db
		=======================================*/
		$database = new Database( HOST, USER, PASS, DBNAME );
		$sql = "INSERT INTO users( user_username, user_password, user_key, user_email ) VALUES( :username, :pass, :key, :email );";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':username' => $username,
			':pass' => $encodedPass[0],
			':key' => $encodedPass[1],
			':email' => $email
		) );
		
		if( $r ) {
			$html = '
				<p>Tạo người dùng thành công.</p>
				<a href="/install.php?step=3" data-step="2" class="dp-nextstep" oncontextmenu="return false;">Tiếp theo</a>
			';
		}
		else {
			$html = '
				<p class="error">Đã có lỗi xảy ra, vui lòng thử lại.</p>
			';
		}
		
		echo $html;
	}
?>