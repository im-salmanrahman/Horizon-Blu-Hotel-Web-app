<?php

    require('../include/db_config.php');    
    require('../include/essentials.php');
    adminLogin();


    if(isset($_POST['add_image']))
    {
        // Check if file was uploaded
        if(!isset($_FILES['picture']) || $_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
            echo 'upd_failed';
            exit;
        }

        $img_r = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
            exit;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
            exit;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
            exit;
        }
        else{
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$img_r];
            $result = insert($q, $values, 's');
            echo $result;
        }
    }


    if(isset($_POST['get_carousel']))
    {
        $result = selectAll('carousel');

        while($row = mysqli_fetch_assoc($result))
        {
            $path = CAROUSEL_IMG_PATH;
            echo <<< data

            <div class="col-md-4 mb-3">
                <div class="card bg-dark text-white">
                    <img src="$path$row[image]" class="card-img">
                    <div class="card-img-overlay text-end">
                        <button type="button" onclick="remove_image($row[sl_no])" class="custom-bg text-white shadow-none btn-sm">
                            <i class="bi bi-trash3"></i> Delete
                        </button>
                    </div>
                </div>
            </div>

            data;
        }
    }

    if(isset($_POST['remove_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['remove_image']];

        $pre_q = "SELECT * FROM `carousel` WHERE `sl_no`=?";
        $result = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($result);

        if(deleteImage($img['image'],CAROUSEL_FOLDER)){
            $q = "DELETE FROM `carousel` WHERE `sl_no`=?";
            $result = delete($q,$values,'i');
            echo $result;
        }
        else{
            echo 0;
        }

    }

?>