<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Blu Hotel - Facilities</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php require("include/links.php");?>
    <style>
       .pop:hover{
        border-top-color:rgb(16, 99, 144) !important;
        transform: scale(1.03);
        transition: all 0.3s; 
       } 
    </style>
    
</head>
<body class="bg-light">

    <?php require('include/header.php');?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
        At Horizon Blu Hotel, we are dedicated to providing our guests with a comfortable and convenient stay. Our comprehensive facilities include complimentary high-speed WiFi access throughout the property, ensuring you stay connected. Each room is equipped with a modern Smart TV for your entertainment needs. For optimal comfort, individually controlled Air conditioning is available in all rooms, along with a Room heater to cater to varying temperature preferences. Guests looking to maintain their fitness routine can enjoy our well-equipped Gymnasium. For relaxation and leisure, take a refreshing dip in our inviting Swimming pool.
            <br>
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php 
                $result = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($result)){
                    echo <<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                            <div class="d-flex align-items-center mb-2">
                                <img src="$path$row[icon]" width="100px">
                                <h5 class="m-0 ms-3">$row[name]</h5>
                            </div>
                            <p>
                            $row[description]
                            </p>
                        </div>
                    </div>
                    data;
                }
            ?>
            <?php 
                $result = selectAll('features');
                $path = FEATURES_IMG_PATH;

                while($row = mysqli_fetch_assoc($result)){
                    echo <<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                            <div class="d-flex align-items-center mb-2">
                                <img src="$path$row[icon]" width="100px">
                                <h5 class="m-0 ms-3">$row[name]</h5>
                            </div>
                            <p>
                            $row[description]
                            </p>
                        </div>
                    </div>
                    data;
                }
            ?>
        </div>
    </div>

    <?php require('include/footer.php');?>

</body>
</html>