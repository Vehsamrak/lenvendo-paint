var canvas = new fabric.StaticCanvas('painting');

if (imageSchemeData) {
    var imageSchemeData = JSON.parse(imageSchemeData);
    canvas.loadFromJSON(imageSchemeData);
    canvas.renderAll();
}

var $paintingResult = $('#painting-result');
var canvasIsNew = $('#painting').data('is-new');

if (canvasIsNew) {
    canvas = new fabric.Canvas('painting', {isDrawingMode: true});
    canvas.freeDrawingBrush.width = 5;
}

$('#painting-create').click(function () {
    $(this).remove();
    $('#painting-reset').remove();

    var imageScheme = JSON.stringify(canvas);

    $.post('/image/post', {'data': imageScheme}, function (data) {
        data = JSON.parse(data);

        var imageSchemeId = data.id;
        var imageSchemePassword = data.password;

        $('#painting-result .id').html('Id: ' + imageSchemeId);
        $('#painting-result .password').html('Password: ' + imageSchemePassword);
    });
});

$('#painting-unlock').click(function () {

    //TODO: save existing image
    //TODO: imageScheme as canvas data attribute, not twigged var
    //TODO: password md5

    var imageId = $('#painting').data('id');
    var password = $(this).siblings('input').val();

    $.post('/image/check', {'id': imageId, 'password': password}, function (data) {
        data = JSON.parse(data);

        $('.painting-unlock').hide();
        $paintingResult.removeClass('hidden');

        var canvas = new fabric.Canvas('painting', {isDrawingMode: true});
        canvas.freeDrawingBrush.width = 5;

        if (imageSchemeData) {
            canvas.loadFromJSON(imageSchemeData);
            canvas.renderAll();
        }
    }).fail(function () {
        $('.painting-unlock .result').html('Invalid password!');
    });

});
