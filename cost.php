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

    <title>Others Cost</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add Cost -->
<div class="modal fade" id="costAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Cost</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveCost">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Cost Title</label>
                    <input type="text" name="title" required class="form-control" />
                </div>
				<div class="mb-3">
                    <label for="">Amount</label>
                    <input type="text" name="amount" required class="form-control" />
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

<!-- Edit Cost Modal -->
<div class="modal fade" id="costEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateCost">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="cost_id" id="cost_id" >

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="title" id="title" required class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Amount</label>
                    <input type="text" name="amount" id="amount" required class="form-control" />
                </div>			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Cost</button>
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
                    <h4>Others Cost Information
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#costAddModal">
                            Add Cost
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cost Title</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/dbcon.php';

                            $query = "SELECT * FROM cost";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $cost)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $cost['title'] ?></td>
                                        <td><?= $cost['amount'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$cost['cost_id'];?>" class="editCostBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$cost['cost_id'];?>" class="deleteCostBtn btn btn-danger btn-sm">Delete</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveCost', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_cost", true);

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
                        $('#costAddModal').modal('hide');
                        $('#saveCost')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editCostBtn', function () {

            var cost_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?cost_id=" + cost_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#cost_id').val(res.data.cost_id);
                        $('#title').val(res.data.title);
                        $('#amount').val(res.data.amount);
						
                        $('#costEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateCost', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_cost", true);

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
                        
                        $('#costEditModal').modal('hide');
                        $('#updateCost')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.deleteCostBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var cost_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_cost': true,
                        'cost_id': cost_id
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