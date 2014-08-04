CKEDITOR.on("instanceReady", function () {
    var button = document.getElementById('ajaxButton');
    button.addEventListener("click", function () {
        CKEDITOR.instances.TutorialForm_content.updateElement();
    })
});