<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Horizon Blu Hotel - Home</title>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<?php require("include/links.php");?>
<!-- Reach us -->
</head>
<body class="bg-light">

    <?php require('include/header.php');?>
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Contact us</h2>


    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class = "w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <h5>Address</h5>
            <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>    
            </a>

            <h5 class="mt-4">Call us</h5>
            <a href="tel: +88057121256" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['phone1'] ?>
            </a>
            <br>
            <?php 
                if($contact_r['phone2'] != ''){
                    echo<<<data
                    <a href="tel: +$contact_r[phone2]" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +$contact_r[phone2]
                    </a>

                    data;
                    
                }
            ?>

            <h5 class="mt-4">Email</h5>
            <a href="mailto: <?php echo $contact_r['email'] ?>" class="d-inline-block text-decoration-none text-dark">
                <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
            </a>

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
            <div class="col-lg-4 col-md-4">
                <div class="bg-white rounded p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input name="email" required  type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" required  type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                            <button type="submit" name="send" class="btn text-white custom-bg btn-outline-dark shadow-none mt-3">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['send'])){
            $frm_data = filteration($_POST);

            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

            $result = insert($q, $values, "ssss");
            if($result){
                alert("success", "Your message has been sent successfully.");
            } else {
                alert("error", "Unable to send your message. Please try again later.");
            }   
        }
    ?>

    <?php require("include/footer.php");?>

</body>
</html>