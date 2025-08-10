<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"> Horizon Blu Hotel</h3>
            <p>
            Escape to Horizon Blu Hotel, your haven of luxury
            overlooking the mesmerizing expanse of the sea.
            Our meticulously designed hotel offers a sanctuary
            of comfort and sophistication,where every detail
            is crafted to enhance your stay. From elegantly 
            appointed rooms and suites boasting stunning ocean
            vistas to exceptional dining experiences an rejuvenating
            wellness facilities, Horizon Blu Hotel promises an indulgent
            retreat. Let the soothing rhythm of the waves and our dedicated
            team elevate your senses and create cherished memories.
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact_us.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a><br>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow us</h5>
            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-facebook"></i> Facebook
            </a>
            <br>
            <?php
                if($contact_r['tweet']!=''){
                    echo<<<data
                        <a href="$contact_r[tweet]" class="d-inline-block mb-2">
                            <span class="d-inline-block text-dark text-decoration-none">
                                <i class="bi bi-twitter-x"></i> X
                            </span>
                        </a>

                    data;

                }
            ?>
            <br>
            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
                <i class="bi bi-instagram"></i> Instagram
            </a>
        </div>
    </div>
</div>

<h6 class="text-center p-3 mb-1">
Copyright © 2025 Horizon Blu Hotel. All Rights Reserved.
<br>
Developer: Salmanur Rahman
<a href="https://linkedin.com/in/salmanrahman7" class="d-inline-block text-dark text-decoration-none p-1 mb-1 ms-1 me-1">
    <i class="bi bi-linkedin"></i>
</a>

<a href="https://github.com/salmanrahman7" class="d-inline-block text-dark text-decoration-none mb-1">
    <i class="bi bi-github"></i>
</a>

</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function setActive()
    {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');
        
        for(i=0; i<a_tags.length; i++)
        {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0)
            {
                a_tags[i].classList.add('active');
            }
            else
            {
                a_tags[i].classList.remove('active');
            }
        }
    }
    setActive();
</script>