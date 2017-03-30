var canvas = new fabric.Canvas('painting', {
    isDrawingMode: true
});

canvas.freeDrawingBrush.width = 5;


if (imageSchemeData) {
    var imageSchemeData = JSON.parse(imageSchemeData);
    canvas.loadFromJSON(imageSchemeData);
    canvas.renderAll();
}

$('#painting-reset').click(function () {
    canvas.clear();
});

$('#painting-save').click(function () {
    var imageScheme = JSON.stringify(canvas);

    $.post('/image/post', {'data': imageScheme}, function (data) {
        data = JSON.parse(data);

        var imageSchemeId = data.id;
        var imageSchemePassword = data.password;

        $('#painting-result .id').html('Id: ' + imageSchemeId);
        $('#painting-result .password').html('Password: ' + imageSchemePassword);
    });
});
