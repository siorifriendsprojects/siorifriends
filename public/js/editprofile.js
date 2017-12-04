$('#iconimage').cropper({aspectRatio: 4 / 4 });

$(function()
{
    $('#imgfile').on('change',function()
    {
        var file = this.files[0];
        if(file != null)
        {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() 
            {
                $('.createicon').show();
                $('.cropper').children().remove();
                $('#iconimage').cropper('replace',reader.result);
                $('#trimming').show();
            }
        }
    });

    $('#trimming').on('click',function()
    {
        var data = $('#icon').cropper('getData');
        var image = 
        {
            width: Math.round(data.width),
            height: Math.round(data.height),
            x: Math.round(data.x),
            y: Math.round(data.y),
        };
        var canvas = $('#iconimage').cropper('getCroppedCanvas').toDataURL();
        $('.createicon').hide();
        $('#trimming').hide();
        $('.cropper').append("<input type='image' src='"+canvas+"' name='icon' id='icon'>");
        $('#iconimage').val(canvas);
    });
    
});
