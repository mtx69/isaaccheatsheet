<?php
    $files = glob("img/all/*.png");
    $gallery = '';
    foreach ($files as $file) {
        $name = str_replace('_', ' ', basename($file));
        $name = str_replace('.png', '', $name);
        $gallery .= "<li><img src='$file' title='$file'><h3>$name</h3></li>\n";
    }

function getsheet($odnumber) {
    // https://gist.github.com/pamelafox/770584
    // http://damolab.blogspot.ca/2011/03/od6-and-finding-other-worksheet-ids.html    
    // oda - items
    // od6 - activated
    // odb - trinkets
    // od5 - cards
    // od4 - pills

    $key = "0AlMQBNMXy71CdHQ2VDBmbG5yLVhHLUVpdk5yV0hOWWc";
    $url = "http://spreadsheets.google.com/feeds/list/{$key}/{$odnumber}/public/values?alt=json";
    $file = file_get_contents($url);
    $json = json_decode($file);

    $rows = $json->{'feed'}->{'entry'};


    $items = '';
    $count = 0;
    foreach($rows as $row) {
      $count++;
      $item = $row->{'gsx$item'}->{'$t'};
      $dashed = str_replace(' ', '-', $item);   
      $shortname = strtolower(preg_replace("/[^A-Za-z0-9\-]/", '', $dashed));


      $items .= "<li id='$shortname'>";

      $pathtoimg = "img/all/{$shortname}.png";
      if (file_exists($pathtoimg)) {
        $items .= "<div class='icon'><img src='{$pathtoimg}'></div>";
      }



      $items .= "<h3>$item</h3>";

      $items .= "<p>" . ($row->{'gsx$description'}->{'$t'}). "</p></li>\n";
      }
    return $items;
    // $items .= "<h1>$count</h1>";
}








?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Isaac's Cheatsheet</title>
        <meta name="description" content="The Binding of Isaac Cheatsheet">
        <meta name="viewport" content="width=1920">

        <link href="favicon.png" rel="shortcut icon"/>

        <link rel="stylesheet" href="css/normalize.css"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/style3.css"/>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id='wrapper'>
            <!-- <img src="img/screenshot.png" class="screenshot"/> -->
            <div class='items'>
                <div class='content'>

                    <h1><img src="img/isaacs-cheatsheet-logo.png" alt="Isaac's Cheatsheet"></h1>
                    
                    <div class='instructions'>
                    <h4>instructions:</h4>
                    <ol>
                    <li>Launch The Binding of Isaac.</li>
                    <li>Put the game window over this dotted box. <i>(as high up as it can go)</i></li>
                    <li>Kick Mom's ass!</li>
                    </ol>
                    </div>
                    
                    <section>
                        <h5>What is this? A cheatsheet for ants?</h5>
                        <p>This is a cheatsheet that you keep <strong>behind</strong> your Binding of Isaac game window (set to large) so you can get a quick item reference while playing. <a href="http://imgur.com/FiiocN9">See here.</a> Everything is tiny because it was made for my monitor resolution of 1920x1080 and I wanted everthing to fit on screen at the same time.</P>
                    </section>

                    <section class='app'>
                        <a href="http://www.mediafire.com/?3418yrzz71nh6t7">
                            <img src='img/osx-icon.png'>
                            <h5>Download<br>the Mac OS X app.</h5>
                        </a>
                        <p>Run it, hide the statusbar (cmd-/) and maximize the screen. This isn't a real program. It's just <a href="http://fluidapp.com/">a minimal browser</a> that displays this webpage without needing to scroll.</p>
                    </section>

                    <section class='contact'>
                        <h5>Me fail English? That's unpossible.</h5>
                        <p>Is an item description wrong? Got a suggestion? <spam style='color: #f00'>Is something <strong>too</strong> red?</spam> <a class="lightbox-31286340382249" style="cursor:pointer;text-decoration:underline;">Click here</a> and we'll absolutely not respond to you. Your correction may end up on the site anyways though. Citations would be nice. Did you realize I'm only writing this text to make these three boxes the same size?</p>
                        <!-- <p>We're also on <a href='//bindingofisaac.reddit.com'>r/bindingofisaac</a> all the time so we can ignore you there as well.</p> -->
                    </section>

                    <p>Thank you reddit contributors (and whoever ripped those sprites and put them on mediafire)! Give all your monies to Ed McMillen and Florian Himsl.</p>

                </div>
                <ul class='slats'>
                    <li><h2>Items</h2></li>
                    <?php echo getsheet('oda'); ?>
                </ul>
            </div>

            <div class="gallery">
                <ul class='slats'>
                    <?php 
                    // echo $gallery; 
                    ?>
                </ul>
            </div>

            <div class='trinkets'>
                <ul class='slats'>
                    <li><h2>Trinkets</h2></li>
                    <?php echo getsheet('odb'); ?>
                </ul>
            </div>
            <div class='activated'>
                <ul class='slats'>
                    <li><h2>Activated</h2></li>
                    <?php echo getsheet('od6'); ?>
                </ul>
            </div>
            <div class='tarot'>
                <ul class='slats'>
                    <li><h2>Tarots</h2></li>
                    <?php echo getsheet('od7'); ?>
                </ul>
            </div>
        </div><!--#wrapper-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            var _gaq=[['_setAccount','UA-19653275-5'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
<script src="https://static-interlogyllc.netdna-ssl.com/static/feedback2.js?3.1.373" type="text/javascript">
new JotformFeedback({
formId:'31286340382249',
base:'https://secure.jotform.ca/',
windowTitle:'Contact',
background:'#FFA500',
fontColor:'#FFFFFF',
type:false,
height:380,
width:350
});
</script>

    </body>
</html>
