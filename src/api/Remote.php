<?php
class Remote{

  private $anonymiser = 'http://anonymouse.org/cgi-bin/anon-www.cgi/';	// URL that will be prepended to the generated API URL.
  private $anonimous = false;
  private $params = array(
						'api'		=> 'v1',
						'appid'		=> 'iphone1_1',
						'apiPolicy'	=> 'app1_1',
						'apiKey'	=> '2wex6aeu6a8q9e49k7sfvufd6rhh0n',
						'locale'	=> 'en_US',
						'timestamp'	=> '0',
					  );

  // Build URL based on the given parameters
	function build_url($baseurl){

		// Build the URL and append query if we have one
		$unsignedUrl = $baseurl;

		// Generate a signature and append to unsignedUrl to sign it.
    if ($this->anonimous){
      $sig = hash_hmac('sha1', $unsignedUrl, $this->params['apiKey']);
  		$signedUrl = $unsignedUrl;
  		// Anonymise the request?
  		$signedUrl = $this->anonymiser.$signedUrl;
    }else{
      $signedUrl = $baseurl;
    }


		return $signedUrl;
	}

  function parse_the_result($requestURL){
  		$json = $this->fetchJSON($requestURL);
      echo $json;
  		// We'll usually have several "lists" returned in the JSON. Combine all these into one array.
  		if(empty($json->data->results)){
  			// IMDb doesn't return a proper error response in the event of 0 results being returned
  			// so set our own failure message.
  			$error->message = "No results found.";
  			$matches = $this->errorResponse($error, true);
  		}
  		else{
  			$results = $json->data->results;
  			$matches = array();

  			if($this->summary){
  				//$matches = $this->summarise_titles($results, intval($year));
          echo 'aqui';
  			}
  			else{
  				for($i=0; $i<count($results); $i++){
            echo $i;
  					$matches = array_merge($matches, $results[$i]->list);
  				}
  			}
  		}

  		return $matches;
  	}



  function fetchJSON($apiUrl){
      $url = $this->build_url($apiUrl);
  		$ch = curl_init($url);
  		$headers[] = 'Connection: Keep-Alive';
  		$headers[] = 'Content-type: text/plain;charset=UTF-8';
  		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  		curl_setopt($ch, CURLOPT_HEADER, 0);
  		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
  		curl_setopt($ch, CURLOPT_ENCODING , 'deflate');
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  		curl_setopt($ch, CURLOPT_VERBOSE, 1);
  		$json = curl_exec($ch);
  		$curl_errno = curl_errno($ch);
  		$curl_error = curl_error($ch);
  		curl_close($ch);

  		// Errors?
  		if ($curl_errno > 0){
        echo 'erro: '.$curl_errno;
        //$data->error->message = 'cURL Error '.$curl_errno.': '.$curl_error;
  		}
  		else{
  			// Decode the JSON response
        libxml_use_internal_errors(true);
      }
  		return $json;
  	}

    function element_to_obj($element) {
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj["html"] = $subElement->wholeText;
            }
            else {
                $obj["children"][] = $this->element_to_obj($subElement);
            }
        }
        return $obj;
    }

    function html_to_obj($html, $link) {
        $dom = new DOMDocument();
        $html = mb_convert_encoding($html, 'html-entities', mb_detect_encoding($html));
        $dom->loadHTML($html);

        $tdf = strpos($link, 'torrentdosfilmeshd');
        $ftf = strpos($link, 'filmestorrentfull');
        $cmt = strpos($link, 'comandotorrents');


        if ($tdf > 0){
          $pos = 10;
        }else {
          if ($ftf > 0){
            $pos = 14;
          }else{
            if ($cmt > 0){
              $pos = 4;
            }else{
              $pos = 1;
            }
          }
        }

        $node = $dom->getElementsByTagName('div')->item($pos);

        //$outerHTML = $node->ownerDocument->saveHTML($node);
        return $this->element_to_obj($node);
    }



}
