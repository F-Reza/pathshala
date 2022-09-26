<?php 
  session_start();
  if (isset($_SESSION['user_id']) && isset($_SESSION['user_username'])) { 
?>

<?php
    require 'db/db.php';
    $query = "SELECT id,name FROM students";
    $query2 = "SELECT s_id FROM payment"; 
    $result1 = mysqli_query($connect, $query);
    $result2 = mysqli_query($connect, $query);
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Collect Fee</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add Payment -->
<div class="modal fade" id="paymentAddModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="savePayment">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Select Student</label>
                    
                    <select name = "s_id">
                    <option value="" selected >None</option>
                    <?php while($row1 = mysqli_fetch_array($result1)):;?>

                    <option value="<?php echo $row1['id'];?>"><?php echo $row1['id'].' - '.$row1['name'];?></option>

                     <?php endwhile;?>

                    </select>
        
                </div>
				<div class="mb-3">
                    <label for="">Amount</label>
                    <input type="text" name="amount" required class="form-control" />
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Payment</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Payment Modal -->
<div class="modal fade" id="paymentEditModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updatePayment">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="id" id="id" >

                <div class="mb-3">
                    <label for="">Amount</label>
                    <input type="text" name="amount" id="amount" required class="form-control" />
                </div>			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Payment</button>
            </div>
        </form>
        </div>
    </div>
</div>



<!-- View Payment Modal -->
<div class="modal fade" id="paymentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Student ID</label>
                    <p id="view_s_id" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Amount</label>
                    <p id="view_amount" class="form-control"></p>
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
                    <h4>Payment Information
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#paymentAddModel">
                            Add Payment
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Student ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/dbcon.php';

                            $query = "SELECT * FROM payment";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $i = 1;
                                foreach($query_run as $payment)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $payment['s_id'] ?></td>
                                        <td><?= $payment['amount'] ?></td>
                                        <td><?= $payment['date_time'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$payment['id'];?>" class="viewPaymentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?=$payment['id'];?>" class="editPaymentBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$payment['id'];?>" class="deletePaymentBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#savePayment', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_payment", true);

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
                        $('#paymentAddModel').modal('hide');
                        $('#savePayment')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editPaymentBtn', function () {

            var id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#id').val(res.data.id);
                        $('#amount').val(res.data.amount);
						
                        $('#paymentEditModel').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updatePayment', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_payment", true);

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
                        
                        $('#paymentEditModel').modal('hide');
                        $('#updatePayment')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewPaymentBtn', function () {

            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_s_id').text(res.data.s_id);
                        $('#view_amount').text(res.data.amount);

                        $('#paymentViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deletePaymentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_payment': true,
                        'id': id
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