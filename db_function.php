<?php

require('database.php');

//Insert Post Function
function insert_post($post_var) {

	global $conn;

	//Query Insert
	$query = "INSERT INTO posts VALUES (NULL,'" . $post_var['post_title'] . "','" . $post_var['post_body'] . "','" . $post_var['post_author'] . "'," . $post_var['post_category'] . ")";

	//Return
	return mysqli_query($conn, $query);
}

//Update Post
function update_post($post_var) {

	global $conn;

	$query = "UPDATE posts SET post_title = '" . $post_var['post_title'] . "', post_body = '" . $post_var['post_body'] . "', post_author = '" . $post_var['post_author'] . "', post_category_id = " . $post_var['post_category'] . " WHERE post_id = " . $post_var['post_edited'];

	return mysqli_query($conn, $query);
}

//Get Post Data
function get_post_data($post_var) {

	global $conn;

	$query = 'SELECT * FROM posts WHERE post_id = ' . $post_var['post_edit'];

  	return mysqli_fetch_assoc(mysqli_query($conn, $query));
}

//Delete Post Function
function delete_post($post_var) {

	global $conn;

	$query = "DELETE FROM posts WHERE post_id = " . $post_var['post_delete'];

	return mysqli_query($conn, $query);
}

//Display Categories
function display_categories($default_value = null) {

	global $conn;

	$query = "SELECT * FROM posts_category";

	//Execute Query
	$categories = mysqli_query($conn, $query);

	//Print Categories
	while($data = mysqli_fetch_assoc($categories)) {

		//Check if default value provided
  		//Make default category as Selected
  		if($default_value != null && $default_value == $data['posts_category_id']) {

  			echo "<option selected value=" . $data['posts_category_id'] . ">" . $data['posts_category_name'] . "</option>";

  			continue;
  		}

  		//Echo out categories normally
  		echo "<option value=" . $data['posts_category_id'] . ">" . $data['posts_category_name'] . "</option>";
  	}
}
