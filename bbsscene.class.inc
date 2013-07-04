<?php

define('BS_CLASS_VERSION', 0.7);
define('BS_URL',  'bbs-scene.org/api/');

function isDrupal() {

  if( defined('DRUPAL_ROOT') ):
    if( defined('VERSION') && substr(VERSION, 0, -3) == '7'):
      $isDrupal = TRUE;
    endif;
  else:
    $isDrupal = FALSE;
  endif;
  
  return $isDrupal;  
  
}

global $isDrupal = isDrupal();

class _BS {

  public $email;
  public $password;
  public $NL;
  public $maxOL = 20;
  public $json = TRUE;

  public function __construct() {
    
    $this->NL = "\n";
    
  }
  
 /*
  * @param $e (email to login to bbs-scene.org)
  */
  public function setEmail($e) {
    $this->email = $e;
  }
 /*
  * @param $p (password for bbs-scene.org)
  */
  public function setPassword($p) {
    $this->password = $p;
  }
  /*
  * @param $n (set max number of oneliners to return)
  */
  public function setMaxOL($n = 20) {
    $this->maxOL = $n;
  } 
  
  public function jSON($j = TRUE) {
    $this->json = $j;
  }
  
  public function getData($t = 'one', $json = TRUE, $m = 20 ) {
    
    switch($t): 
      case 'one':
        $url = ($json == TRUE ? BS_URL . 'onelinerzjson?limit=' . $m : BS_URL . 'onelinerz?limit=' . $m );
        break;
      case 'bbslist':
        $url = ($json == TRUE ? BS_URL . 'bbslistjson.php' : BS_URL . 'bbslist.php' );
        break;
      case 'rBBSList':
        $url = ($json == TRUE ? BS_URL . 'bbslistjson.php?random' : BS_URL . 'bbslist.php?random' );
        break;
      case 'rOne':
        $url = ($json == TRUE ? BS_URL . 'onelinerzjson?random' : BS_URL . 'onelinerz?random' );
        break;
    endswitch;
    
    if( isDrupal() ):

      $auth = $this->email . ':' . $this->password;
      $request = drupal_http_request( url('http://' . $auth . '@' . $url, 
          Array( 'external' => TRUE, 'absolute' => TRUE )
        ) 
      );     
      
      $data = $request->data;
    
    else:
      $auth = $this->email . ':' . $this->password;
      $c = curl_init($url); // Initialize curl and set curl options
      curl_setopt($c, CURLOPT_USERPWD, "$auth");
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_HEADER, 0);
      $request = curl_exec($c);
      curl_close($c);
      $data = $request;
    endif;
    
    return $data;
  }
  
  public function oneL() { // Return stdClass of $this->maxOL onelinerz (Defaults to 20)
    return json_decode($this->getData('one', TRUE, $this->maxOL));
  }
  
  public function rOneL() { // Return stdClass of random oneliner
    $d = (array) json_decode( $this->getData('rOne', TRUE) );
    return (object) $d[0];
  }
  
  public function one() { // Return stdClass of the last posted oneliner
    $d = (array) json_decode( $this->getData('one', TRUE, 1) );
    return (object) $d[0];
  }
  
  public function oneLRawXML() { // Return $this->maxOL in raw XML
    return $this->getData('one', FALSE, $this->maxOL);
  }
  
  public function oneLRawJson() { // Return $this->maxOL in raw jSON
  
    return $this->getData('one', TRUE, $this->maxOL);
  
  }
  
  public function bbsList() { // Return stdClass of entire bbslist
  
    return (object) json_decode($this->getData('bbslist', TRUE));
  }
  
  public function rBBSList() { // Return stdClass of entire bbslist
    $br = (array) json_decode($this->getData('rBBSList', TRUE));
    $data = $br[0];
    return (object) $data; 
  }
  
  public function bbsListRawXML() { // Return raw XML of bbslist
  
    return $this->getData('bbslist', FALSE);
  
  }
  public function bbsListRawJson() { // Return raw jSON of bbslist
    
    return $this->getData('bbslist', TRUE);
  
  }
 
}

?>
