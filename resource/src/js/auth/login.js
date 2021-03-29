// import $ from "jQuery"

import {get_api_url, redir_login, redir_logout} from './../config/url.js'

$(document).ready(function(){

    var form = $('#login-form');
    var email = $('#login-email');
    var password = $('#login-password');
    var btnLogin = $('#login-button');
    var disRes = $('.display-response');

    btnLogin.click(function(e){
        $.ajax({
            method: 'POST',
            url: get_api_url('login.php'),
            data: {
                email: email.val(),
                password: password.val()
            }
        })
        .done(function(res){

            if(res.status == 'error'){
                form
                .addClass('animate__shakeX')
                setTimeout(function(){
                    form.removeClass('animate__shakeX')
                },2000)

                disRes
                .addClass('alert-danger')
                .fadeIn()


                if(res.response.data != undefined){
                    var errorFileds = res.response.data;

                    disRes
                    .text(errorFileds.fields)
                }
                else{
                    disRes
                    .text(res.response.message)
                }


                disRes
                .delay(3000)
                .fadeOut()

            }


            

            if(res.status == 'success'){
                disRes
                .removeClass('alert-danger')
                .addClass('alert-success')
                .fadeIn()
                .text('Successfully logged in, redirecting to dashboard..')
                setTimeout(function(){
                    window.location = redir_login;
                }, 2000)
            }


        })

        
        e.preventDefault();
    });


    // logout
    var btnLogout = $('#logout-button');

    btnLogout.click(function(e){

        $.ajax({
            method: 'DELETE',
            url: get_api_url('login.php'),

        })
        .done(function(res){

            if(res.status == 'success'){
                window.location = redir_logout;
            }

        })

        e.preventDefault();
    });

});
