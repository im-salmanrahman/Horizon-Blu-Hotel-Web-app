<?php
    require('include/essentials.php');
    require('include/db_config.php');

    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require("include/links.php");?>
    <style class="">
       div.login-form{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
       } 
    </style>
</head>
<body class="bg-light">

<div class="login-form text-center rounded bg-white shadow overflow-hidden">
    <form method="POST">
        <h4 class="my-custom-bg text-white py-3">ADMIN LOGIN PANEL</h4>
        <div class="p-4">
            <div class="mb-3">
                <input name="admin_username" required type="text" class="form-control shadow-none text-center" placeholder="Admin username">
            </div>
            <div class="mb-4">
                <input name="admin_password" required type="password" class="form-control shadow-none text-center" placeholder="Password">                            
            </div>
            <button name="admin_login" type="submit" class="btn text-white custom-bg shadow-none">Log in</button>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['admin_login']))
    {
        $frm_data = filteration($_POST);
        
        $query = "SELECT * FROM `admin_info` WHERE `admin_username`=? AND `admin_password`=?";
        $values = [$frm_data['admin_username'], $frm_data['admin_password']];

        $result = select($query, $values, "ss");
        if($result->num_rows==1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminID'] = $row['sl_no'];
            redirect('dashboard.php');
        }
        else{
            alert('error', 'Login failed - Invalid Credentials!');
        } 
    }
?>

<?php require("include/scripts.php")?>
</body>
</html>