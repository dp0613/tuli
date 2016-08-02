<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	$sql = "SELECT * FROM users;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();
	
	$html = '';
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		if( (int)$r['user_active'] == 1 ) {
			$button = '<button class="dp-user-block-btn" data-id="' . $r['user_id'] . '">Khóa</button>';
		}
		else {
			$button = '<button class="dp-user-unblock-btn" data-id="' . $r['user_id'] . '">Mở khóa</button>';
		}
		
		$html .= '
			<tr>
				<td>' . $r['user_username'] . '</td>
				<td>' . $r['user_email'] . '</td>
				<td>
					' . $button . '
					<button class="dp-user-delete-btn" data-id="' . $r['user_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
?>