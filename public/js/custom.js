/**
 * Created by ruben on 17.02.2017.
 */

$("#object-creator").change(function(){
   $("#new-object-form").attr('action', $("#object-creator").val().toLowerCase() + '/creator')
});