$(function(){
    
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

