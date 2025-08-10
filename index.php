<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Blu Hotel - Home</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require("include/links.php");?>

    <!-- START CHATBOT CSS INCLUDES -->
    <!-- Tailwind CSS CDN - REQUIRED FOR CHATBOT STYLING -->
    <!-- Font Awesome for icons - REQUIRED FOR CHATBOT ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- END CHATBOT CSS INCLUDES -->

    <style>
        /* Your existing styles */
        .availability-form{
           margin-top: -50px;
           z-index: 2;
           position: relative; 
        }

        @media screen and (max-width: 575px) {
            .availability-form{
            margin-top: 25px;
            padding: 0 35px; 
            }
        }

        .swiper-testimonials .profile img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* START CHATBOT CUSTOM STYLES */
        body {
            font-family: 'Inter', sans-serif; /* Ensure Inter font is used for chatbot */
            /* Add other body styles if not already present in your main CSS */
            /* min-height: 100vh; */
            /* display: flex; */
            /* flex-direction: column; */
        }
        .chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            max-height: 80vh;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }
        .chat-header {
            background-color: #3b82f6; /* Blue-500 */
            color: white;
            padding: 1rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
        }
        .chat-body {
            flex-grow: 1;
            padding: 1rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
        .chat-body::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .chat-input-container {
            padding: 1rem;
            border-top: 1px solid #e5e7eb; /* Gray-200 */
            display: flex;
            flex-direction: column; /* Changed to column for buttons */
            gap: 0.5rem;
        }
        .chat-input {
            flex-grow: 1;
            padding: 0.75rem;
            border: 1px solid #d1d5db; /* Gray-300 */
            border-radius: 10px;
            outline: none;
            font-size: 0.95rem;
        }
        .chat-send-btn {
            background-color: #3b82f6; /* Blue-500 */
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-send-btn:hover {
            background-color: #2563eb; /* Blue-600 */
        }
        .message {
            max-width: 85%;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            word-wrap: break-word;
        }
        .message.user {
            background-color: #e0f2fe; /* Blue-100 */
            align-self: flex-end;
            text-align: right;
        }
        .message.bot {
            background-color: #f3f4f6; /* Gray-100 */
            align-self: flex-start;
        }
        .chatbot-toggle-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3b82f6; /* Blue-500 */
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
            z-index: 1001;
        }
        .chatbot-toggle-btn:hover {
            transform: scale(1.05);
        }
        .hidden {
            display: none;
        }
        .loading-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .loading-spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #3b82f6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* New styles for feature buttons */
        .feature-buttons {
            display: flex;
            flex-wrap: wrap; /* Allow buttons to wrap */
            gap: 0.5rem;
            margin-top: 0.5rem;
            justify-content: center; /* Center buttons */
        }
        .feature-btn {
            background-color: #10b981; /* Emerald-500 */
            color: white;
            padding: 0.6rem 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            font-size: 0.85rem;
            flex-grow: 1; /* Allow buttons to grow */
            min-width: fit-content; /* Ensure text fits */
            white-space: nowrap; /* Prevent text wrapping within button */
        }
        .feature-btn:hover {
            background-color: #059669; /* Emerald-600 */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chat-container {
                width: 90%;
                right: 5%;
                bottom: 10px;
                max-height: 70vh;
            }
            .chatbot-toggle-btn {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                bottom: 10px;
                right: 10px;
            }
            .feature-buttons {
                flex-direction: column; /* Stack buttons on small screens */
            }
            .feature-btn {
                width: 100%; /* Full width for stacked buttons */
            }
        }
        /* END CHATBOT CUSTOM STYLES */
    </style>
</head>
<body class="bg-light">

    <?php require('include/header.php');?>

    <!-- Carousel -->

    <div class="container-fluid mt-3">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php 
                    $result = selectAll('carousel');
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $path = CAROUSEL_IMG_PATH;
                        echo <<< data
                        
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="w-100 d-block">
                            </div>

                        data;
                    }
                ?>
                
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>  
    </div>

    <!-- check availability form -->
    
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="center-text mb-4">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option selected>select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option selected>select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white custom-bg btn-outline-light shadow-none">Search</button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>

