$("#goUpload").leanModal();
$("#goShareIdea").leanModal();



$(document).ready( function() {
alert("here1");
     var shareform =  $('.shareidea-upload');

        shareform.fileupload({
            url: shareform.attr('action'),
            type: 'POST',
            datatype: 'xml',
            add: function (event, data) {
alert("hereadd");

       var goUpload = true;
        var uploadFile = data.files[0];
        if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
            alert('Please select an image file');
            goUpload = false;
        }
         if (uploadFile.size > 2000000) { // 2mb
           alert('Please upload a smaller image, max size is 2 MB');
            goUpload = false;
        }

  if (goUpload == true) {
                  $("#btnSubmitForm").prop("disabled",true);
        var reader = new FileReader();
        reader.onload = function(event) {
          $('#imgPreview').attr('src', event.target.result);
        }
        reader.readAsDataURL(data.files[0]);
                 //$('.progress').css('visibility', 'visible');
                // Message on unLoad.
                window.onbeforeunload = function() {
                    return 'Upload Not Complete';
                };

                // Submit
              
            data.submit();
        }
            },
            send: function(e, data) {

                // onSend
            },
            progress: function(e, data){
                // This is what makes everything really cool, thanks to that callback
                // you can now update the progress bar based on the upload progress.
                var percent = Math.round((data.loaded / data.total) * 100);
                $('.bar').css('width', percent + '%');
            },
            fail: function(e, data) {
                // Remove 'unsaved changes' message.
                window.onbeforeunload = null;
            },
            success: function(data) {
                alert("here3");
                // onSuccess
            },
            done: function (event, data) {
                  window.onbeforeunload = null;
                 
                     $('#upload_original_name').val(data.originalFiles[0].name);
   $("#btnSubmitForm").prop("disabled",false);
            
            }

        });




var form =  $('.schedulepost-upload');

        form.fileupload({
            url: form.attr('action'),
            type: 'POST',
            datatype: 'xml',
            add: function (event, data) {

       var goUpload = true;
        var uploadFile = data.files[0];
        if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
            alert('Please select an image file');
            goUpload = false;
        }
         if (uploadFile.size > 2000000) { // 2mb
           alert('Please upload a smaller image, max size is 2 MB');
            goUpload = false;
        }

  if (goUpload == true) {
                  $("#schedulePostButton").prop("disabled",true);
        var reader = new FileReader();
        reader.onload = function(event) {
          $('#schedulePostImg').attr('src', event.target.result);
        }
        reader.readAsDataURL(data.files[0]);
                 //$('.progress').css('visibility', 'visible');
                // Message on unLoad.
                window.onbeforeunload = function() {
                    return 'Upload Not Complete';
                };

                // Submit
              
            data.submit();
        }
            },
            send: function(e, data) {

                // onSend
            },
            progress: function(e, data){
                // This is what makes everything really cool, thanks to that callback
                // you can now update the progress bar based on the upload progress.
                var percent = Math.round((data.loaded / data.total) * 100);
                $('.bar').css('width', percent + '%');
            },
            fail: function(e, data) {
                // Remove 'unsaved changes' message.
                window.onbeforeunload = null;
            },
            success: function(data) {
                // onSuccess
            },
            done: function (event, data) {
                  window.onbeforeunload = null;
                 
                     $('#schedule_post_original_name').val(data.originalFiles[0].name);
   $("#schedulePostButton").prop("disabled",false);
            
            }

        });

        /*
        var form =  $('.direct-upload');

        form.fileupload({
            url: form.attr('action'),
            type: 'POST',
            datatype: 'xml',
            add: function (event, data) {

       var goUpload = true;
        var uploadFile = data.files[0];
        if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
            alert('Please select an image file');
            goUpload = false;
        }
         if (uploadFile.size > 2000000) { // 2mb
           alert('Please upload a smaller image, max size is 2 MB');
            goUpload = false;
        }

  if (goUpload == true) {
                  $("#btnSubmitForm").prop("disabled",true);
        var reader = new FileReader();
        reader.onload = function(event) {
          $('#imgPreview').attr('src', event.target.result);
        }
        reader.readAsDataURL(data.files[0]);
                 //$('.progress').css('visibility', 'visible');
                // Message on unLoad.
                window.onbeforeunload = function() {
                    return 'Upload Not Complete';
                };

                // Submit
              
            data.submit();
        }
            },
            send: function(e, data) {

                // onSend
            },
            progress: function(e, data){
                // This is what makes everything really cool, thanks to that callback
                // you can now update the progress bar based on the upload progress.
                var percent = Math.round((data.loaded / data.total) * 100);
                $('.bar').css('width', percent + '%');
            },
            fail: function(e, data) {
                // Remove 'unsaved changes' message.
                window.onbeforeunload = null;
            },
            success: function(data) {
                // onSuccess
            },
            done: function (event, data) {
                  window.onbeforeunload = null;
                 
                     $('#upload_original_name').val(data.originalFiles[0].name);
   $("#btnSubmitForm").prop("disabled",false);
            
            }

        });
*/
    
});