<?php
    require('../include/essentials.php');
    require('../include/db_config.php');
    adminLogin();

    if(isset($_POST['add_room']))
        {
            $features = json_decode($_POST['features']);
            $facilities = json_decode($_POST['facilities']);
            
            $frm_data = filteration($_POST);

            $q1 = "INSERT INTO `rooms`(`name`, `price`, `quantity`, `adult`, `children`, `desc`) VALUES (?,?,?,?,?,?)";
            $values = [
                $frm_data['name'],
                $frm_data['price'],
                $frm_data['quantity'],
                $frm_data['adult'],
                $frm_data['children'],
                $frm_data['desc']
            ];

            if(insert($q1, $values, 'ssiiis'))
            {
                $flag = 1;
                $room_id = mysqli_insert_id($con);
            }
            else
            {
                $flag = 0;
                die("Room insert failed: " . mysqli_error($con));
            }

            $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
            if($stmt = mysqli_prepare($con, $q2))
            {
                foreach($facilities as $facility)
                {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $facility);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            }
            else
            {
                $flag = 0;
                die("Query preparation failed: " . mysqli_error($con));
            }

            $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

            if($stmt = mysqli_prepare($con, $q3))
            {
                foreach($features as $feature)
                {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $feature);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            }
            else
            {
                $flag = 0;
                die("Query preparation failed: " . mysqli_error($con));
            }

            if($flag)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }

        if(isset($_POST['get_all_rooms']))
        {
            $result = selectAll('rooms');
            $i = 0;
            $data = ""; // <-- Initialize $data here

            while($row = mysqli_fetch_assoc($result))
            {
                if($row['status'] == 1)
                {
                    $status = "<button onclick='toggle_status($row[id], 0)' class='btn btn-success btn-sm shadow-none'>active</button>";
                }
                else
                {
                    $status = "<button onclick='toggle_status($row[id], 1)' class='btn btn-danger btn-sm shadow-none'>inactive</button>";
                }
                
                $data .= "
                <tr class='align-middle'>
                    <td>".($i+1)."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['desc']."</td>
                    <td>
                        <span class='badge rounded-pill bg-light text-dark'>
                            Adult: $row[adult]
                        </span><br>
                        <span class='badge rounded-pill bg-light text-dark'>
                            Children: $row[children]
                        </span>
                    </td>
                    <td>"."BDT".$row['price']."/night</td>
                    <td>".$row['quantity']."</td>
                    <td>".$status."</td>
                    <td>
                        <button type='button' onclick='edit_room($row[id])' class='custom-bg text-white shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                            <i class='bi bi-pencil-square'></i> Edit
                        </button>
                        <button type='button' onclick=\"room_images($row[id], '$row[name]')\" class='custom-bg text-white shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#room-images'>
                            <i class='bi bi-images'></i> Image
                        </button>
                    </td>
                    
                </tr>
                ";
                $i++;
            }
            echo $data;
        }

        if(isset($_POST['get_room']))
        {
            $frm_data = filteration($_POST);
            $result1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_room']], 'i');
            $result2 = select("SELECT * FROM `room_features` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
            $result3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
                
            $roomdata = mysqli_fetch_assoc($result1);
            $features = [];
            $facilities = [];

            if(mysqli_num_rows($result2) > 0)
            {
                while($row = mysqli_fetch_assoc($result2))
                {
                    array_push($features, $row['features_id']);
                }
            }
            if(mysqli_num_rows($result3) > 0)
            {
                while($row = mysqli_fetch_assoc($result3))
                {
                    array_push($facilities, $row['facilities_id']);
                }
            }
            $data = ["roomdata" => $roomdata, "features" => $features, "facilities" => $facilities];
            $data = json_encode($data);
            echo $data;
        }

        if(isset($_POST['edit_room']))
        {
            $features = filteration(json_decode($_POST['features']));
            $facilities = filteration(json_decode($_POST['facilities']));

            $frm_data = filteration($_POST);
            $flag = 0;

            $q1 = "UPDATE `rooms` SET `name`=?, `price`=?, `quantity`=?, `adult`=?, `children`=?, `desc`=? WHERE `id`=?";
            $values = [
                $frm_data['name'],
                $frm_data['price'],
                $frm_data['quantity'],
                $frm_data['adult'],
                $frm_data['children'],
                $frm_data['desc'],
                $frm_data['room_id']
            ];

            if(update($q1, $values, 'ssiiisi'))
            {
                $flag = 1;
            }
            $delete_features = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
            $delete_facilities = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

            if(!($delete_features && $delete_facilities))
            {
                $flag = 0;
            }
            else{
                $flag = 1;
            }

            $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
            if($stmt = mysqli_prepare($con, $q2))
            {
                foreach($facilities as $facility)
                {
                    mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $facility);
                    mysqli_stmt_execute($stmt);
                }
                $flag = 1;
                mysqli_stmt_close($stmt);
            }
            else
            {
                $flag = 0;
                die("Query preparation failed: " . mysqli_error($con));
            }

            $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

            if($stmt = mysqli_prepare($con, $q3))
            {
                foreach($features as $feature)
                {
                    mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $feature);
                    mysqli_stmt_execute($stmt);
                }
                $flag = 1;
                mysqli_stmt_close($stmt);
            }
            else
            {
                $flag = 0;
                die("Query preparation failed: " . mysqli_error($con));
            }

            if($flag)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }


        }

        if(isset($_POST['toggle_status']))
        {
            $frm_data = filteration($_POST);
            $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
            $values = [$frm_data['status'], $frm_data['toggle_status']];
            if(update($q, $values, 'ii'))
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }

        if(isset($_POST['add_image']))
        {
            $frm_data = filteration($_POST);

            $img_r = uploadImage($_FILES['image'], ROOMS_FOLDER);

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
                $q = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
                $values = [$frm_data['room_id'], $img_r];
                $result = insert($q, $values, 'is');
                echo $result;
            }
        }

?>