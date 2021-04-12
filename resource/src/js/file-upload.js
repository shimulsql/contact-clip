import $ from "jquery";

$(document).ready(function(){
    /**
     * Contact avatar upload 
     */

    var avatarDisplay = $('#avatar-show');
    var btnRemove = $('#remove-contact-avatar');
    var avatarInput = $('#avatar-contact');
    var defaultPath  = '/assets/images/avatar-blank.png';
    // var animationClass = 'animate__animated animate__rubberBand';
    var animationClassIN = 'animate__animated animate__flipInY';
    var animationClassOUT = 'animate__animated animate__flipOutY';

    avatarInput.change(function(e){
        var reader = new FileReader();

        reader.readAsDataURL(e.target.files[0]);

        reader.onload = function(e){
            avatarDisplay.attr('src', e.target.result);
        }
        

        // animation
        avatarDisplay.addClass(animationClassIN)
        setTimeout(() => {
            avatarDisplay.removeClass(animationClassIN)
        }, 1000);
    });

    // Remove image
    btnRemove.click(function(e){ 
        // animation
        avatarDisplay.addClass(animationClassOUT)
        setTimeout(() => {
            avatarDisplay.removeClass(animationClassOUT)
        }, 1000);
        setTimeout(() => {
            avatarDisplay.attr('src', defaultPath);
        }, 700);
        
        e.preventDefault();
    })
})