$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.image-change2').click(function () {
        $('#upload_left_side_image').click();
    });

    $( '#upload_left_side_image' ).change( function ( event ) {
        $('#imageProgress2').css('display','flex');

        var property = document.getElementById('home-form');
        var form_data = new FormData(property);
        form_data.append('action', 'upload_left_side_image');
        $.ajax({
            type : 'POST',
            data : form_data,
            url  : $('#home-form').attr('action'),
            cache: false,
            processData: false,
            contentType: false,
            success : function (response) {
                toastr.success(response.message);
                let reader = new FileReader();
                reader.onload = function () {
                    $("#image-change2").css({
                        "background-image"  : "url(" + reader.result + ")",
                        "background-size"   : "100%",
                    });
                };

                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0])
                img.onload = () => {
                    reader.readAsDataURL( event.target.files[ 0 ] );
                }
            },
            error : function (myErrors) {
                $.each(myErrors.responseJSON.errors, function (key, error) {
                    toastr.error(error);
                });
            }
        });
        $('#imageProgress2').css('display','none');
    } );

});
