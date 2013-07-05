<?php

/* bbs-scene.org api class
 * 
 * this class requires an account at http://bbs-scene.org/users_Registration.php
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * Base Tested with : 
 * PHP v5.3.10
 * Linux Mint 13 (Maya)/(Ubuntu 12.04)
 * 
 * Drupal Version Tested 7.22
 * 
 * use :
 * $bbs = new _BS();
 * $bbs->method()
 * 
 * functions :
 * isDrupal() =     ( returns TRUE if using Drupal version 7.x )
 * 
 * methods :
 * setEmail($e)     ( required )
 * setPassword($p)  ( required )
 * setMaxOL($n)     ( defaults to 20 onelinerz)
 * 
 * OneL()           ( returns stdClass of setMaxOL, defaults to 20 )
 * rOneL()          ( returns stdClass of random oneliner )
 * one()            ( returns stdClass of last posted oneliner )
 * oneLRawJson()    ( returns last setMaxOL in raw jSON, defaults to 20 )
 * oneLRawXML()     ( returns last setMaxOL in raw XML, defaults to 20 )
 * 
 * bbsList()        ( returns stdClass of entire bbslist )
 * rBBSList()       ( returns stdClass of random bbs entry )
 * bbsListRawJson() ( returns entire bbslist in raw jSON )
 * bbsListRawXML()  ( returns entire bbslist in raw XML )
 *
 * Direct questions, bugs or whatever to sk5@bbs.godta.com
 *  
 */
 
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
      return (object) json_decode($this->getData('one', TRUE, $this->maxOL));
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
