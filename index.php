<?php
    $files = glob("img/all/*.png");
    $gallery = '';
    foreach ($files as $file) {
        $name = str_replace('_', ' ', basename($file));
        $name = str_replace('.png', '', $name);
        $gallery .= "<li><img src='$file' title='$file'><h3>$name</h3></li>\n";
    }



function getsheetlist($sheet) {
    // get a sheet from the google spreadsheet. return as list items

    // https://gist.github.com/pamelafox/770584
    // http://damolab.blogspot.ca/2011/03/od6-and-finding-other-worksheet-ids.html
    // https://spreadsheets.google.com/feeds/worksheets/0AlMQBNMXy71CdHQ2VDBmbG5yLVhHLUVpdk5yV0hOWWc/private/full   
    // sheets from google spreadsheets and corresponding od number

    // tranlation array: each sheet has a od code - this array just makes it easier to use
    // update it when adding new sheets
    
    $spread = array(
        "items" => "oda",
        "trinkets" => "odb",
        "activated" => "od6",
        "pills" => "od5",
        "tarots" => "od7"
        );


    $key = "0AlMQBNMXy71CdHQ2VDBmbG5yLVhHLUVpdk5yV0hOWWc";
    $url = "http://spreadsheets.google.com/feeds/list/{$key}/{$spread[$sheet]}/public/values?alt=json";
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


      $items .= "<li id='$shortname'><div class='icon'>";

      $pathtoimg = "img/all/{$shortname}.png";
      if (file_exists($pathtoimg)) {
        // list($width, $height) = getimagesize($pathtoimg);
        // $items .= "<img src='{$pathtoimg}' width='{$width}' height='{$height}'>";
        $items .= "<img src='{$pathtoimg}'>";
      }



      $items .= "</div><h3>$item</h3>";

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
        <meta name="description" content="The Binding of Isaac Cheat sheet. Isaac's Cheat sheet lists all items with descriptions laid out to sit behind the game window for easy reference. Download the Mac OS X application for even easier access.">
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


            <div class='main'>

                <div class='content'>

                    <h1>The Binding of <strong>Isaac's Cheatsheet</strong></h1>
                    
                    <div class='instructions'>
                        <h2>instructions:</h2>
                        <ol>
                            <li>Launch The Binding of Isaac.</li>
                            <li>Put the game window over this dotted box. <i>(as high up as it can go)</i></li>
                            <li>Kick Mom's ass!</li>
                        </ol>
                    </div>
                    
                    <section>
                        <h3>What is this? A cheatsheet for ants?</h3>
                        <p>This is a cheatsheet that you keep <strong>behind</strong> your Binding of Isaac game window (set to large) so you can get a quick item reference while playing. <a href="http://imgur.com/FiiocN9">See here.</a> Everything is tiny because it was made for my monitor resolution of 1920x1080 and I wanted everthing to fit on screen at the same time.</P>
                    </section>

                    <section class='app'>
                        <a href="http://www.mediafire.com/?lexqbafe4245qde">
                            <img src='img/osx-icon.png'>
                            <h3>Download<br>the Mac OS X app.</h3>
                        </a>
                        <p>Run it, hide the statusbar (cmd-/) and maximize the screen. This isn't a real program. It's just <a href="http://fluidapp.com/">a minimal browser</a> that displays this webpage without needing to scroll.</p>
                    </section>

                    <section class='contact'>
                        <h3>Me fail English? That's unpossible.</h3>
                        <p>Is something spelled incorrectly? Is an item description wrong? Got a suggestion? <spam style='color: #f00'>Is something <strong>too</strong> red?</spam> <a class="lightbox-31286340382249 btn" style="cursor:pointer;">Contact Us</a> and we'll absolutely not respond to you. Corrections are appreciated and likely implemented though!</p>
                        <!-- <p>We're also on <a href='//bindingofisaac.reddit.com'>r/bindingofisaac</a> all the time so we can ignore you there as well.</p> -->
                    </section>

                    <p>Thank you reddit contributors (and whoever ripped those sprites and put them on mediafire)! Give all your monies to Ed McMillen and Florian Himsl.</p>

                </div><!--.content-->
                <div class='item'>
                <h2>Passive Items</h2>
                <ul class='slats'>
                    <!-- <li><h2>Items</h2></li> -->
                    <?php echo getsheetlist('items'); ?>
                </ul>
                </div>
            </div>


            <div class='trinkets'>
                <h2>Trinkets</h2>
                <ul class='slats'>
                    <?php echo getsheetlist('trinkets'); ?>
                </ul>
            </div>

            <div class='activated'>
                <h2>Activated</h2>
                <ul class='slats'>
                    <?php echo getsheetlist('activated'); ?>
                </ul>
            </div>
            <div class='pills'>
                <h2>Pills</h2>
                <ul class='slats'>
                    <?php echo getsheetlist('pills'); ?>
                </ul>
            </div>
            <div class='tarot'>
                <h2>Tarots</h2>
                <ul class='slats'>
                    <?php echo getsheetlist('tarots'); ?>
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
