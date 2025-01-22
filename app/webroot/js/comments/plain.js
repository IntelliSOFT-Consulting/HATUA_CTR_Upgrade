document.addEventListener("DOMContentLoaded", function () {
    if (typeof CKEDITOR !== 'undefined') {
       
        $('.editor1').each(function () {
            CKEDITOR.replace(this);
        });
    } else {
        console.error('CKEditor library not loaded!');
    }
});