
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

    

})




