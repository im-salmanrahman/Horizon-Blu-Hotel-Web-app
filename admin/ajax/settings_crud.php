<?php

    require('../include/db_config.php');    
    require('../include/essentials.php');
    adminLogin();

    if(isset($_POST['get_general']))
    {
        $q = "SELECT * FROM `settings` WHERE `sl_no`=?";
        $values = [1];
        $result = select($q, $values, "i");
        $data = mysqli_fetch_assoc($result);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_general']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `settings` SET `page_title`=?, `site_about`=? WHERE `sl_no`=?";
        $values = [$frm_data['page_title'], $frm_data['site_about'],1];
        $result = update($q, $values, 'ssi');
        echo $result;
    }

    if(isset($_POST['upd_shutdown']))
    {
        $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

        $q = "UPDATE `settings` SET `shutdown`=? WHERE `sl_no`=?";
        $values = [$frm_data,1];
        $result = update($q, $values, 'ii');
        echo $result;
    }

    if(isset($_POST['get_contacts']))
    {
        $q = "SELECT * FROM `contact_details` WHERE `sl_no`=?";
        $values = [1];
        $result = select($q, $values, "i");
        $data = mysqli_fetch_assoc($result);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_contacts']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`phone1`=?,`phone2`=?,`email`=?,`fb`=?,`tweet`=?,`insta`=?,`iframe`=? WHERE `sl_no`=?";
        $values = [$frm_data['address'], $frm_data['gmap'], $frm_data['phone1'], $frm_data['phone2'], $frm_data['email'], $frm_data['fb'], $frm_data['tweet'], $frm_data['insta'], $frm_data['iframe'], 1];
        $result = update($q, $values, 'sssssssssi');
        echo $result;
    }

    if(isset($_POST['add_member']))
    {
        $frm_data = filteration($_POST);

        // Check if file was uploaded
        if(!isset($_FILES['picture']) || $_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
            echo 'upd_failed';
            exit;
        }

        $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

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
            $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?, ?)";
            $values = [$frm_data['name'], $img_r];
            $result = insert($q, $values, 'ss');
            echo $result;
        }
    }


    if(isset($_POST['get_members']))
    {
        $result = selectAll('team_details');

        while($row = mysqli_fetch_assoc($result))
        {
            $path = ABOUT_IMG_PATH;
            echo <<< data

            <div class="col-md-2 mb-3">
                <div class="card bg-dark text-white">
                    <img src="$path$row[picture]" class="card-img">
                    <div class="card-img-overlay text-end">
                        <button type="button" onclick="remove_members($row[sl_no])" class="custom-bg text-white shadow-none btn-sm">
                            <i class="bi bi-trash3"></i> Delete
                        </button>
                    </div>
                    <p class="card-text text-center px-3 py-2">$row[name]</p>
                </div>
            </div>

            data;
        }
    }

    if(isset($_POST['remove_members']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['remove_members']];

        $pre_q = "SELECT * FROM `team_details` WHERE `sl_no`=?";
        $result = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($result);

        if(deleteImage($img['picture'],ABOUT_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sl_no`=?";
            $result = delete($q,$values,'i');
            echo $result;
        }
        else{
            echo 0;
        }

    }

?>