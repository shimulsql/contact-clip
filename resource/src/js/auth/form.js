
$(document).ready(function(){

    /**
     * show/hide password field - login page
    */

    var passInput = $('#login-password');
    var showBtn = $('#show-password');
    var eyeOpen = 'fa-eye';
    var eyeClose = 'fa-eye-slash';

    showBtn.click(function(){
        if(passInput.attr('type') == 'text'){

            // hide

            passInput.attr('type', 'password');
            showBtn
            .removeClass(eyeOpen)
            .addClass(eyeClose);
            
        } else if(passInput.attr('type') == 'password'){

            // show

            passInput.attr('type', 'text');
            showBtn
            .removeClass(eyeClose)
            .addClass(eyeOpen);
        }
    })










})