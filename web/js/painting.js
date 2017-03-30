var canvas = new fabric.StaticCanvas('painting');

if (imageSchemeData) {
    var imageSchemeData = JSON.parse(imageSchemeData);
    canvas.loadFromJSON(imageSchemeData);
    canvas.renderAll();
}

var $paintingResult = $('#painting-result');

$('#painting-reset').click(function () {
    canvas.clear();
});

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

$('.painting-unlock span').click(function () {
    $('.painting-unlock').hide();
    $paintingResult.removeClass('hidden');

    var canvas = new fabric.Canvas('painting', {
        isDrawingMode: true
    });

    canvas.freeDrawingBrush.width = 5;

    if (imageSchemeData) {
        canvas.loadFromJSON(imageSchemeData);
        canvas.renderAll();
    }
});
