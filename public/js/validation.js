$(document).ready(function() {
    $('input').focus(function(){
        $(this).removeClass('error_class');
        $(this).next().text('');
    });

    $('#signup-form').on('submit',function(event){
        $('.required').each(function () {
            var element_value = $(this).val();
            var element = $(this).attr('id');
            var label = $('#'+element+'_label').text();
            if(element_value == ''){
                $(this).addClass('error_class');
                $(this).next().text('Please Enter '+label);
            }

            if(element == 'name'){
                var regex = /^[a-zA-Z\s]+$/;
                if(!regex.test(element_value)){
                    $(this).addClass('error_class');
                    $(this).next().text('Please Enter Valid '+label);
                }
            }

            if(element == 'email'){
                var emailReg  = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailReg.test(element_value)){
                    $(this).addClass('error_class');
                    $(this).next().text('Please Enter Valid '+label);
                }
            }
        });


        var password = $("#password").val();
        var cpassword = $("#password_confirmation ").val();
        if ((password.length) < 8) {
            $("#password").addClass('error_class');
            $("#password_confirmation").next().text('Password should atleast 8 character in length.');
        }

        if (password != cpassword) {
            $("#cpassword").addClass('error_class');
            $("#password_confirmation").next().text('Your passwords dont match. Try again');
        }

        if($('.error_class').length > 0){
            return false;
        }else{
            $( "#signup-form" ).submit();
        }
    });
});
   