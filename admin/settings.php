<?php
    require('include/essentials.php');
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('include/links.php');?> 
</head>
<body class="bg-light">

    <?php require("include/header.php"); ?>
    
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="text-dark mb-4">SETTINGS</h3>

                <!--- General settings section --->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square text-white"></i> Edit
                            </button>
                        </div>    
                        <h6 class="card-subtitle mb-1 fw-bold">Page Title</h6>
                        <p class="card-text" id="page_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                        <p class="card-text"id="site_about"></p>
                    </div>
                </div>

                <!--- General settings modal --->

                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id=general_s_form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Page Title</label>
                                        <input type="text" name="page_title" id="page_title_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="page_title.value = general_data.page_title, site_about.value = general_data.site_about" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <!--- Shutdown section --->

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text border-0 shadow-none">
                            No customers will be allowed to book hotel room, when shutdown mode is turned on.
                        </p>
                    </div>
                </div>


                <!--- Contact details section --->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contact-s">
                                <i class="bi bi-pencil-square text-white"></i> Edit
                            </button>
                        </div> 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone2"></span>
                                    </p>
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                        <p class="card-text" id="email"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter-x"></i>
                                        <span id="tweet"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-instagram"></i>
                                        <span id="insta"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iFrame id="iframe" class="border p-2 w-100" loading="lazy"></iFrame>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('include/scripts.php'); ?>
    <script>
        let general_data;

        let general_s_form = document.getElementById('general_s_form');
        let page_title_inp = document.getElementById('page_title_inp');
        let site_about_inp = document.getElementById('site_about_inp');

        function get_general()
        {
            let page_title = document.getElementById('page_title');
            let site_about = document.getElementById('site_about');

            let shutdown_toggle = document.getElementById('shutdown-toggle');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                general_data = JSON.parse(this.responseText);

                page_title.innerText = general_data.page_title;
                site_about.innerText = general_data.site_about;

                page_title_inp.value = general_data.page_title;
                site_about_inp.value = general_data.site_about;

                if(general_data.shutdown == 0){
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                }
                else
                {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }

            xhr.send('get_general');
        }

        general_s_form.addEventListener('submit', function(e){
            e.preventDefault();
            upd_general(page_title_inp.value, site_about_inp.value);
        })

        function upd_general(page_title_val, site_about_val)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                var myModal = document.getElementById('general-s')
                var modal = bootstrap.Modal.getInstance(myModal)
                modal.hide();

                if(this.responseText == 1)
                {
                    alert('success', 'Changes saved!');
                    get_general();
                }
                else
                {
                    alert('error', 'No changes made!'); 
                }
            }

            xhr.send('page_title='+page_title_val+'&site_about='+site_about_val+'&upd_general');
        }

        function upd_shutdown(val)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText == 1 && general_data.shutdown==0)
                {
                    alert('success', 'Website has been shut down!');
                }
                else
                {
                    alert('success', 'Website is Live!'); 
                }
                get_general();
            }

            xhr.send('upd_shutdown='+val);
        }

        window.onload = function(){
            get_general();
        }

    </script>
</body>
</html>


