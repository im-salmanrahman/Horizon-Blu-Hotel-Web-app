<?php
    require('include/essentials.php');
    require('include/db_config.php');
    adminLogin();

    if(isset($_GET['seen']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['seen'] == 'all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values = [1];
            if(update($q, $values, 'i'))
            {
                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'All query marked as read!'];
            }
            else
            {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Something went wrong!'];
            }
        }
        else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sl_no`=?";
            $values = [1, $frm_data['seen']];
            if(update($q, $values, 'ii'))
            {
                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Query marked as read!'];
            }
            else
            {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Something went wrong!'];
            }
        }
        header("Location: user_queries.php");
        exit;
    }

    if(isset($_GET['del']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['del'] == 'all'){
            $q = "DELETE FROM `user_queries`";
            if(mysqli_query($con, $q))
            {
                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'All query deleted successfully!'];
            }
            else
            {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Something went wrong!'];
            }
        }
        else{
            $q = "DELETE FROM `user_queries` WHERE `sl_no`=?";
            $values = [$frm_data['del']];
            if(delete($q, $values, 'i'))
            {
                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Query deleted successfully!'];
            }
            else
            {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Something went wrong!'];
            }
        }
        header("Location: user_queries.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require('include/links.php');?> 
</head>
<body class="bg-light">

    <?php
    if(isset($_SESSION['alert'])) {
        $type = $_SESSION['alert']['type'] == 'success' ? 'success' : 'danger';
        $msg = $_SESSION['alert']['msg'];
        echo <<<alert
        <div class="alert alert-$type alert-dismissible fade show custom-alert" role="alert" style="position:fixed;top:20px;right:20px;z-index:9999;min-width:250px;">
            <strong>$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        alert;
        unset($_SESSION['alert']);
    }
    ?>

    <?php require("include/header.php"); ?>
    
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="text-dark mb-4">USER QUERIES</h3>


                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-sm rounded-pill shadow-none btn-primary fixed-action-btn"><i class="bi bi-check-all"></i> Mark all as read</a>
                            <a href="?del=all" class="btn btn-sm rounded-pill btn-danger fixed-action-btn"><i class="bi bi-trash3"></i> Delete all</a>
                        </div>
                       <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="custom-table-top-bg">
                                <th scope="col" width="1%">#</th>
                                <th scope="col" width="5%">Name</th>
                                <th scope="col" width="8%">Email</th>
                                <th scope="col" width="12%">Subject</th>
                                <th scope="col" width="15%">Message</th>
                                <th scope="col" width="10%">Date</th>
                                <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $q = "SELECT * FROM `user_queries` ORDER BY `sl_no` DESC";
                                    $data = mysqli_query($con, $q);
                                    $i=1;
                                    
                                    while($row = mysqli_fetch_assoc($data))
                                    {
                                        $seen = '';
                                        if($row['seen'] != 1)
                                        {
                                            $seen = "<a href='?seen=$row[sl_no]' class='btn btn-sm rounded-pill btn-primary fixed-action-btn'>
                                            <i class='bi bi-check'></i> Mark as read
                                            </a>";
                                        }
                                        $seen.="<a href='?del=$row[sl_no]' class='btn btn-sm rounded-pill btn-danger fixed-action-btn mt-2'>
                                        <i class='bi bi-trash'></i> Delete
                                        </a>";
                                        echo<<<query
                                        <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[subject]</td>
                                            <td>$row[message]</td>
                                            <td>$row[date]</td>
                                            <td>$seen</td>
                                        </tr>
                                        query;
                                        $i++;
                                    }
                                ?>    
                            </tbody>
                            </table> 
                       </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require('include/scripts.php'); ?>
</body>
</html>


