<form action="" method="post" class="dp-db-form">
	<label for="dp-hostname">Host:</label>
	<input type="text" placeholder="localhost" id="dp-hostname" name="mysql_host" required="required" />
	<label for="dp-username">Tên đăng nhập mysql:</label>
	<input type="text" placeholder="root" id="dp-username" name="mysql_user" required="required" />
	<label for="dp-password">Mật khẩu mysql:</label>
	<input type="password" id="dp-password" autocomplete="new-password" name="mysql_pass" />
	<label for="dp-dbname">Tên cơ sở dữ liệu:</label>
	<input type="text" placeholder="yit" id="dp-dbname" name="mysql_db" required="required" />
	<input type="submit" value="Tạo cơ sở dữ liệu" name="create_db" class="dp-create-db" />
</form>
<section class="dp-create-db-status status">
	<!-- Ajax goes here -->
</section>