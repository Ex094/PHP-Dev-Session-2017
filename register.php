<?php
require('login_functions.php');


if(isset($_POST['submit'])) {
  if(register($_POST)) {
    echo '<div class="alert alert-success" role="alert">';
    echo '<strong>Congrats!</strong> You have been registered to our Blog.</div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">';
    echo '<strong>OOPS!</strong>Could not regsiter!.</div>';
  }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Registration Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-5 push-md-3 text-md-center">

		<br>
		<center><h1>Blog Registration</h1></center>
		<br>

    <form method="POST">
      <div class="form-group">
          <label for="exampleInputEmail1">Username:</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="username">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Email Address:</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="email">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Password</label>
          <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="password">
        </div>
         <button type="submit" name="submit" value="submit" class="btn btn-primary">Register!</button>
      </form>
 
		</div>
	</div>
</div>

</body>
</html>