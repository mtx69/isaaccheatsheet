
// http://stackoverflow.com/questions/9544977/using-jquery-on-for-drop-events-when-uploading-files-from-the-desktop
// http://stackoverflow.com/questions/8189918/javascript-to-drag-and-drop-in-html5
$('.gallery img').on(
    'dragstart',
    function(e) {
        // console.log(e.target);
        e.originalEvent.dataTransfer.setData('text/plain', e.target.src);
     }
)
$('.gallery img').on(
    'dragend',
    function(e) {
        $(this).remove();
     }
)
$('.slats li').on(
    'dragover',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
    }
)
$('.slats li').on(
    'dragenter',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
    }
)
$('.slats li').on(
    'drop',
    function(e){
        // console.log(e.target + ":" + '');
        var x = e.originalEvent.dataTransfer.getData('text/plain');
        imgsrc = new String(x).substring(x.lastIndexOf('/') + 1);
        $theitem = $('#' + this.id);
        propername = this.id + '.png';
        console.log('rename ' + imgsrc + ' to ' + propername);

        var request = $.ajax({    
            url: 'ajax-rename.php?from=' + imgsrc + '&to=' + propername,
            success: function(ajaxRequest) {
                // console.log('success: ' + ajaxRequest.responseText);
                // $theitem.prepend("<img src='" + propername "'>");
           },
            fail: function(ajaxRequest) {
                console.log('ajax failed: ' + ajaxRequest.responseText);
            },
            complete: function(ajaxRequest) {
                console.log('ajax complete');
            },
        });


    }
);

