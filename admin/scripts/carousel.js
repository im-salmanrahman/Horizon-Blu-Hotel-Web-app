let carousel_s_form = document.getElementById('carousel_s_form');
let carousel_picture_inp = document.getElementById('carousel_picture_inp');


carousel_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_image();
});

function add_image() {
    // Check if file is selected
    if(carousel_picture_inp.files.length === 0) {
        alert('error', 'Please select an image file!');
        return;
    }

    let file = carousel_picture_inp.files[0];
    let validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    
    // Client-side validation
    if(!validTypes.includes(file.type)) {
        alert('error', 'Only JPG, PNG, and WEBP images are allowed!');
        return;
    }

    let data = new FormData();
    data.append('picture', file);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
    
        switch(this.responseText) {
            case 'inv_img':
                alert('error','Only JPG, PNG, and WEBP images are allowed!');
                break;
            case 'inv_size':
                alert('error','Image should be less than 20MB!');
                break;
            case 'upd_failed':
                alert('error',"Image upload failed. Server Down!");
                break;
            case '1':
                alert('success','New image added successfully!');
                carousel_picture_inp.value='';
                get_carousel();
                break;
            default:
                alert('error','An unknown error occurred: ' + this.responseText);
        }
    }

    xhr.onerror = function() {
        alert('error', "Request failed. Please try again.");
    };

    xhr.send(data);
}

function get_carousel(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('carousel-data').innerHTML = this.responseText;
    }

    xhr.send('get_carousel');
}

function remove_image(value)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success', 'Image removed successfully!');
            get_carousel();
        }
        else{
            alert('error', 'Server down!');
        }
    }

    xhr.send('remove_image='+value);
}

window.onload = function(){
    get_carousel();
}