<?php

require 'db/dbcon.php';


//==================Student===================================>
if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $total_payment = mysqli_real_escape_string($con, $_POST['total_payment']);
	$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
	$password = mysqli_real_escape_string($con, $_POST['password']);


    if($name == NULL || $address == NULL || $phone == NULL || $course == NULL || $section == NULL || $total_payment == NULL || $user_name == NULL || $password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
$query1 = "SELECT COUNT(course) FROM students WHERE course='$course';";
$query2 = "SELECT COUNT(section) FROM students WHERE section='$section';";

$query_run1 = mysqli_query($con, $query1);
$query_run2 = mysqli_query($con, $query2);

$c_limit=20;
$s_limit=20;


while($select1 = mysqli_fetch_array($query_run1))
{while($select2 = mysqli_fetch_array($query_run2))
{	
	if($c_limit > $select1['COUNT(course)'] || $s_limit > $select2['COUNT(section)'])
	{
	mysqli_begin_transaction($con);
    try{
    $query = "INSERT INTO students (name,address,phone,course,section,total_payment,user_name) VALUES ('$name','$address','$phone','$course','$section','$total_payment','$user_name')";
    $query_2 = "INSERT INTO user_std (user_name,password) VALUES ('$user_name','$password')";
    
	$query_run = mysqli_query($con, $query);
    $query_run_2 = mysqli_query($con, $query_2);
    
    mysqli_commit($con);
	
	
	 if($query_run && $query_run_2)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Created Successfully'
        ];
        echo json_encode($res);
        return;
    } 
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return;
    }

    }

    catch (mysqli_sql_exception $Error)
    {
        mysqli_rollback($con);
        throw $Error;
        echo"Error";

    }
		
	}else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Limit only 20'
        ];
        echo json_encode($res);
        return;
    }
	
}}

  
   
}






if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    //$course = mysqli_real_escape_string($con, $_POST['course']);
	$total_payment = mysqli_real_escape_string($con, $_POST['total_payment']);

    if($name == NULL || $address == NULL || $phone == NULL || $total_payment == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE students SET name='$name',address= '$address', phone='$phone', total_payment='$total_payment'
                WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}






//==================Supervisor===================================>


if(isset($_POST['save_Supervisor']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
    $taking_course = mysqli_real_escape_string($con, $_POST['taking_course']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
	$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
	$password = mysqli_real_escape_string($con, $_POST['password']);


    if($name == NULL || $qualification == NULL || $taking_course == NULL || $salary == NULL || $user_name == NULL || $password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
	mysqli_begin_transaction($con);
    try{

    $query = "INSERT INTO supervisor (name,qualification,taking_course,salary,user_name) VALUES ('$name','$qualification','$taking_course','$salary','$user_name')";
    $query2 = "INSERT INTO user_spv (user_name,password) VALUES ('$user_name','$password')";
    
	$query_run = mysqli_query($con, $query);
    $query_run2 = mysqli_query($con, $query2);
    
    mysqli_commit($con);
	
	
	 if($query_run && $query_run2)
    {
        $res = [
            'status' => 200,
            'message' => 'Supervisor Created Successfully'
        ];
        echo json_encode($res);
        return;
    } 
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Supervisor Not Created'
        ];
        echo json_encode($res);
        return;
    }

    }

    catch (mysqli_sql_exception $Error)
    {
        mysqli_rollback($con);
        throw $Error;
        echo"Error";

    }
}


if(isset($_POST['update_Supervisor']))
{
    $supervisor_id = mysqli_real_escape_string($con, $_POST['supervisor_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
    $taking_course = mysqli_real_escape_string($con, $_POST['taking_course']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);

    if($name == NULL || $qualification == NULL || $taking_course == NULL || $salary == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE supervisor SET name='$name', qualification='$qualification' , taking_course='$taking_course', salary='$salary'
                WHERE id='$supervisor_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Supervisor Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Supervisor Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['supervisor_id']))
{
    $supervisor_id = mysqli_real_escape_string($con, $_GET['supervisor_id']);

    $query = "SELECT * FROM supervisor WHERE id='$supervisor_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $Supervisor = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Supervisor Fetch Successfully by id',
            'data' => $Supervisor
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Supervisor Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_Supervisor']))
{
    $supervisor_id = mysqli_real_escape_string($con, $_POST['supervisor_id']);

    $query = "DELETE FROM supervisor WHERE id='$supervisor_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Supervisor Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Supervisor Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}





//==================Staff===================================>
if(isset($_POST['save_staff']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
	$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
	$password = mysqli_real_escape_string($con, $_POST['password']);


    if($name == NULL || $designation == NULL || $salary == NULL || $user_name == NULL || $password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
	mysqli_begin_transaction($con);
    try{

    $query = "INSERT INTO staff (name,designation,salary,user_name) VALUES ('$name','$designation','$salary','$user_name')";
    $query2 = "INSERT INTO user_stf (user_name,password) VALUES ('$user_name','$password')";
    
	$query_run = mysqli_query($con, $query);
    $query_run2 = mysqli_query($con, $query2);
    
    mysqli_commit($con);
	
	
	 if($query_run && $query_run2)
    {
        $res = [
            'status' => 200,
            'message' => 'Staff Created Successfully'
        ];
        echo json_encode($res);
        return;
    } 
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Staff Not Created'
        ];
        echo json_encode($res);
        return;
    }

    }

    catch (mysqli_sql_exception $Error)
    {
        mysqli_rollback($con);
        throw $Error;
        echo"Error";

    }

    
}


if(isset($_POST['update_staff']))
{
    $staff_id = mysqli_real_escape_string($con, $_POST['staff_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);

    if($name == NULL || $designation == NULL || $salary == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE staff SET name='$name', designation='$designation', salary = '$salary'
                WHERE id='$staff_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Staff Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Staff Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['staff_id']))
{
    $staff_id = mysqli_real_escape_string($con, $_GET['staff_id']);

    $query = "SELECT * FROM staff WHERE id='$staff_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Staff Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Staff Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_staff']))
{
    $staff_id = mysqli_real_escape_string($con, $_POST['staff_id']);

    $query = "DELETE FROM staff WHERE id='$staff_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Staff Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Staff Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}



//==================payment===================================>
if(isset($_POST['save_payment']))
{
    $s_id = mysqli_real_escape_string($con, $_POST['s_id']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);

    if($s_id == NULL || $amount == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO payment (s_id,amount) VALUES ('$s_id','$amount')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'payment Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'payment Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_payment']))
{	
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $amount = mysqli_real_escape_string($con, $_POST['amount']);

    if($amount == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "UPDATE payment SET amount='$amount'
                WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Payment Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Payment Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}




if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM payment WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $payment = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'payment Fetch Successfully by id',
            'data' => $payment
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'payment Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_payment']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $query = "DELETE FROM payment WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'payment Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'payment Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}









?>