<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_username'])) { 
?>
<?php
    require 'db/db.php';
    $query = "SELECT * FROM supervisor";
    $result = mysqli_query($connect, $query);
    $result1 = mysqli_query($connect, $query);
    $result2 = mysqli_query($connect, $query);
    $result3 = mysqli_query($connect, $query);
    
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
<div class="modal fade" id="courseAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveCourse">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Course Title</label>
                    <input type="text" name="course_title" required class="form-control" />
                </div>
				<div class="mb-3">
                    <label for="">Course Teacher (Day)</label><br />
                    
                    <select name = "course_teacher_day">
                    <option value="" selected >None</option>
                    <?php while($row = mysqli_fetch_array($result)):;?>

                    <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>

                     <?php endwhile;?>

                    </select>
                </div>
				<div class="mb-3">
                    <label for="">Course Teacher (Evening)</label><br />
                    
                    <select name = "course_teacher_evening">
                    <option value="" selected >None</option>
                    <?php while($row = mysqli_fetch_array($result1)):;?>

                    <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>

                     <?php endwhile;?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Student Limit</label>
                    <input type="text" name="limits" required class="form-control" />
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Course</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="courseEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateCourse">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="c_id" id="c_id" >

                <div class="mb-3">
                    <label for="">Course Title</label>
                    <input type="text" name="course_title" id="course_title" required class="form-control" />
                </div>
				<!--
				
				-->
                <div class="mb-3">
                    <label for=""> Student Limit</label>
                    <input type="text" name="limits" id="limits" required class="form-control" />
                </div>
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
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
                    <h4>Course Information
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#courseAddModal">
                            Add Course
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Course Title</th>
                                <th>Course Teacher (Day)</th>
                                <th>Course Teacher (Evening)</th>
                                <th>Student Limit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/dbcon.php';

                            $query = "SELECT * FROM course";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $i = 1;
                                foreach($query_run as $course)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $course['course_title'] ?></td>
                                        <td><?= $course['course_teacher_day'] ?></td>
                                        <td><?= $course['course_teacher_evening'] ?></td>
                                        <td><?= $course['limits'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$course['c_id'];?>" class="editCourseBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$course['c_id'];?>" class="deleteCourseBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#saveCourse', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_course", true);

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
                        $('#courseAddModal').modal('hide');
                        $('#saveCourse')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editCourseBtn', function () {

            var c_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?c_id=" + c_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#c_id').val(res.data.c_id);
                        $('#course_title').val(res.data.course_title);
                        $('#course_teacher_day').val(res.data.course_teacher_day);
                        $('#course_teacher_evening').val(res.data.course_teacher_evening);
                        $('#limits').val(res.data.limits);
						
                        $('#courseEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateCourse', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_course", true);

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
                        
                        $('#courseEditModal').modal('hide');
                        $('#updateCourse')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deleteCourseBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var c_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_course': true,
                        'c_id': c_id
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