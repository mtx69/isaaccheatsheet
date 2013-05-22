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

// reddits
// https://gist.github.com/sente/947491
var rddt = 0;
var tbns = 0;
$.getJSON(
"http://www.reddit.com/r/bindingofisaac.json?sort=top&t=week&limit=14&jsonp=?",
function foo(data)
{
  $.each(
    data.data.children,
    function (i, post) {
      var img = ['jpg','png','gif'];
      var item = '';
      var tbn = '';
      if (post.data.thumbnail && post.data.thumbnail != 'self' && tbns < 9) {
        tbns++;
        tbn += '<a href="' + post.data.url + '" title="' + post.data.title + '" target="_blank"><img src="' + post.data.thumbnail + '"></a>';
      } else if (rddt<=4) {
          rddt++;
          item = '<li><p><strong><a href="' + post.data.url + '" target="_blank">' + post.data.title + '</strong></a></p>';
          item += '<p>' + post.data.ups + '&uarr; ' + post.data.downs + '&darr; | <a href="//reddit.com' + post.data.permalink + '" target="_blank">' + post.data.num_comments + ' Comments</a></p></li>';
      }
      // if (x=$.inArray(post.data.url.split('.').pop(), img)>0) {
      //   console.log(x + ' : ' + post.data.url);
      //   console.log('tbn: '+post.data.thumbnail);
      //   tbn += '<a href="' + post.data.url + '" target="_blank"><img src="' + post.data.thumbnail + '"></a>';
      // }
      $("#social #rddtposts").append(item);
      $("#social #rddtpics").append(tbn);
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
