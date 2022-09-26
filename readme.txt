username: admin
password: admin



<?php							
$query = "SELECT SUM(total_payment) FROM students";
$query_run = mysqli_query($con, $query);
while($total_payment = mysqli_fetch_array($query_run))
{
$Earn = $total_payment['SUM(total_payment)'];
										 
$query = "SELECT SUM(salary) FROM staff";
$query_run = mysqli_query($con, $query);
while($salary = mysqli_fetch_array($query_run))
{
$query = "SELECT SUM(salary) FROM supervisor";
$query_run = mysqli_query($con, $query);

while($salary1 = mysqli_fetch_array($query_run))
{
$Expense = $salary['SUM(salary)'] + $salary1['SUM(salary)'];
}
}
											
$Revenue = $Earn - $Expense;
echo'<div class="card-body">$'.$Revenue.'</div>';
}
										
?>