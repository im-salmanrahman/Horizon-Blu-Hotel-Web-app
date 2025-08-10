
let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let page_title_inp = document.getElementById('page_title_inp');
let site_about_inp = document.getElementById('site_about_inp');

let contact_s_form = document.getElementById('contact_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

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
        var myModal = document.getElementById('general-s');
        var modal = bootstrap.Modal.getInstance(myModal);
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

function get_contacts()
{
    let contacts_p_id = ['address', 'gmap', 'phone1', 'phone2', 'email', 'fb', 'tweet', 'insta'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        contacts_data = JSON.parse(this.responseText);
        contacts_data = Object.values(contacts_data);
        
        for(i=0; i<contacts_p_id.length; i++){
            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
        }

        iframe.src = contacts_data[9];
        contacts_inp(contacts_data);
    }

    xhr.send('get_contacts');
}

function contacts_inp(data){
    let contacts_inp_id = ['address_inp', 'gmap_inp', 'phone1_inp', 'phone2_inp', 'email_inp', 'fb_inp', 'tweet_inp', 'insta_inp', 'iframe_inp'];
    for(i=0; i<contacts_inp_id.length; i++){
        document.getElementById(contacts_inp_id[i]).value = data[i+1];
    }
}


contact_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    upd_contacts();
})

function upd_contacts(){
    let index = ['address', 'gmap', 'phone1', 'phone2', 'email', 'fb', 'tweet', 'insta', 'iframe'];
    let contacts_inp_id = ['address_inp', 'gmap_inp', 'phone1_inp', 'phone2_inp', 'email_inp', 'fb_inp', 'tweet_inp', 'insta_inp', 'iframe_inp'];

    let data_str = "";

    for (i=0; i<index.length; i++){
        data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
    }
    data_str += "upd_contacts";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        var myModal = document.getElementById('contact-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if(this.responseText == 1)
        {
            alert('success', 'Changes saved!');
            get_contacts();
        }
        else
        {
            alert('error', 'No changes made!'); 
        }
    }
    
    xhr.send(data_str);
}

team_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_member();
});

function add_member() {
    // Check if file is selected
    if(member_picture_inp.files.length === 0) {
        alert('error', 'Please select an image file!');
        return;
    }

    let file = member_picture_inp.files[0];
    let validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    
    // Client-side validation
    if(!validTypes.includes(file.type)) {
        alert('error', 'Only JPG, PNG, and WEBP images are allowed!');
        return;
    }

    let data = new FormData();
    data.append('name', member_name_inp.value);
    data.append('picture', file);
    data.append('add_member', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('team-s');
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
                alert('success','New member added successfully!');
                member_name_inp.value='';
                member_picture_inp.value='';
                get_members();
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

function get_members(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send('get_members');
}

function remove_members(value)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success', 'Member removed successfully!');
            get_members();
        }
        else{
            alert('error', 'Server down!');
        }
    }

    xhr.send('remove_members='+value);
}

window.onload = function(){
    get_general();
    get_contacts();
    get_members();
}