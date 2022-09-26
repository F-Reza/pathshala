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

    <title>Staff</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add Staff -->
<div class="modal fade" id="staffAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveStaff">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" required class="form-control" />
                </div>
				<div class="mb-3">
                    <label for="">Designation</label>
                    <input type="text" name="designation" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Salary</label>
                    <input type="text" name="salary" required class="form-control" />
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
                <button type="submit" class="btn btn-primary">Save Staff</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="staffEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateStaff">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="staff_id" id="staff_id" >

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Designation</label>
                    <input type="text" name="designation" id="designation" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Salary</label>
                    <input type="text" name="salary" id="salary" required class="form-control" />
                </div>			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Staff</button>
            </div>
        </form>
        </div>
    </div>
</div>



<!-- View Staff Modal -->
<div class="modal fade" id="staffViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Staff</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Designation</label>
                    <p id="view_designation" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Salary</label>
                    <p id="view_salary" class="form-control"></p>
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
                    <h4>Staff Information
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staffAddModal">
                            Add Staff
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Salary</th>
								<th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/dbcon.php';

                            $query = "SELECT * FROM staff";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $i = 1;
                                foreach($query_run as $staff)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $staff['name'] ?></td>
                                        <td><?= $staff['designation'] ?></td>
                                        <td><?= $staff['salary'] ?></td>
										<td><?= $staff['user_name'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$staff['id'];?>" class="viewStaffBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?=$staff['id'];?>" class="editStaffBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$staff['id'];?>" class="deleteStsffBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#saveStaff', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_staff", true);

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
                        $('#staffAddModal').modal('hide');
                        $('#saveStaff')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStaffBtn', function () {

            var staff_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?staff_id=" + staff_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#staff_id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#designation').val(res.data.designation);
                        $('#salary').val(res.data.salary);
						
                        $('#staffEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStaff', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_staff", true);

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
                        
                        $('#staffEditModal').modal('hide');
                        $('#updateStaff')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewStaffBtn', function () {

            var staff_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?staff_id=" + staff_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_designation').text(res.data.designation);
                        $('#view_salary').text(res.data.salary);

                        $('#staffViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteStsffBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var staff_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_staff': true,
                        'staff_id': staff_id
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