var canvas = new fabric.StaticCanvas('painting');
var $painting = $('#painting');
var $paintingResult = $('#painting-result');
var $resultMessage = $paintingResult.find('.message');
var imageSchemeData = $painting.data('scheme');
var canvasIsNew = $painting.data('is-new');
var imageId = $painting.data('id');
var savedPassword;
var dynamicCanvas;

if (imageSchemeData) {
    canvas.loadFromJSON(imageSchemeData);
    canvas.renderAll();
}

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

    $.post('/image/save', {'scheme': imageScheme, 'id': imageId, 'password': savedPassword}, function () {
        $resultMessage.html('Image was saved!').stop().fadeIn(500).fadeOut(3000);
    });
});

$('#painting-unlock').click(function () {
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
