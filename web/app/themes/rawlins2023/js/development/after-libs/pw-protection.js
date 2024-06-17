$(function(){
    $('.pw-protection__row .c-button').on('click', function(e){
        e.preventDefault();
        $('.pw-protection__row form').submit();
    })
})