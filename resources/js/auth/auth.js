document.addEventListener("DOMContentLoaded", () => {
    if(window.location.hash=='#sign-up'){
        form_sign_up_show()
    }
});

document.getElementById("btn_sign_in").addEventListener("click", form_sign_in_show);
function form_sign_in_show(){
    document.getElementById("login_form").classList.toggle('hide')
    document.getElementById("register_form").classList.toggle('hide')
    setTimeout(() => {
        document.getElementById("login_form").classList.toggle('hidden')
        document.getElementById("register_form").classList.toggle('hidden')
    },1000)
}

document.getElementById("btn_sign_up").addEventListener("click", form_sign_up_show);
function form_sign_up_show(){
    document.getElementById("login_form").classList.toggle('hide')
    document.getElementById("register_form").classList.toggle('hide')
    setTimeout(() => {
        document.getElementById("login_form").classList.toggle('hidden')
        document.getElementById("register_form").classList.toggle('hidden')
    },500)


}


window.confirm_password = function() {
    var password = document.getElementById('password').value;
    var password_confirmation = document.getElementById('password_confirmation').value;
    console.log(password,' - ',password_confirmation)
    if(password == password_confirmation || password_confirmation == ''){
        document.getElementById('error_message_password').classList.add('hidden')
        console.log('hidden')
    }else{
        document.getElementById('error_message_password').classList.remove('hidden')
    }
}