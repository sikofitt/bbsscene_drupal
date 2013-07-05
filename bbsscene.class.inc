<?php

define('BS_CLASS_VERSION', 0.7);
define('BS_URL',  'bbs-scene.org/api/');

function isDrupal() { // Check to see if we should use drupal wrapper functions or php functions

  if( defined('DRUPAL_ROOT') ):
    if( defined('VERSION') && substr(VERSION, 0, -3) == '7'):
      return TRUE;
    endif;
  else:
    return FALSE;
  endif;
}

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
  /*
  * @param $j (Return jason or xml default TRUE)
  */
  public function jSON($j = TRUE) {
    $this->json = $j;
  }
  /*
  * @param $t ( which data to return onelinerz, random onliner, bbslist, random bbs entry )
  * @param $json ( return jSON or xml, defaults to jSON )
  * @param $m ( the number of onelinerz to return, defaults to 20 )
  */
  public function getData($t = 'one', $json = TRUE, $m = 20 ) {
    
    switch($t): 
      case 'one':
        $url = ($json == TRUE ? BS_URL . 'onelinerzjson?limit=' . $m : BS_URL . 'onelinerz?limit=' . $m );
        break;
      case 'rOne':
        $url = ($json == TRUE ? BS_URL . 'onelinerzjson?random' : BS_URL . 'onelinerz?random' );
        break;
      case 'bbslist':
        $url = ($json == TRUE ? BS_URL . 'bbslistjson.php' : BS_URL . 'bbslist.php' );
        break;
      case 'rBBSList':
        $url = ($json == TRUE ? BS_URL . 'bbslistjson.php?random' : BS_URL . 'bbslist.php?random' );
        break;
    endswitch;
    
    if( isDrupal() ):

      $auth = $this->email . ':' . $this->password;
      $request = drupal_http_request( url('http://' . $auth . '@' . $url, 
          Array( 'external' => TRUE, 'absolute' => TRUE )
        ) 
      );     
      
      return $request->data;
    
    else:
    
      $auth = $this->email . ':' . $this->password;
      $c = curl_init($url); // Initialize curl and set curl options
      curl_setopt($c, CURLOPT_USERPWD, "$auth");
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_HEADER, 0);
      $request = curl_exec($c);
      curl_close($c);
      
      return $request;
   
    endif;
  }
  
  public function oneL() { // Return stdClass of $this->maxOL onelinerz (Defaults to 20)
    if( isDrupal() ):
      return (object) drupal_jason_decode( $this->getData( 'one', TRUE, $this->maxOL ) );
    else:
      return json_decode($this->getData('one', TRUE, $this->maxOL));
    endif;
  }
  
  public function rOneL() { // Return stdClass of random oneliner
    if( isDrupal() ):
      $data = (array) drupal_json_decode( $this->getData('rOne', TRUE) );
    else:
      $data = (array) json_decode( $this->getData('rOne', TRUE) );
    endif;
    
    return (object) $data[0];
  }
  
  public function one() { // Return stdClass of the last posted oneliner
    if( isDrupal() ):
      $data = (array) drupal_json_decode( $this->getData('one', TRUE, 1) );
    else:
      $data = (array) json_decode( $this->getData('one', TRUE, 1) );
    endif;
    
    return (object) $data[0];
  }
  
  public function oneLRawXML() { // Return $this->maxOL in raw XML
    return $this->getData('one', FALSE, $this->maxOL);
  }
  
  public function oneLRawJson() { // Return $this->maxOL in raw jSON
    return $this->getData('one', TRUE, $this->maxOL);
  }
  
  public function bbsList() { // Return stdClass of entire bbslist
    if( isDrupal() ):
      return (object) drupal_json_decode($this->getData('bbslist', TRUE));
    else:
      return (object) json_decode($this->getData('bbslist', TRUE));
    endif;
  }
  
  public function rBBSList() { // Return stdClass of random bbslist entry
    if( isDrupal() ):
      $data = (array) drupal_json_decode($this->getData('rBBSList', TRUE));
    else:
      $data = (array) json_decode($this->getData('rBBSList', TRUE));
    endif;
    
    return (object) $data[0]; 
  }
  
  public function bbsListRawXML() { // Return raw XML of bbslist
  
    return $this->getData('bbslist', FALSE);
  
  }
  public function bbsListRawJson() { // Return raw jSON of bbslist
    
    return $this->getData('bbslist', TRUE);
  
  }
 
}

?>
