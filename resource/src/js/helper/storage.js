    
    /**
     * 
     * Local storage
     */



    function Store(){
       this.storage = window.localStorage;
    }

    Store.prototype.get = function(name){
        if(!this.isset(name)){
            return '"' + name + '" not found in LStorage';
        }
        return this.storage.getItem(name);
    }

    Store.prototype.set = function(name, value){
        if(!this.isset(name)){
            this.storage.setItem(name, value);
        }
    }

    Store.prototype.update = function(name, value){
        if(this.isset(name)){
            this.storage.setItem(name, value);
        }
    }

    Store.prototype.delete = function(name){
        if(this.isset(name)){
            this.storage.removeItem(name);
        }
    }



    Store.prototype.isset = function(name){
        if(this.storage.getItem(name) != undefined){
            return true;
        }
        return false;
    }

    
    export const store = new Store;


    