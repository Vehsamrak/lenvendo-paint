$('canvas.list-painting').each(function () {
    var $imageScheme = $(this);
    var canvasId = $imageScheme.attr('id');
    var imageScheme = $imageScheme.data('image');

    var canvas = new fabric.StaticCanvas(canvasId);
    canvas.loadFromJSON(imageScheme);
    canvas.renderAll();
});
