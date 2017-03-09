$("#object-creator").change(function(){
   $("#new-object-form").attr('action', $("#object-creator").val().toLowerCase() + '/creator')
});

