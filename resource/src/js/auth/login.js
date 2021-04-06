// import $ from "jQuery"

import {get_api_url, redir_login, redir_logout} from './../config/url.js';
import {store} from './../helper/storage.js';

$(document).ready(function(){

    var form = $('#login-form');
    var email = $('#login-email');
    var password = $('#login-password');
    var keepLogin = $('#keep-login');
    var btnLogin = $('#login-button');
    var disRes = $('.display-response');
    var keepUser;

    btnLogin.click(function(e){
        if(keepLogin.is(':checked')){
            keepUser = true;
        }else{
            keepUser = false;
        }
        
        $.ajax({
            method: 'POST',
            url: get_api_url('login.php'),
            data: {
                email: email.val(),
                password: password.val(),
                keep_login: keepUser
            }
        })
        .done(function(res){
            console.log(res)
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
                /**
                 * set accessToken to LocalStorage
                 */
                var token = res.response.access_token;

                if(store.isset('access_token')){
                    store.update('access_token', token);
                }else{
                    store.set('access_token', token);
                }


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
                store.delete('access_token');
                window.location = redir_logout;
            }

        })

        e.preventDefault();
    });

});

