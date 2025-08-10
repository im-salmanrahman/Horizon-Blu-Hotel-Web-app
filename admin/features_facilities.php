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
    <title>Admin Panel - Features & Facilities</title>
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
                <h3 class="text-dark mb-4">FEATURES & FACILITIES</h3>


                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                       <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                       <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                            <thead>
                                <tr class="custom-table-top-bg">
                                <th scope="col" width="2%">#</th>
                                <th scope="col" width="10%">Icon</th>
                                <th scope="col" width="15%">Name</th>
                                <th scope="col" width="40%">Description</th>
                                <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id = "features-data">
                            </tbody>
                            </table> 
                       </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        
                       <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                       <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                            <thead>
                                <tr class="custom-table-top-bg">
                                <th scope="col" width="2%">#</th>
                                <th scope="col" width="10%">Icon</th>
                                <th scope="col" width="15%">Name</th>
                                <th scope="col" width="40%">Description</th>
                                <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id = "facilities-data">
                            </tbody>
                            </table> 
                       </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!--- Feature modal --->

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="feature_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" name="feature_icon" accept=".jpg, .png, .webp, .jpeg, .svg" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="feature_description" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <!--- Facility modal --->

    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Facility</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="facility_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" name="facility_icon" accept=".jpg, .png, .webp, .jpeg, .svg" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facility_description" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <?php require('include/scripts.php'); ?>

    <script src="scripts/features_facilities.js"></script>
</body>
</html>


