document.addEventListener("DOMContentLoaded", () => {
    if(window.location.hash=='#sign-up'){
        form_sign_up_show()
    }else if(window.location.hash=='#forget-password'){
        form_forget_password_show()
    }
});

try{
    document.getElementById("btn_sign_in").addEventListener("click", form_sign_in_show);
    document.getElementById("btn_sign_in_2").addEventListener("click", form_sign_in_show);
    
}catch (error){

}
function form_sign_in_show(){
    document.getElementById("login_form").classList.remove('hide')
    document.getElementById("register_form").classList.add('hide')
    document.getElementById("forget_password_form").classList.add('hide')

    setTimeout(() => {
        document.getElementById("login_form").classList.remove('hidden')
        document.getElementById("register_form").classList.add('hidden')
        document.getElementById("forget_password_form").classList.add('hidden')
    },1000)
}

try{
    document.getElementById("btn_sign_up").addEventListener("click", form_sign_up_show);
}catch (error){

}
function form_sign_up_show(){
    document.getElementById("login_form").classList.add('hide')
    document.getElementById("register_form").classList.remove('hide')
    document.getElementById("forget_password_form").classList.add('hide')
    setTimeout(() => {
        document.getElementById("login_form").classList.add('hidden')
        document.getElementById("register_form").classList.remove('hidden')
        document.getElementById("forget_password_form").classList.add('hidden')
    },500)


}

try{
    document.getElementById("btn_forget_password").addEventListener("click", form_forget_password_show);
    document.getElementById("btn_forget_password_2").addEventListener("click", form_forget_password_show);
}catch (error){

}

function form_forget_password_show(){
    console.log('test')
    document.getElementById("login_form").classList.add('hide')
    document.getElementById("register_form").classList.add('hide')
    document.getElementById("forget_password_form").classList.remove('hide')
    setTimeout(() => {
        document.getElementById("login_form").classList.add('hidden')
        document.getElementById("register_form").classList.add('hidden')
        document.getElementById("forget_password_form").classList.remove('hidden')
    },500)


}


window.confirm_password = function() {
    var password = document.getElementById('register_password').value;
    var password_confirmation = document.getElementById('register_password_confirmation').value;
    console.log(password,' - ',password_confirmation)
    if(password == password_confirmation || password_confirmation == ''){
        document.getElementById('error_message_password').classList.add('hidden')
        console.log('hidden')
    }else{
        document.getElementById('error_message_password').classList.remove('hidden')
    }
}


window.countdown = function(countDownDate) {
    // console.log(countDownDate)
    // Update the count down every 1 second
   
    var looping = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = "Expired on: "+ days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(looping);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
}