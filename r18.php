<?php
// header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");

if (isset($_GET['url']) && $_GET['url'] != '') {

  $html = file_get_contents($_GET['url']);

// Get Info 
preg_match("/<cite itemprop=\"name\">(.*?)<\/cite>/si", $html, $title);
preg_match("/<dt>DVD ID:<\/dt>\n\t\t\t\t\t<dd>\n\t\t\t\t\t\t(.*?)\t\t\t\t\t\t<br>/si", $html, $id);
preg_match("/<img itemprop=\"image\" src=\"(.*?)\"/si", $html, $poster);
preg_match("/itemprop=\"duration\">\n\t\t\t\t\t\t(.*?)\./si", $html, $runtime);
preg_match("/itemprop=\"dateCreated\">\n\t\t\t\t\t\t(.*?)<br>/si", $html, $release_date);
preg_match("/itemprop=\"productionCompany\" itemscope itemtype=\"http:\/\/schema.org\/Organization\">(.*?)<br>/si", $html, $studioAll);
preg_match_all("/itemprop=\"name\">\t\t\t\t\t\t(.*?)<\/a>/si", $studioAll[1], $studio);
preg_match("/<dt>Label:<\/dt>\n\t\t\t\t\t<dd>\n\t\t\t\t\t\t\t\t\t\t\t\t(.*?)<br>/si", $html, $label);
preg_match("/<div itemprop=\"actors\" data-type=\"actress-list\" class=\"pop-list\">(.*?)<\/div>/si", $html, $castAll);
preg_match_all("/temprop=\"name\">(.*?)<\/span>/", $castAll[1], $cast);
preg_match("/<label>Categories:<\/label>(.*?)<\/div>/si", $html, $genresAll);
preg_match_all("/itemprop=\"genre\">\t\t\t\t\t\t\t(.*?)<\/a>/si", $genresAll[1], $genres);
preg_match("/<ul class=\"js-owl-carousel clearfix\">(.*?)<\/ul>/si", $html, $screenshotsAll);
preg_match_all("/data-src=\"(.*?)\"/si", $screenshotsAll[1], $screenshots);
  
// print_r($x);
  
  // Send Response JSON
  header('Content-Type: application/json');

  echo json_encode([
  	'title'		=> $title[1],
  	'id'		=> $id[1],
  	'poster'	=> $poster[1],
  	'runtime'	=> $runtime[1],
  	'release'	=> $release_date[1],
  	'studio'	=> $studio[1],
  	'label'		=> $label[1],
  	'cast'		=> $cast[1],
  	'genres'	=> $genres[1],
  	'ss'		=> $screenshots[1],
  ]);

  exit();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MDL Info</title>
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
</head>

<body>
  <div class="my-4">
    <div class="container">
      <div class="card">
      <div class="card-body">
        <form method="GET" action="">
          <div class="form-group">
            <label for="url">Input MDL URL</label>
            <input type="text" id="url" name="url" class="form-control" placeholder="https://mydramalist.com/49865-psycho-but-it-s-okay">
          </div>
          <button type="submit" class="btn btn-pr imary btn-block">Get Info</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</body>

</html>