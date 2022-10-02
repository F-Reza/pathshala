<?php 
require '../../db/dbcon.php';
  session_start();

  if (isset($_SESSION['std_user_name'])) { 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <title>Dashboard - Student</title>
    </head>
    <body class="sb-nav-fixed">
<?php $username = $_SESSION['std_user_name'];?>	
	<?php
	
	$query = "SELECT * FROM students WHERE user_name = '$username'";
	$query_run = mysqli_query($con, $query);

	
	if(mysqli_num_rows($query_run) > 0)
	{ 
		foreach($query_run as $user)
		{
?>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
		<div class="card-body">
                    <h4 class="text-center">Pathshala
                        <a href="#" class="btn btn-success float-start mr">Dashboard</a> 
						<a href="logout.php" class="btn btn-warning float-end">LOGOUT</a> 
                    </h4>
                </div>
				<br />
            <div class="card">
			<div class="card-header">
				<h4>Student Information
				</h4>
			</div>
			<div class="card-body">

			<table id="myTable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Course</th>
						<th>Section & Time</th>
						<th>Total Payable</th>
						<th>Paid Amount</th>
						<th>Due</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM students WHERE user_name= '$username'";
					$query_run = mysqli_query($con, $query);

					
					if(mysqli_num_rows($query_run) > 0)
					{					
						foreach($query_run as $student)
						
						{
							?>
							<tr>
								<td><?= $user['id'] ?></td>
								<td><?= $user['name'] ?></td>
								<td><?= $user['address'] ?></td>
								<td><?= $user['phone'] ?></td>
								<td><?= $user['course'] ?></td>
								<?php
								if($user['section'] == 'Day'){
								?>
								<td><?= $user['section'].' (10:00am-12:00pm)' ?></td>
								<?php
								}else{
									?>
								<td><?= $user['section'].' (06:00pm-08:00pm)' ?></td>
								<?php
								}
								?>
								<td><?= $user['total_payment'] ?></td>

								<td>
								<?php
								$sid =  $user['id'] ;
								$query = "SELECT SUM(amount) FROM payment
								where s_id =  $sid";
								$query_run = mysqli_query($con, $query);

								while($amount = mysqli_fetch_array($query_run))
								{
									if($amount['SUM(amount)'] <= 0)
									{
										echo "$0.0";
									}
									else
									{
										echo '$'.$amount['SUM(amount)'];
									}		
								}
								?>    
								</td>

								<td>
								<?php
								$sid =  $user['id'] ;
								$query = "SELECT SUM(total_payment) FROM students
								where id =  $sid";
								$query_run = mysqli_query($con, $query);

								while($total_payment = mysqli_fetch_array($query_run))
								{
								 
								 $calculate = $total_payment['SUM(total_payment)'];

								 $query = "SELECT SUM(amount) FROM payment
								 where s_id =  $sid";
								 $query_run = mysqli_query($con, $query);

								 while($amount = mysqli_fetch_array($query_run))
								 {
								  $payable = $amount['SUM(amount)'];
								  $totalsum = $calculate - $payable;
								  
								  if($totalsum >0) {
									  echo '$'.$totalsum;
								  }else{
									  echo '$'.$totalsum.' B';
								  }
								 }
								}
								?>
								</td>
							</tr>
							
							<?php
						}
						
					}
					?>
                            
					</tbody>
				</table>

                </div>
            </div>
        </div>
    </div>
</div>

<br />
<br />

<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateStudent">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="std_id" id="std_id" >
				
				<div class="mb-3">
                    <label for="">Change Password</label>
                    <input type="text" name="password" id="password" required class="form-control" />
                </div>
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="card container mt-2 col-md-4">
<div class="card-body">
<table id="myTable" class="table table-bordered table-striped">
<thead>
	<tr>
		<th>Username</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
	<?php
	$query = "SELECT * FROM user_std WHERE user_name = '$username'";
	$query_run = mysqli_query($con, $query);

	
	if(mysqli_num_rows($query_run) > 0)
	{		
		foreach($query_run as $std)
		
		{
			?>
			<tr>
				<td><?= $std['user_name'] ?></td>																														
				<td>
					<button type="button" value="<?=$std['std_id'];?>" class="editStudentBtn btn btn-success btn-sm">Change Password</button>
				</td>		   
			</tr>			
			<?php
		}
		
	}
	?>
	
</tbody>
</table>
</div>
</div>


<?php
		}
	}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
$(document).on('click', '.editStudentBtn', function () {

var std_id = $(this).val();

$.ajax({
	type: "GET",
	url: "../code.php?std_id=" + std_id,
	success: function (response) {

		var res = jQuery.parseJSON(response);
		if(res.status == 404) {

			alert(res.message);
		}else if(res.status == 200){

			$('#std_id').val(res.data.std_id);
			$('#password').val(res.data.password);

			$('#studentEditModal').modal('show');
		}

	}
});

});

$(document).on('submit', '#updateStudent', function (e) {
e.preventDefault();

var formData = new FormData(this);
formData.append("update_student", true);

$.ajax({
	type: "POST",
	url: "../code.php",
	data: formData,
	processData: false,
	contentType: false,
	success: function (response) {
		
		var res = jQuery.parseJSON(response);
		if(res.status == 422) {
			$('#errorMessageUpdate').removeClass('d-none');
			$('#errorMessageUpdate').text(res.message);

		}else if(res.status == 200){

			$('#errorMessageUpdate').addClass('d-none');

			alertify.set('notifier','position', 'top-right');
			alertify.success(res.message);
			
			$('#studentEditModal').modal('hide');
			$('#updateStudent')[0].reset();

			$('#myTable').load(location.href + " #myTable");

		}else if(res.status == 500) {
			alert(res.message);
		}
	}
});

        });
</script>

<script>
    </body>
</html>

<?php 
}else {
   header("Location: login.php");
}
 ?>
