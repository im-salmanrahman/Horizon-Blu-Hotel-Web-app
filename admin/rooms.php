<?php
    require('include/essentials.php');
    require('include/db_config.php');
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <?php require('include/links.php');?> 
</head>
<body class="bg-light">

    <?php require("include/header.php"); ?>
    
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="text-dark mb-4">Rooms</h3>
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="my-custom-bg text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>  
                                        <th scope="col">Description</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--- Add room modal --->

    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="text" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="text" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adult (Max.)</label>
                                <input type="text" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Children (Max.)</label>
                                <input type="text" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">   
                                    <?php 
                                        $result = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($result)){
                                            echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">   
                                    <?php 
                                        $result = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($result)){
                                            echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--- Edit room modal --->

    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="text" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="text" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adult (Max.)</label>
                                <input type="text" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Children (Max.)</label>
                                <input type="text" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">   
                                    <?php 
                                        $result = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($result)){
                                            echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">   
                                    <?php 
                                        $result = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($result)){
                                            echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--- Manage Room images modal -->

    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Name</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                div
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form id="add_image_form">
                        <label class="form-label fw-bold">Add Image</label>
                        <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                        <button class="btn custom-bg text-white shadow-none">Add</button>
                        <input type="hidden" name="room_id">
                    </form>
                </div>
                <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                    <table class="table table-hover border text-center">
                        <thead>
                            <tr class="my-custom-bg text-light sticky-top">
                                <th scope="col" width=60%>Image</th>
                                <th scope="col">Thumbnail</th>  
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="room-image-data">
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
                


    <?php require('include/scripts.php'); ?>

    <script> 
        let add_room_form = document.getElementById('add_room_form');
        add_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_rooms();
        });

        function add_rooms()
        {
            let data = new FormData();
            data.append('add_room', '');
            data.append('name', add_room_form.elements['name'].value);
            data.append('price', add_room_form.elements['price'].value);
            data.append('quantity', add_room_form.elements['quantity'].value);
            data.append('adult', add_room_form.elements['adult'].value);
            data.append('children', add_room_form.elements['children'].value);
            data.append('desc', add_room_form.elements['desc'].value);

            let features = [];

            add_room_form.querySelectorAll('input[name="features"]').forEach(element=>{
                if(element.checked){
                    features.push(element.value);
                }
            });

            let facilities = [];
            add_room_form.querySelectorAll('input[name="facilities"]').forEach(element=>{
                if(element.checked){
                    facilities.push(element.value);
                }
            });

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success', 'New room added!');
                    add_room_form.reset();
                    get_all_rooms();
                }
                else{
                    alert('error', 'Something went wrong!');
                }
            }

            xhr.send(data);
        }

        function get_all_rooms()
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText) {
                    document.getElementById('room-data').innerHTML = this.responseText;
                }
            }
            xhr.send("get_all_rooms");
        }

        let edit_room_form = document.getElementById('edit_room_form');

        function edit_room(id)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                let data = JSON.parse(this.responseText);
                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc'].value = data.roomdata.desc;
                edit_room_form.elements['room_id'].value = data.roomdata.id;

                edit_room_form.querySelectorAll('input[name="features"]').forEach(cb => {
                    cb.checked = data.features.includes(Number(cb.value));
                });

                edit_room_form.querySelectorAll('input[name="facilities"]').forEach(cb => {
                    cb.checked = data.facilities.includes(Number(cb.value));
                });

                let myModal = document.getElementById('edit-room');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal);
                modal.show();

            }

            xhr.send("get_room="+id);
        }

        edit_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            submit_edit_room();
        });

        function submit_edit_room()
        {
            let data = new FormData();
            data.append('edit_room', '');
            data.append('room_id', edit_room_form.elements['room_id'].value);
            data.append('name', edit_room_form.elements['name'].value);
            data.append('price', edit_room_form.elements['price'].value);
            data.append('quantity', edit_room_form.elements['quantity'].value);
            data.append('adult', edit_room_form.elements['adult'].value);
            data.append('children', edit_room_form.elements['children'].value);
            data.append('desc', edit_room_form.elements['desc'].value);

            let features = [];
            edit_room_form.querySelectorAll('input[name="features"]').forEach(element=>{
                if(element.checked){
                    features.push(element.value);
                }
            });

            let facilities = [];
            edit_room_form.querySelectorAll('input[name="facilities"]').forEach(element=>{
                if(element.checked){
                    facilities.push(element.value);
                }
            });

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('edit-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success', 'Room updated successfully!');
                    edit_room_form.reset();
                    get_all_rooms();
                }
                else{
                    alert('error', 'Something went wrong!');
                }
            }

            xhr.send(data);
        }

        function toggle_status(id, status)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText) {
                    if(this.responseText == 1)
                    {
                        alert('success', 'Room status updated!');
                        get_all_rooms();
                    }
                    else
                    {
                        alert('error', 'Something went wrong!');
                    }
                }
            }
            xhr.send("toggle_status=" + id + "&status=" + status);
        }

        let add_image_form = document.getElementById('add_image_form');
        add_image_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_room_image();
        });

        function add_room_image()
        {
            let data = new FormData();
            
            data.append('image', add_image_form.elements['image'].files[0]);
            data.append('room_id', add_image_form.elements['room_id'].value);
            data.append('add_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms_crud.php", true);

            xhr.onload = function () {
                if (this.responseText) {
                    if(this.responseText == 1)
                    {
                        alert('success', 'Image added successfully!');
                        add_image_form.reset();
                        get_room_images(add_image_form.elements['room_id'].value);
                    }
                    else
                    {
                        alert('error', 'Something went wrong!');
                    }
                }
            }
            xhr.send(data);
        }

        function room_images(id, name)
        {
            document.querySelector('#room-images input[name="room_id"]').value = id;
            document.querySelector('#room-images .modal-title').textContent = name;
            get_room_images(id);
        }

        window.onload = function () {
            get_all_rooms();
        }
    </script>

</body>
</html>


