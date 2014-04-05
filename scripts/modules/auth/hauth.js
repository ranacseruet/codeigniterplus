function jInit()
{
    $('.loaderDiv').hide();
    var email   =   $("input:text#email").val();
    
    if(email){
        $("#email").attr('disabled','disabled');
    }
    $('#email').on('change', function() {
        $("#user_email").val($("#email").val());
    });
    
     $("#email").rules("add",{
        remote: {
            url: base_url+"api/member/check_email_availability",
            type: "post",
            data: {
                onStart: function(){
                    $("#email").addClass('loading');
                },
                onStop: function(){
                    $("#email").removeClass('loading');
                },        
                email: function() {  
                    return $("#email").val();
                }          
            }
        }
    });
    
    $.validator.addMethod("usernameRegex", function(value, element) {
         return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
    }, "Username must contain only letters, numbers, or dashes.");
    
    $("#username").rules("add",{
        minlength: 4,
        maxlength: 20,
        usernameRegex:true,
        remote: {
            url: base_url+"api/member/check_username_availability",
            type: "post",
            data: {
                onStart: function(){
                    $("#username").addClass('loading');
                },
                onStop: function(){
                    $("#username").removeClass('loading');
                },        
                username: function() {
                    return $("#username").val();
                }
            }
        } 
    });
    
    $("#password").rules("add",{
        minlength: 6,
        maxlength: 20
    })
}