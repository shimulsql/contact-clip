
import {get_api_url} from './config/url.js';
import {response} from './helper/response.js';
import {store} from './helper/storage.js';

/*
,-----------------------------------,
|   Group Data Handle               |
'-----------------------------------'
*/

/** Insert Data */

$(document).ready(function(){
    var form = $('#group-form');
    var name = form.find('input[name="name"]');

    form.submit(function(e){
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: get_api_url('group.php'),
            data: {
                name: name.val()
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Access-Token', store.get('access_token'));
            }
        })
        .done(function(data){
            response.init(data, form);

            if(response.hasError())
            {
                response.failed();
            }
            else
            {
                response.success('Added new group');
            }


        })
        
        
        
    })
});



/*
,-----------------------------------,
|   Contact Data Handle             |
'-----------------------------------'
*/

$(document).ready(function(){

    /**
     * Get groups and set to group selector
     */

    var groupSelector = $('#group');


    $.ajax({
        method: 'GET',
        url: get_api_url('group.php'),
        beforeSend: function(xhr){
            xhr.setRequestHeader('Access-Token', store.get('access_token'));
        }
    })
    .done(function(res){
        var options = '';
        if(res.status != 'error'){
            $.each(res, function(i, group){
                options += '<option value="'+ group.id +'">'+ group.name +'</option>';
            });
        }
        else
        {
            options = '<option value="0">Public</option>';
        }
        

        groupSelector.html(options);
    })



    // create contact
    var form = $('#form-contact-create');
    var avatarDisplay = $('#avatar-show');
    var defaultPath  = '/assets/images/avatar-blank.png';

    form.submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: get_api_url('contact.php'),
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(xhr){
                xhr.setRequestHeader('Access-Token', store.get('access_token'));
            }
        })
        .done(function(data){
            response.init(data, form)

            if(response.hasError()){
                response.failed();
            }else{
                response.success(function(){
                    avatarDisplay.attr('src', defaultPath)
                },'Added new Contact');
            }
        })

    })

})




