<?php

    require('../include/db_config.php');    
    require('../include/essentials.php');
    adminLogin();


    if(isset($_POST['add_feature']))
    {
        $frm_data = filteration($_POST);

        // Check if file was uploaded
        if(!isset($_FILES['icon']) || $_FILES['icon']['error'] !== UPLOAD_ERR_OK) {
            echo 'upd_failed';
            exit;
        }

        $img_r = uploadImage($_FILES['icon'], FEATURES_FOLDER);

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
            $q = "INSERT INTO `features`(`icon`, `name`, `description`) VALUES (?, ?, ?)";
            $values = [$img_r, $frm_data['name'], $frm_data['description']];
            $result = insert($q, $values, 'sss');
            echo $result;
        }
    }


    if(isset($_POST['get_features']))
    {
        $result = selectAll('features');
        $i=1;
        $path = FEATURES_IMG_PATH;

        while($row = mysqli_fetch_assoc($result))
        {
            echo <<< data
            <tr class="align-middle">
                <td>$i</td>
                <td><img src="$path$row[icon]" width="100px"></td>
                <td>$row[name]</td>
                <td>$row[description]</td>
                <td>
                    <button type="button" onclick="remove_feature($row[id])" class="btn btn-sm custom-bg text-white shadow-none">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </td>
            </tr>

            data;
            $i++;
        }
    }

    if(isset($_POST['remove_feature']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['remove_feature']];

        $check_q = select("SELECT * FROM `room_features` WHERE `features_id`=?", [$frm_data['remove_feature']], 'i');

        if(mysqli_num_rows($check_q) == 0){
            // Get feature info for image deletion
            $pre_q = "SELECT * FROM `features` WHERE `id`=?";
            $result = select($pre_q, $values, 'i');
            $img = mysqli_fetch_assoc($result);

            // Try to delete image, but proceed even if it fails
            deleteImage($img['icon'], FEATURES_FOLDER);

            // Delete feature from DB
            $q = "DELETE FROM `features` WHERE `id`=?";
            $result = delete($q, $values, 'i');
            echo $result; // Should echo 1 on success
        }
        else{
            echo 'room_added';
        }
    }

    if(isset($_POST['add_facility']))
    {
        $frm_data = filteration($_POST);

        // Check if file was uploaded
        if(!isset($_FILES['icon']) || $_FILES['icon']['error'] !== UPLOAD_ERR_OK) {
            echo 'upd_failed';
            exit;
        }

        $img_r = uploadImage($_FILES['icon'], FACILITIES_FOLDER);

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
            $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?, ?, ?)";
            $values = [$img_r, $frm_data['name'], $frm_data['description']];
            $result = insert($q, $values, 'sss');
            echo $result;
        }
    }

    if(isset($_POST['get_facilities']))
    {
        $result = selectAll('facilities');
        $i=1;
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($result))
        {
            echo <<< data
            <tr class="align-middle">
                <td>$i</td>
                <td><img src="$path$row[icon]" width="100px"></td>
                <td>$row[name]</td>
                <td>$row[description]</td>
                <td>
                    <button type="button" onclick="remove_facility($row[id])" class="btn btn-sm custom-bg text-white shadow-none">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </td>
            </tr>

            data;
            $i++;
        }
    }

    if(isset($_POST['remove_facility']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['remove_facility']];

        // Check if facility is used in any room
        $check_q = select("SELECT * FROM `room_facilities` WHERE `facilities_id`=?", [$frm_data['remove_facility']], 'i');

        if(mysqli_num_rows($check_q) == 0){
            // Get facility info for image deletion
            $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
            $result = select($pre_q, $values, 'i');
            $img = mysqli_fetch_assoc($result);

            // Try to delete image, but proceed even if it fails
            deleteImage($img['icon'], FACILITIES_FOLDER);

            // Delete facility from DB
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $result = delete($q, $values, 'i');
            echo $result; // Should echo 1 on success
        }
        else{
            echo 'room_added';
        }
    }

?>