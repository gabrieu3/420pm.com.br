<?php

require('../api/Remote.php');
require('../controller/MovieController.php');

$pages = (int) (isset($_GET['pages']) ? $_GET['pages'] : '1');

$c = new MovieController();

$movieObj = new MovieDto();



for ($x = $pages; $x >= 1; $x--) {

if ($x >=2){
  $apiUrl = "http://www.comandotorrents.com/page/".$x."/";
}else {
  $apiUrl = "http://www.comandotorrents.com/";
}


$remote = new Remote();
$html = $remote->fetchJSON($apiUrl);

$obj = $remote->html_to_obj($html, $apiUrl);

$json_text = json_encode($obj, JSON_PRETTY_PRINT);
$json      = json_decode($json_text);

//echo $json_text;
//LOOP de POSTS
foreach($json->children as $movie) { //foreach element in $arr
  if (property_exists($movie, "children")) {

    // LOOP DE POST
    foreach($movie->children as $movie2) { //foreach element in $arr

      //ELEMENTO
      if (property_exists($movie2, "children")) {
        foreach($movie2->children as $movie3) { //foreach element in $arr

          //PARTE 2
          if (property_exists($movie3, "children")) {
            if (property_exists($movie3, "class")){
              if ($movie3->class == 'entry-title'){
                foreach($movie3->children as $movie4) { //foreach element in $arr

                      if (property_exists($movie4, "href")){
                        $movieObj->setLink($movie4->href);
                        echo $movie4->href.'</br>';
                      }
                      if (property_exists($movie4, "html")){
                        $movieObj->setTitle($movie4->html);
                        echo $movie4->html.'</br>';
                      }
                }
              }
            }

            foreach($movie3->children as $movie4) {
              if (property_exists($movie4, "children")) {
                foreach($movie4->children as $movie5) {
                  if (property_exists($movie5, "children")) {
                    foreach($movie5->children as $movie6) {

                      if (property_exists($movie6, "children")) {
                        foreach($movie6->children as $movie7) {
                          if (property_exists($movie7, "src")) {
                            $movieObj->setType('Comandotorrents.com');
                            $movieObj->setSrc($movie7->src);
                            echo $movie7->src.'</br>';
                            $c->insertMovie($movieObj);
                          }}}}}}}}

          }

          //FIM PARTE 2
        }
      }

    }
    echo '</br>';
  }
}



}

?>
