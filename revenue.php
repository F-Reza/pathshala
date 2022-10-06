<?php 
require 'db/dbcon.php';
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_username'])) { 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Pathshala</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-4 me-lg-4">
			<li><a class="dropdown-item about" href="about.php">About Us</a></li>
			</ul>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
							<a class="nav-link" href="course.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Course
                            </a>
                            <a class="nav-link" href="students.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Students
                            </a>
                            <a class="nav-link" href="supervisor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Supervisor
                            </a>
							<a class="nav-link" href="staff.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Staff
                            </a>
                            <a class="nav-link" href="payment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Collect Fee
                            </a>
							<a class="nav-link" href="revenue.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Revenue MS
                            </a>
							<a class="nav-link" href="cost.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Others Cost
                            </a>
                            <a class="nav-link" href="about.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                About Us
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Pathshala
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Revenue Management</h1>
                        
						<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="card mt-5">
									<div class="card-header">
									</div>
									<div class="card-body">
									
										<form action="" method="GET">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>From Date</label>
														<input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>To Date</label>
														<input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Click to Filter</label> <br>
													  <button type="submit" class="btn btn-primary">Filter</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								</div>
							</div>
						</div>
						<hr />
						<?php 
							//$con = mysqli_connect("localhost","root","","pathshala");

							if(isset($_GET['from_date']) && isset($_GET['to_date']))
							{
								$from_date = $_GET['from_date'];
								$to_date = $_GET['to_date'];

								$query = "SELECT SUM(amount) FROM payment WHERE date_time BETWEEN '$from_date' AND '$to_date' ";
								$query_run = mysqli_query($con, $query);

							   while($amount = mysqli_fetch_array($query_run))
								{
									if($amount['SUM(amount)'] <= 0){
										?>
										<center><h3> <?php echo 'No data found in this Range!'; ?></h3> </center><?php
									}else{
								?>
								<div class="row">
								<h4>Serarch Result</h4>
								<div class="col-xl-4 col-md-6">
									<div class="card bg-secondary text-white mb-4">
										<div class="card-body">Earning</div>
										<div class="card-footer d-flex align-items-center justify-content-between">
										<?php 
										echo '৳'.$amount['SUM(amount)'];
										?>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Expense</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
									<?php							
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

										while($salary = mysqli_fetch_array($query_run))
										{
										 
										
                                        $query = "SELECT SUM(salary) FROM supervisor";
										
                                        $query_run = mysqli_query($con, $query);

										while($salary1 = mysqli_fetch_array($query_run))
										{
										$query = "SELECT SUM(amount) FROM cost";
										
                                        $query_run = mysqli_query($con, $query);

										while($expense = mysqli_fetch_array($query_run))
											{
											
                                            $sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
											
											$totalExpense = $expense['SUM(amount)'] + $sumSalary;
											
											echo '৳'.$totalExpense;
										 
											}
										}
                                    }
									?>
                                    </div>
                                </div>
                            </div>
								
								<div class="col-xl-4 col-md-6">
                                <?php
										$query = "SELECT SUM(amount) FROM payment WHERE date_time BETWEEN '$from_date' AND '$to_date' ";
										$query_run = mysqli_query($con, $query);

										while($amount = mysqli_fetch_array($query_run))
										{
										 $Earn = $amount['SUM(amount)'];
										 
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

											while($salary = mysqli_fetch_array($query_run))
											{
											$query = "SELECT SUM(salary) FROM supervisor";
											$query_run = mysqli_query($con, $query);

												while($salary1 = mysqli_fetch_array($query_run))
												{
												$query = "SELECT SUM(amount) FROM cost";
												$query_run = mysqli_query($con, $query);

													while($expense = mysqli_fetch_array($query_run))
													{
														$sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
														$totalExpense = $expense['SUM(amount)'] + $sumSalary;
													}
												}
											}
											
											$Revenue = $Earn - $totalExpense;
											if($Revenue <=0){
											?>	
												<div class="card bg-danger text-white mb-4">
												<div class="card-body">Revenue (-)</div>
											<?php	
											}else{
											?>
												<div class="card bg-success text-white mb-4">
												<div class="card-body">Revenue</div>
											<?php
											}
										}
								?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php							
										$query = "SELECT SUM(amount) FROM payment WHERE date_time BETWEEN '$from_date' AND '$to_date' ";
										$query_run = mysqli_query($con, $query);

										while($amount = mysqli_fetch_array($query_run))
										{
										 $Earn = $amount['SUM(amount)'];
										 
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

											while($salary = mysqli_fetch_array($query_run))
											{
											$query = "SELECT SUM(salary) FROM supervisor";
											$query_run = mysqli_query($con, $query);

												while($salary1 = mysqli_fetch_array($query_run))
												{
												$query = "SELECT SUM(amount) FROM cost";
												$query_run = mysqli_query($con, $query);

													while($expense = mysqli_fetch_array($query_run))
													{
														$sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
														$totalExpense = $expense['SUM(amount)'] + $sumSalary;
													}
												}
											}	
											$Revenue = $Earn - $totalExpense;
										 echo '৳'.$Revenue;
										}
										
									?>
                                    </div>
									</div>
									</div>
								</div>		
								

								<?php 	
									}
								 
								}
							}
						?> 
	                    <br><br>
                        <div class="row">
						<h4>Total</h4>
                        <div class="col-xl-4 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Total Earning</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
									<?php							
										$query = "SELECT SUM(amount) FROM payment";
										$query_run = mysqli_query($con, $query);

										while($amount = mysqli_fetch_array($query_run))
										{
										 echo '৳'.$amount['SUM(amount)'];
										}
									?>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Expense</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
									<?php							
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

										while($salary = mysqli_fetch_array($query_run))
										{
										 
										
                                        $query = "SELECT SUM(salary) FROM supervisor";
										
                                        $query_run = mysqli_query($con, $query);

										while($salary1 = mysqli_fetch_array($query_run))
										{
										$query = "SELECT SUM(amount) FROM cost";
										
                                        $query_run = mysqli_query($con, $query);

										while($expense = mysqli_fetch_array($query_run))
											{
											
                                            $sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
											
											$totalExpense = $expense['SUM(amount)'] + $sumSalary;
											
											echo '৳'.$totalExpense;
										 
											}
										}
                                    }
									?>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-4 col-md-6">
							
							<?php
							$query = "SELECT SUM(amount) FROM payment";
										$query_run = mysqli_query($con, $query);

										while($amount = mysqli_fetch_array($query_run))
										{
										 $Earn = $amount['SUM(amount)'];
										 
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

											while($salary = mysqli_fetch_array($query_run))
											{
											$query = "SELECT SUM(salary) FROM supervisor";
											$query_run = mysqli_query($con, $query);

												while($salary1 = mysqli_fetch_array($query_run))
												{
												$query = "SELECT SUM(amount) FROM cost";
												$query_run = mysqli_query($con, $query);

													while($expense = mysqli_fetch_array($query_run))
													{
														$sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
														$totalExpense = $expense['SUM(amount)'] + $sumSalary;
													}
												}
											}
											
											$Revenue = $Earn - $totalExpense;
											if($Revenue <=0){
											?>	
												<div class="card bg-danger text-white mb-4">
												<div class="card-body">Total Revenue (-)</div>
											<?php	
											}else{
											?>
												<div class="card bg-success text-white mb-4">
												<div class="card-body">Total Revenue</div>
											<?php
											}
										}
								?>
                                    
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php							
										$query = "SELECT SUM(amount) FROM payment";
										$query_run = mysqli_query($con, $query);

										while($amount = mysqli_fetch_array($query_run))
										{
										 $Earn = $amount['SUM(amount)'];
										 
										$query = "SELECT SUM(salary) FROM staff";
										$query_run = mysqli_query($con, $query);

											while($salary = mysqli_fetch_array($query_run))
											{
											$query = "SELECT SUM(salary) FROM supervisor";
											$query_run = mysqli_query($con, $query);

												while($salary1 = mysqli_fetch_array($query_run))
												{
												$query = "SELECT SUM(amount) FROM cost";
												$query_run = mysqli_query($con, $query);

													while($expense = mysqli_fetch_array($query_run))
													{
														$sumSalary = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
														$totalExpense = $expense['SUM(amount)'] + $sumSalary;
													}
												}
											}	
											$Revenue = $Earn - $totalExpense;
										 echo '৳'.$Revenue;
										}
										
									?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                powered by
                                --
                                <a href="https://facebook.com/NextDigitOfficial/" target="_blank">Next Digit</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

<?php 
}else {
   header("Location: login.php");
}
 ?>
