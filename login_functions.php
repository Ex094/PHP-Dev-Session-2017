<?php
require('database.php');

//Register User
function register($post_var) {

	global $conn;

	$query = "INSERT INTO blog_users VALUES (NULL, '" . $post_var['username'] . "','" . $post_var['email'] . "','" . password_hash($post_var['password'], PASSWORD_BCRYPT) . "','Subscriber')";

	return mysqli_query($conn, $query);
}

//Check User
function check_user($email, $password) {

	global $conn;

	$query = "SELECT blog_user_password, blog_user_role FROM blog_users WHERE blog_user_email = '" . $email . "'";

	$result = mysqli_query($conn, $query);

	if($result) {

		$data = mysqli_fetch_assoc($result);

		if(password_verify($password, $data['blog_user_password'])) {

			$_SESSION['logged_in'] = true;
			$_SESSION['role'] = $data['blog_user_role'];

			header('Location: dashboard.php');
			die();

		} else {

			echo '<div class="alert alert-danger" role="alert">';
    		echo '<strong>OOPS!</strong> Invalid User!.</div>';
		}

	}

}