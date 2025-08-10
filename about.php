<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Blu Hotel - About</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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
        <h2 class="fw-bold h-font text-center">About us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Perched along the breathtaking coastline of Cox's Bazar, Horizon Blu Hotel offers an idyllic seaside escape, where the soothing rhythm of the Bay of Bengal meets unparalleled hospitality. We are dedicated to crafting unforgettable experiences for every guest, blending contemporary comforts with the natural beauty of Bangladesh's longest sea beach. From our thoughtfully designed rooms, many boasting stunning ocean views, to our exceptional facilities including complimentary WiFi, smart TVs, climate control, a well-equipped gymnasium, and a refreshing swimming pool, Horizon Blu Hotel is your sanctuary by the sea. Our warm and attentive service ensures a relaxing and memorable stay, making us the perfect destination to unwind, explore the coastal charm, and create lasting memories in Cox's Bazar.
            <br>
        </p>
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
               <h3 class="mb-3">Our Commitment</h3>
               <p>
                    "At Horizon Blu Hotel, our philosophy centers on providing an oasis of tranquility where every guest feels cherished and cared for. We are committed to meticulous service, sustainable practices, and creating an environment that encourages relaxation and rejuvenation. Your comfort and satisfaction are at the heart of everything we do."
               </p> 
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/hotel_image_outdoor1.jpg" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/features/room.png" width="70px">
                    <h4 class="mt-3">100+ Rooms</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/features/customers.png" width="70px">
                    <h4 class="mt-3">200+ Customers</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/features/reviews.png" width="70px">
                    <h4 class="mt-3">150+ Reviews</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/features/staff.png" width="70px">
                    <h4 class="mt-3">200+ Staffs</h4>
                </div>
            </div>
        </div>
    </div>



    <?php require('include/footer.php');?>

</body>
</html>