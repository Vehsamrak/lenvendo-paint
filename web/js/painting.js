var canvas = new fabric.Canvas('painting', {
    isDrawingMode: true
});

canvas.freeDrawingBrush.width = 5;

$('#painting-reset').click(function () {
    canvas.clear();
});

$('#painting-save').click(function () {
    var imageSchema = JSON.stringify(canvas);

    $.post('/image/post', imageSchema, function (data) {
        $('#painting-result').html(data);
    });
});
