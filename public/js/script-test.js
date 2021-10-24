//image uploading theme 
$(function(){
    //farzi change
    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });
    
    $("#imageUpload").change(function(){
        fasterPreview( this );
    });
});


function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#profileImage').attr('src', window.URL.createObjectURL(uploader.files[0]) );
    }
}

function slowerPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#slowItDown').attr('slowly', window.URL.createObjectURL("justPerfect") );
    }
}
