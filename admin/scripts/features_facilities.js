let feature_s_form = document.getElementById('feature_s_form');
let facility_s_form = document.getElementById('facility_s_form');

feature_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_feature();
});

function add_feature() {

    let data = new FormData();
    data.append('name', feature_s_form.elements['feature_name'].value);
    data.append('icon', feature_s_form.elements['feature_icon'].files[0]);
    data.append('description', feature_s_form.elements['feature_description'].value);
    data.append('add_feature', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
    
        switch(this.responseText) {
            case 'inv_img':
                alert('error','Only JPG, PNG, SVG and WEBP images are allowed!');
                break;
            case 'inv_size':
                alert('error','Image should be less than 20MB!');
                break;
            case 'upd_failed':
                alert('error',"Image upload failed. Server Down!");
                break;
            case '1':
                alert('success','New feature added successfully!');
                feature_s_form.reset();
                get_features();
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

function get_features(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('features-data').innerHTML = this.responseText;
    }

    xhr.send('get_features');
}

function remove_feature(value){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success', 'Feature removed successfully!');
            get_features();
        }
        else if(this.responseText=='room_added'){
            alert('error', 'Feature is added in room!');
        }
        else{
            alert('error', 'Something went wrong! Please try again.');
        }
    }

    xhr.send('remove_feature='+value);
}

facility_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_facility();
});

function add_facility() {

    let data = new FormData();
    data.append('name', facility_s_form.elements['facility_name'].value);
    data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
    data.append('description', facility_s_form.elements['facility_description'].value);
    data.append('add_facility', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('facility-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
    
        switch(this.responseText) {
            case 'inv_img':
                alert('error','Only JPG, PNG, SVG and WEBP images are allowed!');
                break;
            case 'inv_size':
                alert('error','Image should be less than 20MB!');
                break;
            case 'upd_failed':
                alert('error',"Image upload failed. Server Down!");
                break;
            case '1':
                alert('success','New facility added successfully!');
                facility_s_form.reset();
                get_facilities();
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

function get_facilities(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }

    xhr.send('get_facilities');
}

function remove_facility(value){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success', 'Facility removed successfully!');
            get_facilities();
        }
        else if(this.responseText=='room_added'){
            alert('error', 'Facility is added in room.');
        }
        else{
            alert('error', 'Something went wrong! Please try again.');
        }
    }

    xhr.send('remove_facility='+value);
}

window.onload = function() {
    get_features();
    get_facilities();
}