<!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Room Types</h2>

    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/superior_room.avif" class="card-img-top">
                    <div class="card-body">
                        <h5>Superior Room</h5>
                        <h6 class="mb-4">1000 BDT per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Room
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                WiFi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room heater
                            </span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 children
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">More details</a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/deluxe_room.avif" class="card-img-top">
                    <div class="card-body">
                        <h5>Deluxe Room</h5>
                        <h6 class="mb-4">2000 BDT per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Room
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                WiFi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room heater
                            </span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 children
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/business_class_room.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Business Class Room</h5>
                        <h6 class="mb-4">4000 BDT per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Room
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                WiFi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room heater
                            </span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 children
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/suite_roomFf.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Suite</h5>
                        <h6 class="mb-4">10,000 BDT per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Room
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                WiFi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room heater
                            </span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 children
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm text-white btn-outline-light custom-bg rounded-0 fw-bold shadow-none">More Rooms>>></a>
            </div>
        </div>
    </div>
    
    <!-- Our Facilities -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/wifi.png" width="80px">
                <h5 class="mt-3">WiFi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/smart-tv.png" width="80px">
                <h5 class="mt-3">Smart TV</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/air-conditioner.png" width="80px">
                <h5 class="mt-3">Air conditioner</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/gym.png" width="80px">
                <h5 class="mt-3">Gymnasium</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/swimming-pool.png" width="80px">
                <h5 class="mt-3">Swimming pool</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm text-white btn-outline-light custom-bg rounded-0 fw-bold shadow-none">More Facilities>>></a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center p-4">
                        <img src="images/room2.jpg">
                        <h6 class="m-0 ms-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Voluptate qui error eum accusantium, nam necessitatibus ad
                        possimus quas laboriosam impedit?
                    </p>
                    <div class="rating">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center p-4">
                        <img src="images/room2.jpg">
                        <h6 class="m-0 ms-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Voluptate qui error eum accusantium, nam necessitatibus ad
                        possimus quas laboriosam impedit?
                    </p>
                    <div class="rating">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center p-4">
                        <img src="images/room2.jpg">
                        <h6 class="m-0 ms-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Voluptate qui error eum accusantium, nam necessitatibus ad
                        possimus quas laboriosam impedit?
                    </p>
                    <div class="rating">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
        <a href="facilities.php" class="btn btn-sm text-white btn-outline-light custom-bg rounded-0 fw-bold shadow-none">See more>>></a>
    </div>

    <!-- Reach us -->

    <?php
        // Fetch contact info from the database before using $contact_r
        // Replace 'contacts' with your actual table name if different
        $contact_q = selectAll('contact_details');
        $contact_r = mysqli_fetch_assoc($contact_q);
    ?>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Contact us</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
            <iframe class = "w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel: +<?php echo $contact_r['phone1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['phone1'] ?>
                    </a>
                    <br>
                    <?php
                        if($contact_r['phone2']!=''){
                            echo<<<data
                                <a href="tel: +$contact_r[phone2]" class="d-inline-block text-decoration-none text-dark">
                                    <i class="bi bi-telephone-fill"></i> +$contact_r[phone2]
                                </a>

                            data;

                        }
                    ?>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5 class="mt-4">Follow us</h5>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3 text-dark fs-5 me-2">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <?php 
                        if($contact_r['tweet'] != ''){
                            echo<<<data
                            <a href="$contact_r[tweet]" class="d-inline-block mb-3 text-dark fs-5 me-2">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            data;
                        }
                    ?>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3 text-dark fs-5 me-2">
                        <i class="bi bi-instagram"></i>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>

    <?php require("include/footer.php");?>

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Your existing Swiper scripts
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true,
            loopPreventsSlide: false,
            speed: 800,
        });

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });

        /* START CHATBOT HTML */
        // This HTML structure for the chatbot toggle button and container
        // should be placed directly before the closing </body> tag.
        // It's included here for completeness of the section to be replaced.
        // If you already placed it separately, ensure it's still here.
        // ...existing code...

        // START CHATBOT HTML & SHADOW DOM
        const chatbotHTML = `
        <div id="chatbot-toggle-btn" class="chatbot-toggle-btn">
            <i class="fas fa-comment-dots"></i>
        </div>
        <div id="chat-container" class="chat-container hidden">
            <div class="chat-header" id="chat-header">
            <span>Horizon Blu Chatbot</span>
            <button id="chat-close-btn" class="text-white text-xl">&times;</button>
            </div>
            <div class="chat-body" id="chat-body">
            <div class="message bot">
                Hello! I'm your Horizon Blu Hotel assistant. How can I help you today?
            </div>
            </div>
            <div class="chat-input-container">
            <input type="text" id="chat-input" class="chat-input" placeholder="Type your message..." />
            <button id="chat-send-btn" class="chat-send-btn">
                <i class="fas fa-paper-plane"></i>
            </button>
            <div class="feature-buttons">
                <button id="suggest-activities-btn" class="feature-btn">Suggest Local Activities ✨</button>
                <button id="summarize-reviews-btn" class="feature-btn">Summarize Reviews ✨</button>
            </div>
            </div>
        </div>
        `;

        // Create a container for the chatbot
        const chatbotHost = document.createElement('div');
        chatbotHost.id = 'chatbot-host';
        document.body.appendChild(chatbotHost);

        // Attach Shadow DOM
        const shadow = chatbotHost.attachShadow({ mode: 'open' });

        // Inject the chatbot HTML into the Shadow DOM
        shadow.innerHTML = `
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css">
        <style>
        .chat-container {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 10000;
            width: 370px;
            max-width: 95vw;
            max-height: 80vh;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18), 0 1.5px 4px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: box-shadow 0.2s;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
        }
        .chat-header {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            padding: 1rem 1.2rem;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.01em;
            box-shadow: 0 1px 0 #e5e7eb;
        }
        .chat-header button {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 0.2rem;
        }
        .chat-header button:hover {
            color: #f87171;
        }
        .chat-body {
            flex: 1 1 0%;
            padding: 1.1rem 1.2rem;
            overflow-y: auto;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            font-size: 1rem;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f8fafc;
        }
        .chat-body::-webkit-scrollbar {
            width: 6px;
            background: #f8fafc;
        }
        .chat-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .chat-input-container {
            padding: 0.9rem 1.2rem 1.1rem 1.2rem;
            border-top: 1px solid #e5e7eb;
            background: #fff;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .chat-input {
            padding: 0.7rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            outline: none;
            font-size: 1rem;
            transition: border-color 0.2s;
            background: #f9fafb;
        }
        .chat-input:focus {
            border-color: #3b82f6;
            background: #fff;
        }
        .chat-send-btn {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            padding: 0.6rem 1.1rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(59,130,246,0.08);
        }
        .chat-send-btn:hover {
            background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 4px 16px rgba(59,130,246,0.13);
        }
        .message {
            max-width: 85%;
            padding: 0.7rem 1.1rem;
            border-radius: 14px;
            word-break: break-word;
            font-size: 1rem;
            line-height: 1.5;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        }
        .message.user {
            background: linear-gradient(90deg, #dbeafe 0%, #f0f9ff 100%);
            align-self: flex-end;
            text-align: right;
            color: #2563eb;
        }
        .message.bot {
            background: #f3f4f6;
            align-self: flex-start;
            color: #334155;
        }
        .chatbot-toggle-btn {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 10001;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            border-radius: 50%;
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(59,130,246,0.18);
            border: none;
            transition: transform 0.18s, box-shadow 0.18s;
            outline: none;
        }
        .chatbot-toggle-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 10px 32px rgba(59,130,246,0.22);
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        }
        .hidden { display: none !important; }
        .feature-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.3rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .feature-btn {
            background: linear-gradient(90deg, #10b981 0%, #22d3ee 100%);
            color: #fff;
            padding: 0.5rem 0.95rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.93rem;
            font-weight: 500;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 1px 4px rgba(16,185,129,0.08);
            margin-bottom: 0.2rem;
        }
        .feature-btn:hover {
            background: linear-gradient(90deg, #059669 0%, #06b6d4 100%);
            box-shadow: 0 2px 8px rgba(16,185,129,0.13);
        }
        .loading-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .loading-spinner {
            border: 4px solid rgba(0, 0, 0, 0.08);
            border-left-color: #3b82f6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @media (max-width: 600px) {
            .chat-container {
            width: 98vw;
            right: 1vw;
            bottom: 8px;
            max-height: 70vh;
            border-radius: 12px;
            }
            .chatbot-toggle-btn {
            width: 48px;
            height: 48px;
            font-size: 1.3rem;
            bottom: 8px;
            right: 8px;
            }
            .chat-header {
            font-size: 1rem;
            padding: 0.7rem 1rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            }
            .chat-input-container {
            padding: 0.7rem 1rem 0.8rem 1rem;
            }
        }
        </style>
        ${chatbotHTML}
        `;


        // These lines should already be present after you inject the chatbot HTML:
        const chatbotToggleBtn = shadow.getElementById('chatbot-toggle-btn');
        const chatContainer = shadow.getElementById('chat-container');
        const chatHeader = shadow.getElementById('chat-header');
        const chatCloseBtn = shadow.getElementById('chat-close-btn');
        const chatBody = shadow.getElementById('chat-body');
        const chatInput = shadow.getElementById('chat-input');
        const chatSendBtn = shadow.getElementById('chat-send-btn');
        const suggestActivitiesBtn = shadow.getElementById('suggest-activities-btn');
        const summarizeReviewsBtn = shadow.getElementById('summarize-reviews-btn');

        // Now attach event listeners directly:
        chatbotToggleBtn.addEventListener('click', () => {
            chatContainer.classList.toggle('hidden');
            chatbotToggleBtn.classList.add('hidden');
            scrollToBottom();
        });

        chatCloseBtn.addEventListener('click', () => {
            chatContainer.classList.add('hidden');
            chatbotToggleBtn.classList.remove('hidden');
        });

        chatHeader.addEventListener('click', (event) => {
            if (event.target === chatHeader || event.target.tagName === 'SPAN') {
                chatContainer.classList.toggle('hidden');
                chatbotToggleBtn.classList.remove('hidden');
            }
        });

        chatSendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        suggestActivitiesBtn.addEventListener('click', () => {
            expectingInterests = true;
            expectingReviewTopic = false;
            displayMessage("Great! To help me suggest the best local activities, please tell me about your interests (e.g., history, nature, food, family-friendly, nightlife, relaxation, adventure, shopping, culture, scenic).", 'bot');
            chatInput.focus();
        });

        summarizeReviewsBtn.addEventListener('click', () => {
            expectingReviewTopic = true;
            expectingInterests = false;
            displayMessage("I can summarize guest reviews for you. What topic are you interested in? (e.g., 'rooms', 'staff', 'food', 'amenities', 'location', 'service')", 'bot');
            chatInput.focus();
        });

        // ...rest of your chatbot JS, but use the above shadow DOM elements...

        // Chat history to maintain context for the LLM
        let chatHistory = [];

        // State to manage special AI features
        let expectingInterests = false;
        let expectingReviewTopic = false;

        // Hotel Knowledge Base (Updated with provided data)
        const hotelKnowledgeBase = `
            Horizon Blu Hotel Information:
            - **Star Rating:** 5-star Luxury Hotel
            - **Location:** Pechardwip, Himchori Road, Cox's Bazar, along the sea beach.
            - **Total Rooms:** Over 100 rooms.
            - **Total Staffs:** Over 100 dedicated staffs.
            - **Check-in/Check-out:** Check-in is at 3:00 PM, Check-out is at 11:00 AM. Early check-in or late check-out may be available upon request and subject to availability/additional charges.
            - **Room Types & Pricing (per night in BDT, approximate for 5-star in Cox's Bazar):**
                - **Superior Room:** BDT 8,000 - 12,000
                - **Deluxe Room:** BDT 12,000 - 18,000
                - **Business Class Room:** BDT 18,000 - 25,000
                - **Suite:** BDT 25,000 - 40,000
            - **Facilities & Features:**
                - **Dining:** Breakfast, Lunch, and Dinner options available.
                    - **The Ocean Grill:** Fine dining, seafood specialties, open for dinner 6:00 PM - 10:00 PM.
                    - **Blu Cafe:** Casual dining, breakfast, lunch, and light snacks, open 7:00 AM - 5:00 PM.
                - **Connectivity:** Complimentary high-speed Wi-Fi available throughout the hotel.
                - **Recreation:**
                    - **Gym:** Fully equipped gymnasium, open 24/7 for guests.
                    - **Swimming Pool:** Large outdoor infinity pool with sea views. Open from 8:00 AM to 8:00 PM daily.
                - **In-Room Amenities:** AC (Air Conditioner), Smart TV, Room Heater.
                - **Parking:** Free on-site parking for guests. Valet service also available.
            - **Contact Details:**
                - **Phone 1:** +88057121256
                - **Phone 2:** +88057121257
                - **Email:** horizonbluhotel.info@gmail.com
            - **Pet Policy:** Unfortunately, we do not allow pets at Horizon Blu Hotel, with the exception of service animals.
            - **Cancellation Policy:** Free cancellation up to 48 hours before check-in. Cancellations within 48 hours or no-shows will be charged for the first night's stay.
            - **Booking:** Book directly on our website or contact our reservations team.
            - **Airport Shuttle:** We offer airport shuttle services. Please contact our concierge desk to arrange this, ideally 24 hours in advance.
            - **Conference Facilities:** Yes, we have several meeting rooms and a large ballroom suitable for conferences and events. Please contact our events team for details.
            - **Children's Activities:** We have a kids' club and a dedicated play area for children aged 3-12. Activities include supervised games, crafts, and storytelling.
            - **Special Offers:** Please check our "Offers" section on the website for current promotions and packages.

            **Our Commitment:** "At Horizon Blu Hotel, our philosophy centers on providing an oasis of tranquility where every guest feels cherished and cared for. We are committed to meticulous service, sustainable practices, and creating an environment that encourages relaxation and rejuvenation. Your comfort and satisfaction are at the heart of everything we do."
        `;

        // Local Attractions Knowledge Base (Context-aware and positive for Cox's Bazar)
        const localAttractionsKnowledgeBase = `
            Local Attractions near Horizon Blu Hotel (Cox's Bazar, Bangladesh):
            - **Cox's Bazar Sea Beach:** The world's longest natural sandy beach, perfect for long strolls, sunset views, and relaxing by the sea. It's right at our doorstep! (Nature, Relaxation, Family-friendly, Scenic)
            - **Himchori Waterfall:** A beautiful small waterfall and lush green hills, a great spot for nature lovers and a refreshing escape. Located near Himchori Road. (Nature, Scenic, Adventure)
            - **Inani Beach:** Known for its golden sands and unique coral stones, offering a serene and picturesque environment. Ideal for photography and peaceful moments. (Nature, Scenic, Relaxation)
            - **Darianagar Safari Park:** A wildlife sanctuary where you can see various animals in a natural habitat. Great for families and wildlife enthusiasts. (Family-friendly, Nature, Wildlife)
            - **Maheshkhali Island:** Accessible by boat, this island offers temples, Buddhist monasteries, and traditional fishing villages. A cultural and scenic experience. (Culture, Scenic, Adventure)
            - **Ramu Buddhist Temple:** A significant Buddhist site with ancient monasteries and large Buddha statues, showcasing local religious heritage. (Culture, History, Spirituality)
            - **Laboni Beach Market:** A vibrant local market near the main beach area, offering handicrafts, souvenirs, and local delicacies. (Shopping, Culture, Food)
            - **Marine Drive Road:** A scenic coastal road offering breathtaking views of the Bay of Bengal, perfect for a drive or cycling. (Scenic, Relaxation, Adventure)
            - **Burmese Market:** A popular market known for unique Burmese handicrafts, textiles, and food items. (Shopping, Culture, Food)
        `;

        // Simulated Guest Reviews (Context-aware and positive)
        const simulatedGuestReviews = `
            --- Guest Review 1 ---
            "Our stay at Horizon Blu was absolutely magical! The **sea view** from our Deluxe room was mesmerizing, especially at sunset. The **staff** were incredibly welcoming and went above and beyond to ensure our comfort. The **swimming pool** was a true oasis, sparkling clean and offering stunning views. Dining at The Ocean Grill was a culinary delight – the **food** was fresh and delicious. Highly recommend for a luxurious getaway in Cox's Bazar!"

            --- Guest Review 2 ---
            "We booked a Family Suite and it was perfect for our family vacation. The two **rooms** were spacious and well-maintained, giving us plenty of space. The **kids' club** was a huge hit with our children, keeping them entertained for hours. The **Wi-Fi** was consistently strong, which was great for staying connected. The **location** right on the beach made it so easy to enjoy the beautiful Cox's Bazar coastline. A truly memorable stay!"

            --- Guest Review 3 ---
            "As a business traveler, the Executive Suite at Horizon Blu exceeded my expectations. The **amenities** were top-notch, and the in-room **Smart TV** and **AC** made my stay very comfortable. The **fitness center** was well-equipped and accessible 24/7, which was a huge plus. The professional and attentive **staff** made my work trip smooth and enjoyable. The hotel's commitment to guest satisfaction truly shines through."

            --- Guest Review 4 ---
            "The Horizon Blu Hotel is a gem in Cox's Bazar! The **service** was impeccable from check-in to check-out. The **breakfast** spread at Blu Cafe was diverse and delicious, a great start to each day. We enjoyed relaxing by the **pool** with the sea breeze. The **room heater** was a nice touch for the cooler evenings. Everything felt luxurious and well-thought-out. We felt truly cherished."

            --- Guest Review 5 ---
            "What a wonderful experience! The **location** of Horizon Blu right on the sea beach is unbeatable. We loved the easy access to the beach for morning walks. The **staff** were always polite and helpful, making us feel right at home. The **food** at both restaurants was excellent, particularly the fresh seafood. The **rooms** were clean, comfortable, and provided a serene retreat after a day of exploring. We appreciated the complimentary **Wi-Fi** too."
        `;

        // Function to display messages in the chat body
        function displayMessage(message, sender) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', sender);
            messageElement.textContent = message;
            chatBody.appendChild(messageElement);
            scrollToBottom();
        }

        // Function to scroll chat to the bottom
        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // Function to send message and get AI response
        async function sendMessage() {
            const userMessage = chatInput.value.trim();
            if (userMessage === '') return;

            displayMessage(userMessage, 'user');
            chatInput.value = ''; // Clear input field

            // Add user message to chat history
            chatHistory.push({ role: "user", parts: [{ text: userMessage }] });

            // Show loading indicator
            const loadingIndicator = document.createElement('div');
            loadingIndicator.classList.add('loading-indicator');
            loadingIndicator.innerHTML = '<div class="loading-spinner"></div>';
            chatBody.appendChild(loadingIndicator);
            scrollToBottom();
            chatInput.disabled = true; // Disable input while loading
            chatSendBtn.disabled = true;

            try {
                let botResponse;
                if (expectingInterests) {
                    botResponse = await getLocalActivities(userMessage);
                    expectingInterests = false; // Reset state after getting interests
                } else if (expectingReviewTopic) {
                    botResponse = await getReviewSummary(userMessage);
                    expectingReviewTopic = false; // Reset state after getting review topic
                }
                else {
                    botResponse = await getHotelInfo(userMessage);
                }
                
                displayMessage(botResponse, 'bot');
                // Add bot response to chat history
                chatHistory.push({ role: "model", parts: [{ text: botResponse }] });
            } catch (error) {
                console.error("Error getting AI response:", error);
                displayMessage("I'm sorry, I'm having trouble connecting right now. Please try again later.", 'bot');
            } finally {
                // Hide loading indicator
                chatBody.removeChild(loadingIndicator);
                chatInput.disabled = false; // Re-enable input
                chatSendBtn.disabled = false;
                chatInput.focus(); // Focus input for next message
            }
        }

        // Function to call Gemini API for general hotel info
        async function getHotelInfo(userQuery) {
            const systemInstruction = `You are a helpful and friendly AI assistant for the Horizon Blu Hotel.
            Your goal is to answer user questions accurately and concisely based *only* on the provided hotel information.
            If a question cannot be answered from the provided information, politely state that you don't have that information.
            Do not make up information. Prioritize accuracy and helpfulness.

            Horizon Blu Hotel Information:
            ${hotelKnowledgeBase}
            `;

            const payload = {
                contents: [
                    { role: "user", parts: [{ text: systemInstruction }] },
                    ...chatHistory,
                    { role: "user", parts: [{ text: userQuery }] }
                ]
            };

            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (result.candidates && result.candidates.length > 0 &&
                result.candidates[0].content && result.candidates[0].content.parts &&
                result.candidates[0].content.parts.length > 0) {
                return result.candidates[0].content.parts[0].text;
            } else {
                console.error("Unexpected API response structure for hotel info:", result);
                throw new Error("Could not get a valid response from the AI for hotel info.");
            }
        }

        // Function to call Gemini API for local activities
        async function getLocalActivities(userInterests) {
            const systemInstruction = `You are a helpful AI assistant for the Horizon Blu Hotel, specializing in local attractions in Cox's Bazar.
            Based on the user's interests, suggest 2-3 relevant local attractions from the provided list.
            Keep your suggestions concise and engaging. Mention why the attraction matches their interest.
            If an interest is not directly matched, try to find the closest fit.
            If the user's interests are too vague or don't match anything, politely state that and ask for more specific interests from the categories provided (Nature, Relaxation, Family-friendly, Scenic, History, Culture, Adventure, Shopping, Food, Nightlife, Wildlife, Spirituality).

            Local Attractions near Horizon Blu Hotel (Cox's Bazar, Bangladesh):
            ${localAttractionsKnowledgeBase}
            `;

            const prompt = `The user is interested in: "${userInterests}". Please suggest local activities from the provided list that match these interests.`;

            const payload = {
                contents: [
                    { role: "user", parts: [{ text: systemInstruction }] },
                    ...chatHistory, // Include previous turns for context
                    { role: "user", parts: [{ text: prompt }] }
                ]
            };

            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (result.candidates && result.candidates.length > 0 &&
                result.candidates[0].content && result.candidates[0].content.parts &&
                result.candidates[0].content.parts.length > 0) {
                return result.candidates[0].content.parts[0].text;
            } else {
                console.error("Unexpected API response structure for activities:", result);
                throw new Error("Could not get a valid response from the AI for activities.");
            }
        }

        // Function to call Gemini API for summarizing reviews
        async function getReviewSummary(topic) {
            const systemInstruction = `You are an AI assistant for Horizon Blu Hotel.
            Your task is to summarize guest reviews focusing on a specific topic.
            Analyze the provided guest reviews and extract key sentiments and common feedback related to the topic "${topic}".
            Provide a concise summary, highlighting both positive and negative points if applicable, based *only* on the reviews provided.
            If the topic is not mentioned in the reviews, state that.

            Guest Reviews:
            ${simulatedGuestReviews}
            `;

            const prompt = `Please summarize the guest reviews specifically about "${topic}".`;

            const payload = {
                contents: [
                    { role: "user", parts: [{ text: systemInstruction }] },
                    ...chatHistory, // Include previous turns for context
                    { role: "user", parts: [{ text: prompt }] }
                ]
            };

            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (result.candidates && result.candidates.length > 0 &&
                result.candidates[0].content && result.candidates[0].content.parts &&
                result.candidates[0].content.parts.length > 0) {
                return result.candidates[0].content.parts[0].text;
            } else {
                console.error("Unexpected API response structure for review summary:", result);
                throw new Error("Could not get a valid response from the AI for review summary.");
            }
        }
        /* END CHATBOT JAVASCRIPT */
    </script>

</body>
</html>