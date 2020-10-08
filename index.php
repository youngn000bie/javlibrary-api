<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if (isset($_GET['url']) && $_GET['url'] != '') {

  $html = file_get_contents($_GET['url']);
  // Get Info 
	preg_match("/rel='bookmark' >(.*?)<\/a>/si", $html, $title);
	preg_match("/<td class=\"header\">ID:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $id);
	preg_match("/<td class=\"header\">Release Date:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $date);
    preg_match("/<td class=\"header\">Length:<\/td>
	<td><span class=\"text\">(.*?)<\/span> min\(s\)<\/td>/si", $html, $duration);
    preg_match("/<td class=\"header\">Director:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $directorAll);
	preg_match_all("/tag\">(.*?)<\/a/si", $directorAll[1], $director);
	preg_match("/<td class=\"header\">Maker:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $makerAll);
	preg_match_all("/tag\">(.*?)<\/a/si", $makerAll[1], $maker);
	preg_match("/<td class=\"header\">Label:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $labelAll);
	preg_match_all("/tag\">(.*?)<\/a/si", $labelAll[1], $label);
	preg_match("/<span class=\"score\">\((.*?)\)<\/span>/si", $html, $score);
	preg_match("/<td class=\"header\">Genre\(s\):<\/td>(.*?)<\/td/si", $html, $genreContainer);
	preg_match_all("/tag\">(.*?)<\/a/si", $genreContainer[1], $genres);
	preg_match("/<td class=\"header\">Cast:<\/td>
	<td class=\"text\">(.*?)<\/td>/si", $html, $castAll);
	preg_match_all("/rel=\"tag\">(.*?)<\/a>/si", $castAll[1], $cast);
	preg_match("/<img id=\"video_jacket_img\" src=\"(.*?)\"/si", $html, $cover);
  
// print_r($x);
  
  // Send Response JSON
  header('Content-Type: application/json');

  echo json_encode([
  	'title'	=> $title[1],
    'id'  => $id[1],
    'release' => $date[1],
    'duration' => $duration[1],
    'director' => $director[1],
    'maker'		=> $maker[1],
    'label'		=> $label[1],
    'score'		=> $score[1],
    'genres'	=> $genres[1],
    'cast'		=> $cast[1],
    'cover'		=> $cover[1],
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