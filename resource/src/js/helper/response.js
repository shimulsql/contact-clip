
function ResponseHandler(){

    this.data;
    this.form;
    this.feedbackClass = '.invalid-feedback';
    this.displaySelector = '.display-response';
    this.display = $(this.displaySelector);
    this.alertTime = 3000;

    this.init = function(data, form){
        
        this.data = data;
        this.form = form;

        this.unsetFeedback();
    }
}

ResponseHandler.prototype.hasError = function(){
    if(this.data.status == 'error'){
        return true;
    }
    return false;
}

ResponseHandler.prototype.success = function(callback, msg = null){

    this.emptyFields();
    // 
    callback();
    (msg == null) ? this.display.text(this.data.response) : this.display.text(msg);

    this.display
    .addClass('alert alert-success')
    .fadeIn()
    .delay(this.alertTime)
    .fadeOut()

    setTimeout(() => {
        this.display.text('')
        .removeClass('alert alert-success');
    }, this.alertTime + 500)




}

ResponseHandler.prototype.failed = function(){
    if(this.hasError()){
        $.each(this.data.response, (key, value) => {
            var element;
            if(this.form.find('input[name='+ key +']').length > 0){
                element = this.form.find('input[name='+ key +']');
            }
            if(this.form.find('select[name='+ key +']').length > 0){
                element = this.form.find('select[name='+ key +']');
            }
            var feedbackEL = $(element.parent().children(this.feedbackClass));
            element.addClass('is-invalid');
            feedbackEL.text(value);
        });
    }
}

ResponseHandler.prototype.unsetFeedback = function(){
    this.fetchInputs((el, feedbackEL) => {
        el.removeClass('is-invalid');
        feedbackEL.text('');
    });
}

ResponseHandler.prototype.emptyFields = function(){
    this.fetchInputs((el) => {
        console.log(el)
        el.val('');
    });
}

ResponseHandler.prototype.fetchInputs = function(cb){
    var inputs;
    var selects;
    if(this.form.find('input[name]').length > 0){
        inputs = this.form.find('input[name]');
    }
    if(this.form.find('select[name]').length > 0){
        selects = this.form.find('select[name]');
    }
    var forms = [...inputs, ...selects];

    $.each(forms, (i, element) => {
        var feedbackEL = $($(element).parent().children(this.feedbackClass));
        var element = $(element);
        cb(element, feedbackEL);
    })
}




export const response = new ResponseHandler();