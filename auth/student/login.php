<?php 
  session_start();
  if (!isset($_SESSION['std_user_name'])) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pathshala</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	  <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	  	<form class="p-5 rounded shadow" 
	  	      action="auth.php"
	  	      method="post" 
	  	      style="width: 30rem">
			<a href="../../welcome.php" class="btn btn-success float-center">START</a> 
	  		<h1 class="text-center pb-3 display-6">Student</h1>
	  		<h1 class="text-center pb-5 display-4">LOGIN</h1>
	  		<?php if (isset($_GET['error'])) { ?>
	  		<div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error'])?>
			</div>
		    <?php } ?>
		  <div class="mb-3">
		    <label for="exampleInputUsername" 
		           class="form-label">UserName
		    </label>
		    <input type="text" 
		           name="user_name" 
		           value="<?php if(isset($_GET['user_name']))echo(htmlspecialchars($_GET['user_name'])) ?>" 
		           class="form-control" 
		           id="exampleInputUsername" aria-describedby="usernamelHelp">
		  </div>
		  <div class="mb-3">
		    <label for="exampleInputPassword1" 
		           class="form-label">Password
		    </label>
		    <input type="password" 
		           class="form-control" 
		           name="password" 
		           id="exampleInputPassword1">
		  </div>
		  <button type="submit" 
		          class="btn btn-primary">LOGIN
		  </button>
		</form>
	  </div>
</body>
</html>

<?php 
}else {
   header("Location: index.php");
}
 ?>
