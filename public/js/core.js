function handleText(message,button){


if($('#'+message).val().length > 0){
  
  $('#'+button).prop("disabled",false);
}
else{
    
    $('#'+button).prop("disabled",true);
}

}
/*

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#scheduledPostImg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
*/