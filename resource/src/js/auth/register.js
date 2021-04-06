import {get_api_url} from './../config/url.js'


$(document).ready(function(){
    var regForm         = $('#register-form');
    var displayStatus   = $('.display-status');
    var name            = $('#name');
    var email           = $('#email');
    var password        = $('#password');
    var c_password      = $('#confirm_password');

    regForm.submit(function(e){
        var gender = $('#gender input[name="gender"]:checked').val();

        // remove feedback data
        unsetFeedback();

        $.ajax({
            url: get_api_url('register.php'),
            method: 'post',
            data: {
                name: name.val(),
                email: email.val(),
                gender: (gender == undefined) ? '' : gender,
                password: password.val(),
                confirm_password: c_password.val()
            }
        })
        .done(function(res){
            console.log(res)

            // if error
            if(res.status == 'error'){
                $.each(res.response, function(key, value){
                    var element = $('#'+key)
                    var feedback = $(element.parent().children('.invalid-feedback'));

                    element.addClass('is-invalid');
                    feedback.text(value);
                })
            }

            // if success
            if(res.status == 'success'){
                // display success message
                successFeedback(res.response)
            }

            
        })


        e.preventDefault();
    })

    function unsetFeedback(){
        var forms = $('#register-form input[name]')
        $.each(forms, function(index, element){
            $(element).removeClass('is-invalid');
        })
        $('#gender').removeClass('is-invalid');
    }

    function successFeedback(data){
        displayStatus
        .text(data)
        .fadeIn()
        .delay(3000)
        .fadeOut();
        var forms = $('#register-form input[name]')
        $.each(forms, function(index, element){
            $(element).val('');
        })
    }
})