$('#login-btn').click(function(e) {
    var CheckStatus = false;
    $(this).parents('form').find('input').each(function(index, element) {
        if($(this).val() == null || $(this).val() == ''){
            $('.login-tips').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>请输入'+$(this).attr('placeholder')+'</div>').show();
            setTimeout(function(){
                $('.login-tips').html('').hide('fast');
            },3000);
            CheckStatus = false;
            return false;
        }
        CheckStatus = true;
    });
    if(CheckStatus){
        $.post($(this).parents('form').attr('action'),$(this).parents('form').serialize(),function(data){
            if(!data.status){
                $('#getCode').click();
                $('.login-tips').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+data.info+'</div>').show();
                setTimeout(function(){
                    $('.login-tips').html('').hide('fast');
                },3000);
            } else {
                location.href=data.url;
            }
        },'json').error(function(data){
            $('#getCode').click();
            $('.login-tips').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>系统故障，请稍后再试</div>').show();
            setTimeout(function(){
                $('.login-tips').html('').hide('fast');
            },3000);
        });
    }
});
$('#login-btn').parents('form').keyup(function(event){
    if(event.keyCode ==13){
        $('#login-btn').click();
    }
});
