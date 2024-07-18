function loginValidation($this){
    const email = $this.find('input[type="email"]');
    const password = $this.find('input#password');
    
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(emailRegex.test(email.val())){
        email.parent().removeClass('error');
    }
    else{
        email.parent().addClass('error');
        email.siblings('.error').text('Email musi być w formacie email')
    }
    
    if(password.val().length >= 8){
        password.parent().removeClass('error');
        password.siblings('.error').text('Hasło musi mieć minimum 8 znaków')
    }
    else{
        password.parent().addClass('error');
    }

    if(emailRegex.test(email.val()) && password.val().length >= 8 ){
        return true;

    }
    else{
        return false;
    }
}


function handleAjaxErrors(statusCode, message){
    if(statusCode === 401){
        $('[data-type="login-form"] input[type="password"]').parent().addClass('error')
        $('[data-type="login-form"] input[type="password"]').siblings('.error').text(message)
    }
    else{
        $('[data-type="login-form"] input[type="password"]').parent().removeClass('error')
        $('[data-type="login-form"] input[type="password"]').siblings('.error').text('Hasło musi mieć minimum 8 znaków')
    }

    if(statusCode === 404){
        $('[data-type="login-form"] input[type="email"]').parent().addClass('error')
        $('[data-type="login-form"] input[type="email"]').siblings('.error').text(message)
    }
    else{
        $('[data-type="login-form"] input[type="email"]').parent().removeClass('error')
        $('[data-type="login-form"] input[type="email"]').siblings('.error').text('Email musi być w formacie email')
    }
}

function loginUser($this){
    const email = $this.find('input[type="email"]').val();
    const password = $this.find('input#password').val();
    const dataToSend = { email, password }
    $.ajax({
        type: 'POST',
        url: '/php/login.php',
        data: dataToSend,
        dataType: 'json',
        success: function(response) {
            window.location = '/';
        },
        error: function(xhr, status, error) {
            const errorJson = xhr.responseJSON;
            const statusCode = xhr.status;
            handleAjaxErrors(statusCode, errorJson.message)

            if(statusCode !== 401 && statusCode !== 404){
                if($('.server-error-message').length === 0){
                    $('[data-type="login-form"').append($('<div>', { class: 'server-error-message'}).text(errorJson.message))
                }
                else{
                    $('.server-error-message').text(errorJson.message)
                }
            }
            else{
                $('.server-error-message')?.remove();
            }
            
        }
    });
}



function attachedActions(){
    $('[data-type="login-form"]').on('submit',function(e){
        e.preventDefault();
        const $this = $(this);
        if(loginValidation($this)){
            loginUser($this);
        }     
    })
}

$(document).ready(()=>{
    attachedActions()
})