
// url defines

export const api_root = window.location.origin;
export const redir_login = api_root + '/admin';
export const redir_logout = api_root + '/login.php';


// api url call
export function get_api_url(endpoint){
    return api_root +'/api/'+ endpoint;
}