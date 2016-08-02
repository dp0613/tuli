<form action="" method="post" class="dp-user-form">
	<label for="dp-username">Tên đăng nhập:</label>
	<input type="text" id="dp-username" name="user_username" required="required" />
	<label for="dp-email">Email:</label>
	<input type="text" id="dp-email" name="user_email" required="required" />
	<label for="dp-password1">Mật khẩu:</label>
	<input type="password" id="dp-password1" autocomplete="new-password" name="user_pass1" required="required" />
	<label for="dp-password2">Xác nhận mật khẩu:</label>
	<input type="password" id="dp-password2" name="user_pass2" required="required" />
	<input type="submit" value="Tạo người dùng" name="create_user" class="dp-create-user" />
</form>
<section class="dp-create-user-status status">
	<!-- Ajax goes here -->
</section>