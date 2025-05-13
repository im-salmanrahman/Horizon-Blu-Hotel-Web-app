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

?>