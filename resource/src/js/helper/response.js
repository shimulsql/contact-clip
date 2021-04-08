
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

ResponseHandler.prototype.success = function(msg = null){

    this.emptyFields();

    (msg == null) ? this.display.text(this.data.response) : this.display.text(msg);

    this.display
    .addClass('alert-success')
    .fadeIn()
    .delay(this.alertTime)
    .fadeOut()

    setTimeout(() => {
        this.display.text('');
    }, this.alertTime + 500)




}

ResponseHandler.prototype.failed = function(){
    if(this.hasError()){
        $.each(this.data.response, (key, value) => {
            var element = this.form.find('input[name='+ key +']');
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
        el.val('');
    });
}

ResponseHandler.prototype.fetchInputs = function(cb){
    var forms = this.form.find('input[name]');

    $.each(forms, (i, element) => {
        var feedbackEL = $($(element).parent().children(this.feedbackClass));
        var element = $(element);
        cb(element, feedbackEL);
    })
}




export const response = new ResponseHandler();