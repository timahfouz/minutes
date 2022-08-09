$(function (){
    // With Tooltip

    var quill = new Quill('#quill-tooltip', {
        modules: {
            toolbar: '#toolbar-container'
        },
        placeholder: 'Project Details',
        theme: 'snow'
    });

    // Enable all tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Can control programmatically too
    $('.ql-italic').mouseover();
    setTimeout(function() {
        $('.ql-italic').mouseout();
    }, 2500);




});
