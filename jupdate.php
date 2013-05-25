<?php

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
        $items .= "<img src='/{$pathtoimg}'>";
      }



      $items .= "</div><h3>$item</h3>";

      $items .= "<p>" . ($row->{'gsx$description'}->{'$t'}). "</p></li>\n";
      }
    return $items;
}








?>
                <div class='item'>
                    <h2>Passive Items</h2>
                    <ul class='slats'>
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
