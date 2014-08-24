//funcion jquery para validar formulario
(function($){
  $.fn.validate = function(opts){
    var integer = '[1-9]{1,}';
    var integer = new RegExp(integer);
    var doble = '[0-9]{1,}.[0-9]{1,}';
    var response =  false;
    return $(this).on('submit',function(evt){
      $(this).find('input.required:text').each(function(){
        if( $(this).prop('value') == ''){
          $(this).parents('div').first().addClass('has-error');
         
          $(this).on('keyup',function() {
            if($(this).prop('value').length > 4)
              $(this).parents('div').first().removeClass('has-error').addClass('has-success');
          });
        }
        evt.preventDefault();
      })

      $(this).find('input:radio').each(function(){
        if(!$(this).is(':checked')){
          $(this).parent('label').css('color', 'crimson');

          $(this).on('click',function(){
            if($(this).is(':checked')){
             $(this).parent().css('color', '#468847');
            }
          })
        }
        evt.preventDefault();
      });

      $(this).find('textarea.required').each(function(){

          if($(this).prop('value') == ''){
            $(this).parents('div').first().addClass('has-error');

            $(this).on('keyup',function() {
              if($(this).prop('value').length > 4)
                $(this).parents('div').first().removeClass('has-error').addClass('has-success');
            });
          }
        evt.preventDefault()

      })

      if($('.has-error').length == 0){
        opts.ajax(this);
      }else{
        return false
      }

    });
  };
})(jQuery);
