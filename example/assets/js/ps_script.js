// Update progress bar with red color
function pass_strength_fail(pass_type){
    // If it has green color, remove it
    if ($('#'+pass_type).hasClass('pass_strength_green')){
        $('#'+pass_type).removeClass('pass_strength_green');
    }

    // If it has check icon, remove it
    if ($('#'+pass_type+' .pass_strength_icon').hasClass('fa-check')){
        $('#'+pass_type+' .pass_strength_icon').removeClass('fa-check');
    }

    // If it has not red color, put it
    if (!($('#'+pass_type).hasClass('pass_strength_red'))){
        $('#'+pass_type).addClass('pass_strength_red');
    }

    // If it has no close icon, put it
    if (!($('#'+pass_type+' .pass_strength_icon').hasClass('fa-close'))){
        $('#'+pass_type+' .pass_strength_icon').addClass('fa-close');
    }    
}

// Update progress bar with green color
function pass_strength_success(pass_type){
    // If it has red color, remove it
    if ($('#'+pass_type).hasClass('pass_strength_red')){
        $('#'+pass_type).removeClass('pass_strength_red');
    }

    // If it has close icon, remove it
    if ($('#'+pass_type+' .pass_strength_icon').hasClass('fa-close')){
        $('#'+pass_type+' .pass_strength_icon').removeClass('fa-close');
    }

    // If it has not green color, put it
    if (!($('#'+pass_type).hasClass('pass_strength_green'))){
        $('#'+pass_type).addClass('pass_strength_green');
    }

    // If it has not check icon, put it
    if (!($('#'+pass_type+' .pass_strength_icon').hasClass('fa-check'))){
        $('#'+pass_type+' .pass_strength_icon').addClass('fa-check');
    }
}

// Remove any color from progress bar
function pass_strength_resetBar(){
    // If it has red color, remove it
    if($('#pass_strength_box .progress .progress-bar').hasClass('pass_strength_red')){
        $('#pass_strength_box .progress .progress-bar').removeClass('pass_strength_red');
    }

    // If it has yellow color, remove it
    if($('#pass_strength_box .progress .progress-bar').hasClass('pass_strength_yellow')){
        $('#pass_strength_box .progress .progress-bar').removeClass('pass_strength_yellow');
    }

    // If it has green color, remove it
    if($('#pass_strength_box .progress .progress-bar').hasClass('pass_strength_green')){
        $('#pass_strength_box .progress .progress-bar').removeClass('pass_strength_green');
    }
}

// Initialize plugin
function pass_strength_init(){
    $('.pass_strength li').each(function(){
        $(this).addClass('list-group-item');
        $(this).addClass('pass_strength_red');
    });

    $('.pass_strength_icon').each(function(){
       $(this).addClass('fa fa-close'); 
    });

    $('.pass_strength').addClass('list-group');

    $('.pass_strength_bar').addClass('progress-bar progress-bar-striped progress-bar-animated');
    $('.pass_strength_bar').attr({
        'role': 'progressbar',
        'aria-valuenow': '0',
        'aria-valuemin': '0',
        'aria-valuemax': '100'
    });

    $('.pass_strength_header').addClass('text-center');
    $('.submit').attr('disabled', 'disabled');
}

$(function(){
    pass_strength_init();
    
    $('.pass_input').keyup(function(){
        // Inicialization
        var senha = $(this).val();
        var strength = 0;
        var minLen = $('#pass_length').data('length');

        // Pass length
        if(senha.length >= minLen){
            strength += 25;
            pass_strength_success('pass_length');
        } else {
            pass_strength_fail('pass_length');
        }

        // Numbers and Caracters
        var reg = new RegExp(/(([A-Z]+.*[0-9]+)|([0-9]+.*[A-Z]+))+/i);
        if(reg.test(senha)){
            strength += 25;
            pass_strength_success('pass_numCaract');
        } else {
            pass_strength_fail('pass_numCaract');
        }
        
        // Special Caracters
        var reg = new RegExp(/[^A-Z0-9]+/i);
        if(reg.test(senha)){
            strength += 25;
            pass_strength_success('pass_specCaract');
        } else {
            pass_strength_fail('pass_specCaract');
        }

        // Uppercase and lowercase letters
        var reg = new RegExp(/([A-Z]+.*[a-z]+|[a-z]+.*[A-Z]+)+/g);
        if (reg.test(senha)){
            strength += 25;
            pass_strength_success('pass_ulCaract');
        } else {
            pass_strength_fail('pass_ulCaract');
        }

        // Remove any color from progress bar
        pass_strength_resetBar();

        // Update progress bar color
        if(strength <= 25){
            $('#pass_strength_box .progress .progress-bar').addClass('pass_strength_red');
        }
        else if(strength <= 75){
            $('#pass_strength_box .progress .progress-bar').addClass('pass_strength_yellow');
        }
        else if(strength > 75){
            $('#pass_strength_box .progress .progress-bar').addClass('pass_strength_green');
        }

        // Update progress bar percent
        $('#pass_strength_box .progress .progress-bar').css('width',strength+'%');
        $('#pass_strength_box .progress .progress-bar').attr('aria-valuenow', strength);
        $('#pass_strength_box .progress .progress-bar').html(strength);

        // Enable / disable submit button
        if(strength <= 75){
            $('.submit').attr('disabled', 'disabled');
        }
        else {
            $('.submit').removeAttr('disabled');
        }
    });
    
});