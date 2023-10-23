document.getElementById("general_information").addEventListener("click", function(){ 
    this.classList.add('active')
    document.getElementById("contact_person").classList.remove('active')
    $("#form_general_information").collapse('show')
    $("#form_contact_person").collapse('hide')
    
});

document.getElementById("contact_person").addEventListener("click", function(){ 
    this.classList.add('active')
    document.getElementById("general_information").classList.remove('active')
    $("#form_contact_person").collapse('show')
    $("#form_general_information").collapse('hide')
});

document.getElementById("btn_edit_general_information").addEventListener("click", function(){ 
    $('#form_general_information input, #form_general_information textarea, #form_general_information select').prop('disabled', false)
    $('#email').prop('disabled', true)
    $('#btn_cancel_general_information').show(200)
    $('#btn_save_general_information').show(200)
    $('#btn_edit_general_information').hide(200)
});


document.getElementById("btn_cancel_general_information").addEventListener("click", function(){ 
    $('#form_general_information input, #form_general_information textarea, #form_general_information select').prop('disabled', true)
    $('#btn_cancel_general_information').hide(200)
    $('#btn_save_general_information').hide(200)
    $('#btn_edit_general_information').show(200)
});

document.getElementById("btn_edit_contact_person").addEventListener("click", function(){ 
    $('#form_contact_person input, #form_contact_person textarea, #form_contact_person select').prop('disabled', false)
    $('#btn_cancel_contact_person').show(200)
    $('#btn_save_contact_person').show(200)
    $('#btn_edit_contact_person').hide(200)
});


document.getElementById("btn_cancel_contact_person").addEventListener("click", function(){ 
    $('#form_contact_person input, #form_contact_person textarea, #form_contact_person select').prop('disabled', true)
    $('#btn_cancel_contact_person').hide(200)
    $('#btn_save_contact_person').hide(200)
    $('#btn_edit_contact_person').show(200)
});