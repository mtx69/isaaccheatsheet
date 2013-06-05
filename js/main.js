// add regex to jquery selector
// http://james.padolsey.com/javascript/regex-selector-for-jquery/
jQuery.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ? 
                        matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels,'')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
}


// search items, hide mismatches
$("#filter").keyup(function() {
  var filter = $(this).val();
  $(".slats li").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).css({'display' : 'none'});
    } else {
      $(this).css({'display' : 'inline-block'});
    }
  });
});


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
    // select all links that don't start with http or // and add fluid=1
    $("a:not(:regex(href,^//|http://))").attr('href', function(i, h) {
    // $("a:regex(href,^/[a-z])").attr('href', function(i, h) {
    // $("a:not([href^='http://'])").attr('href', function(i, h) {
      if (h) { // make sure href exists (jotform links dont have href)
        return h + "?fluid=1";
      } else {
        return;
      }
    });
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



// check modal prefs

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
