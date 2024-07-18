function registerValidation($this){
    const email = $this.find('input[type="email"]');
    const password = $this.find('input#password');
    const confirmPassword = $this.find('input#confromPassword');
    
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(emailRegex.test(email.val())){
        email.parent().removeClass('error');
    }
    else{
        email.parent().addClass('error');
        password.siblings('.error').text('Email musi być w formacie email')
    }
    
    if(password.val().length >= 8){
        password.parent().removeClass('error');
    }
    else{
        password.parent().addClass('error');
    }
    
    if(password.val() === confirmPassword.val()){
        confirmPassword.parent().removeClass('error');
    }
    else{
        confirmPassword.parent().addClass('error');
    }

    if(emailRegex.test(email.val()) && password.val().length >= 8 && password.val() === confirmPassword.val()){
        return true;

    }
    else{
        return false;
    }
}

function registerAjaxErrors(statusCode, message){
    if(statusCode === 409){
        $('[data-type="register-form"] input[type="email"]').parent().addClass('error');
        $('[data-type="register-form"] input[type="email"]').siblings('.error').text(message)
    }
    else{
        $('[data-type="register-form"] input[type="email"]').parent().removeClass('error');
        pass$('[data-type="register-form"] input[type="email"]').siblings('.error').text('Email musi być w formacie email')
    }
}

function registerUser($this){
    const email = $this.find('input[type="email"]').val();
    const password = $this.find('input#password').val();
    const dataToSend = { email, password  }
    console.log(dataToSend)
    $.ajax({
        type: 'POST',
        url: '/php/register.php',
        data: dataToSend,
        dataType: 'json',
        success: function(response) {
            window.location = '/';
        },
        error: function(xhr, status, error) {
            const errorJson = xhr.responseJSON;
            const statusCode = xhr.status;

            registerAjaxErrors(statusCode, errorJson.message)

            if(statusCode !== 409){
                if($('.server-error-message').length === 0){
                    $('[data-type="register-form"').append($('<div>', { class: 'server-error-message'}).text(errorJson.message))
                }
                else{
                    $('.server-error-message').text(errorJson.message)
                }
            }
            
        }
    });
    
}


function attachedActions(){
    $('[data-type="register-form"]').on('submit',function(e){
        e.preventDefault();
        const $this = $(this);
        if(registerValidation($this)){
            registerUser($this);
        }     
    })
}


$(document).ready(()=>{
    attachedActions()
})