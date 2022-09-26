<?php

require '../db/dbcon.php';


//==================Student===================================>

if(isset($_POST['update_student']))
{
    $std_id = mysqli_real_escape_string($con, $_POST['std_id']);

    $password = mysqli_real_escape_string($con, $_POST['password']);

    if($password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE user_std SET password='$password'
                WHERE std_id='$std_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Password Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['std_id']))
{
    $std_id = mysqli_real_escape_string($con, $_GET['std_id']);

    $query = "SELECT * FROM user_std WHERE std_id='$std_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $user_std = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user_std
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//==================Supervisor===================================>

if(isset($_POST['update_Supervisor']))
{
    $spv_id = mysqli_real_escape_string($con, $_POST['spv_id']);

    $password = mysqli_real_escape_string($con, $_POST['password']);

    if($password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE user_spv SET password='$password'
                WHERE spv_id='$spv_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Password Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['spv_id']))
{
    $spv_id = mysqli_real_escape_string($con, $_GET['spv_id']);

    $query = "SELECT * FROM user_spv WHERE spv_id='$spv_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $user_spv = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user_spv
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}





//==================Staff===================================>

if(isset($_POST['update_staff']))
{
    $stf_id = mysqli_real_escape_string($con, $_POST['stf_id']);

    $password = mysqli_real_escape_string($con, $_POST['password']);

    if($password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE user_stf SET password='$password'
                WHERE stf_id='$stf_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Password Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
if(isset($_GET['stf_id']))
{
    $stf_id = mysqli_real_escape_string($con, $_GET['stf_id']);

    $query = "SELECT * FROM user_stf WHERE stf_id='$stf_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $user_stf = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user_stf
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}







?>