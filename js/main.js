// http://papermashup.com/read-url-get-variables-withjavascript/
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
if (getUrlVars()['fluid']=='1') {
    $('body').addClass('fluid');
}

// tweets
// http://jquery.malsup.com/twitter/
$('#tweets').twitterSearch({ 
    term:   'binding of isaac', 
    // no fade 
    animOut: { opacity: 1 }, 
    avatar:  false, 
    anchors: true, 
    bird:    false, 
    // colorExterior: '#ddd', 
    // colorInterior: 'white', 
    pause:   true, 
    time:    false, 
    timeout: 3200,
    applyStyles: false
});

// reddits
// https://gist.github.com/sente/947491
$.getJSON(
"http://www.reddit.com/r/bindingofisaac.json?jsonp=?",
function foo(data)
{
  $.each(
    data.data.children.slice(0, 8),
    function (i, post) {
      var img = ['jpg','png','gif'];
      var item = '<li><p><strong><a href="' + post.data.url + '" target="_blank">' + post.data.title + '</strong></a></p>';
      if (x=$.inArray(post.data.url.split('.').pop(), img)>0) {
        console.log(x + ' : ' + post.data.url);
      }
      item += '<p>(' + post.data.ups + '&uarr; / ' + post.data.downs + '&darr;) <a href="//reddit.com' + post.data.permalink + '" target="_blank">' + post.data.num_comments + ' Comments</a></p></li>';
      $("#social article ul").append(item);
    }
  )
}
)
.success(function() { console.log("second success"); })
.error(function() { console.log("error"); })
.complete(function() { console.log("complete"); });



// check model prefs

if (localStorage.getItem("nonag")=='true') {
    $('#modal').hide();
    $("#nag input").attr('checked', true);
} else {
    $('#modal').show();
    $("#nag input").attr('checked', false);
};

// instructions modal:
// hide the window when close is clicked
$('.close').click(function(e){
    $(this).parent().fadeOut(500);
    e.preventDefault();
});
// show the window when instr is clicked
$('#instr').click(function(e){
    e.preventDefault();
    $('#modal').fadeIn(500);
    return false;
});


// remember to open/close model w/ localstorage
$("#nag input").change(function(){
    if($(this).is(":checked")) {
        console.log('checked!');
        localStorage.setItem("nonag", 'true');
    } else {
        console.log('unchecked!');
        localStorage.setItem("nonag", 'false');
    }
});
// if (Modernizr.localstorage) {
//   console.log('localstorage!');
// }
