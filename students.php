<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_username'])) { 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add Student -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveStudent">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Select Course</label>
                    <select name = "course">
                    <option value="" selected >None</option>
                    <option value="Course-A">Course-A</option>
                    <option value="Course-B">Course-B</option>
                    </select>    
                </div>
				<div class="mb-3">
                    <label for="">Select Section</label>
                    <select name = "section">
                    <option value="" selected >None</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    </select>	
                </div>
				<div class="mb-3">
                    <label for="">Total Payable</label>
                    <input type="text" name="total_payment" required class="form-control" />
                </div>
				
				<div class="mb-3">
                    <label for="">Username (Unique)</label>
                    <input type="text" name="user_name" required class="form-control" />
                </div>
				<div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" required class="form-control" />
                </div>

				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Student</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateStudent">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="student_id" id="student_id" >

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" id="address" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" id="phone" required class="form-control" />
                </div>
				<!--
                <div class="mb-3">
					<label for="">Select Course</label> 
					<select name = "course">
						<option value="Course-A">Course-A</option>
						<option value="Course-B">Course-B</option>
                    </select>
                </div>
				<div class="mb-3">
                    <label for="">Select Section</label> 
					<select name = "section">
						<option value="A">A</option>
						<option value="B">B</option>
                    </select>
                </div>
				-->
				<div class="mb-3">
                    <label for="">Total Payable</label>
                    <input type="text" name="total_payment" id="total_payment" required class="form-control" />
                </div>
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
        </div>
    </div>
</div>




<!-- View Student Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <p id="view_address" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <p id="view_phone" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Course</label>
                    <p id="view_course" class="form-control"></p>
                </div>
				<div class="mb-3">
                    <label for="">Section</label>
                    <p id="view_section" class="form-control"></p>
                </div>	
				<div class="mb-3">
                    <label for="">Total Payable</label>
					<p id="view_total_payment" class="form-control"></p>
                </div>						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
		<div class="card-body">
                    <h4 class="text-center">Pathshala
                        <a href="index.php" class="btn btn-success float-start mr">Dashboard</a> 
						<a href="logout.php" class="btn btn-warning float-end">LOGOUT</a> 
                    </h4>
                </div>
				<br />
            <div class="card">
                <div class="card-header">
                    <h4>Student Information
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                            Add Student
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Section</th>
								<th>Username</th>
                                <th>Total Payable</th>
                                <th>Paid Amount</th>
								<th>Due</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/dbcon.php';

                            $query = "SELECT * FROM students";
                            $query_run = mysqli_query($con, $query);

                            
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $i = 1;
                                
                                foreach($query_run as $student)
                                
                                {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $student['id'] ?></td>
                                        <td><?= $student['name'] ?></td>
                                        <td><?= $student['address'] ?></td>
                                        <td><?= $student['phone'] ?></td>
                                        <td><?= $student['course'] ?></td>
                                        <td><?= $student['section'] ?></td>
										<td><?= $student['user_name'] ?></td>
                                        <td><?= $student['total_payment'] ?></td>

                                        <td>
                                        <?php
                                        $sid =  $student['id'] ;
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
                                        $sid =  $student['id'] ;
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
                                        
                                        
                                        <td>
                                        
                                            <button type="button" value="<?=$student['id'];?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?=$student['id'];?>" class="editStudentBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$student['id'];?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                                        </td>
                                       
                                    </tr>
                                    
                                    <?php
                                    $i++;
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveStudent')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#student_id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#address').val(res.data.address);
                        $('#phone').val(res.data.phone);
                        //$('#course').val(res.data.course);
                        //$('#section').val(res.data.section);
                        $('#total_payment').val(res.data.total_payment);

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
                url: "code.php",
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

        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_address').text(res.data.address);
                        $('#view_phone').text(res.data.phone);
                        $('#view_course').text(res.data.course);
                        $('#view_section').text(res.data.section);
                        $('#view_total_payment').text(res.data.total_payment);

                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>

<?php 
}else {
   header("Location: login.php");
}
 ?>