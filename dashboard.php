<?php
session_start();

//Imports
Include('functions.php');
require('database.php');
require('db_function.php');

if(isset($_SESSION['logged_in'])) {

	if($_SESSION['logged_in'] == true && $_SESSION['role'] != 'Administrator') {

		echo "Your access is denied, Not enough Priviliges!";
		die();
	}

} else {

	header('Location: login.php');
	die();
}



if(isset($_POST['submit'])) {

	if(insert_post($_POST)) {
		echo '<div class="alert alert-success" role="alert">';
  		echo '<strong>Well done!</strong> You have successfully added a post tp your blog.</div>';
	} else {
		echo "Insertion Failed!";
	}
}

//Delete a POST
if(isset($_POST['post_delete'])) {

	if(delete_post($_POST)) {
		echo '<div class="alert alert-success" role="alert">';
  		echo '<strong>Well done!</strong> Post successfully deleted!.</div>';
	} else {
		echo "Failed to delete POST!";
	}
}

//Update a POST
if(isset($_POST['post_edited'])) {
	
	if(update_post($_POST)) {
		echo '<div class="alert alert-success" role="alert">';
  		echo 'Blog Post edited Successfully!.</div>';
	} else {
		echo "Failed to delete POST!";
	}

}

//Fetch all Posts
$query = "SELECT post_id, post_title, post_author FROM posts";

$posts = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8">

		<br>
		<center><h1>Blog Dashboard</h1></center>
		<br>


		<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Add Blog Post
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-block">
		<form method="POST">
			<div class="form-group">
    			<label for="exampleInputEmail1">Post Title</label>
    			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_title">
  			</div>

  			<div class="form-group">
    			<label for="exampleInputEmail1">Post Author</label>
    			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_author">
  			</div>

  			<div class="form-group">
    			<label for="exampleInputEmail1">Post Body</label>
    			<textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Body" name="post_body"></textarea>
  			</div>

  			<div class="form-group">
  				<label for="exampleSelect1">Post Category</label>
  				<select name="post_category" class="form-control" id="exampleSelect1">
  					<?php display_categories(); ?>
  				</select>
  			</div>
  			 <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
  		</form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          View Posts
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-block">
        <table class="table">
  <thead>
    <tr>
      <th>Post Title</th>
      <th>Author</th>
      <th>Action</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php while($data = mysqli_fetch_assoc($posts)) { ?>
    <tr>
      <th scope="row"><?php echo $data['post_title']; ?></th>
      <td><?php echo $data['post_author']; ?></td>
      <td><form method="POST"><button type="submit" name="post_delete" value="<?php echo $data['post_id']; ?>" class="btn btn-danger">Delete</button></form></td>
      <td><form method="POST"><button type="submit" name="post_edit" value="<?php echo $data['post_id']; ?>" class="btn btn-warning">Edit</button></form></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
    </div>
  </div>

  <?php if(isset($_POST['post_edit'])) {

  	//Get Data about POST To Edit
  	$data = get_post_data($_POST);

  	?>


  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Edit Post
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="card-block">
        <form method="POST">
			<div class="form-group">
    			<label for="exampleInputEmail1">Post Title</label>
    			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_title" value="<?php echo $data['post_title']; ?>">
  			</div>

  			<div class="form-group">
    			<label for="exampleInputEmail1">Post Author</label>
    			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_author" value="<?php echo $data['post_author']; ?>">
  			</div>

  			<div class="form-group">
    			<label for="exampleInputEmail1">Post Body</label>
    			<textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Body" name="post_body"><?php echo $data['post_body']; ?></textarea>
  			</div>

  			<div class="form-group">
  				<label for="exampleSelect1">Post Category</label>
  				<select name="post_category" class="form-control" id="exampleSelect1">
  				<?php
  					display_categories($data['post_category_id']);
  				?>
  				</select>
  			</div>
  			 <button type="submit" name="post_edited" value="<?php echo $data['post_id']; ?>" class="btn btn-primary">Submit</button>
  		</form>
      </div>
    </div>
  </div>

  <?php } ?>
</div>




		</div>
	</div>
</div>

</body>
</html>