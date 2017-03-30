var canvas = new fabric.StaticCanvas('painting');

if (imageSchemeData) {
    var imageSchemeData = JSON.parse(imageSchemeData);
    canvas.loadFromJSON(imageSchemeData);
    canvas.renderAll();
}

var $paintingResult = $('#painting-result');
var $painting = $('#painting');
var $resultMessage = $('#painting-result .message');
var canvasIsNew = $painting.data('is-new');
var imageId = $painting.data('id');
var savedPassword;
var dynamicCanvas;

if (canvasIsNew) {
    dynamicCanvas = new fabric.Canvas('painting', {isDrawingMode: true});
    dynamicCanvas.freeDrawingBrush.width = 5;
}

$('#painting-create').click(function () {
    $(this).remove();

    var imageScheme = JSON.stringify(dynamicCanvas);

    $.post('/image/post', {'scheme': imageScheme}, function (data) {
        data = JSON.parse(data);

        var imageSchemeId = data.id;
        var imageSchemePassword = data.password;

        $resultMessage.html(
            'Id: ' + imageSchemeId + '<br><strong>Password: ' + imageSchemePassword + '</strong>'
        );
    })
});

$('#painting-save').click(function () {
    var imageScheme = JSON.stringify(dynamicCanvas);
    var $resultMessage = $('#painting-result .message');

    $.post('/image/save', {'scheme': imageScheme, 'id': imageId, 'password': savedPassword}, function () {
        $resultMessage.html('Image was saved!').stop().fadeIn(500).fadeOut(3000);
    });
});

$('#painting-unlock').click(function () {

    //TODO: imageScheme as canvas data attribute, not twigged var

    var password = $(this).siblings('input').val();
    savedPassword = password;

    $.post('/image/check', {'id': imageId, 'password': password}, function () {
        $('.painting-unlock').hide();
        $paintingResult.removeClass('hidden');

        dynamicCanvas = new fabric.Canvas('painting', {isDrawingMode: true});
        dynamicCanvas.freeDrawingBrush.width = 5;

        if (imageSchemeData) {
            dynamicCanvas.loadFromJSON(imageSchemeData);
            dynamicCanvas.renderAll();
        }
    }).fail(function () {
        $('.painting-unlock .result').html('Invalid password!').stop().fadeIn(500).fadeOut(3000);
    });
});
