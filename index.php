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
        <meta name="description" content="">
        <meta name="viewport" content="width=1920">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/style3.css"/>
        <style>
        </style>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id='wrapper'>
            <!-- <img src="img/screenshot.png" class="screenshot"/> -->
            <div class='items'>
                <h2>Items (upgrades)</h2>
                <ul class='slats'><li><h2>Items</h2></li>
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
                <h2>Trinkets <span>(Top-left)</span></h2>
                <ul class='slats'><li><h2>Trinkets</h2></li>
                <?php echo getsheet('odb'); ?>
                </ul>
            </div>
            <div class='activated'>
                <h2>Activated <span>(press Space)</span></h2>
                <ul class='slats'><li><h2>Activated</h2></li>
                <?php echo getsheet('od6'); ?>
                </ul>
            </div>
            <div class='tarot'>
                <h2>Tarot Cards</h2>
                <ul class='slats'><li><h2>Tarots</h2></li>
                <?php echo getsheet('od7'); ?>
                </ul>
            </div>
        </div><!--#wrapper-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
