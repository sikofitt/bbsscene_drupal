bbs-scene.org api class

this class requires an account at http://bbs-scene.org/users_Registration.php

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA 02110-1301, USA.

Base Tested with : 
PHP v5.3.10
Linux Mint 13 (Maya)/(Ubuntu 12.04)

Drupal Version Tested 7.22

use :
$bbs = new _BS();
$bbs->method()

functions :
isDrupal() =     ( returns TRUE if using Drupal version 7.x )

methods :
setEmail($e)     ( required )
setPassword($p)  ( required )
setMaxOL($n)     ( defaults to 20 onelinerz)

OneL()           ( returns stdClass of setMaxOL, defaults to 20 )
rOneL()          ( returns stdClass of random oneliner )
one()            ( returns stdClass of last posted oneliner )
oneLRawJson()    ( returns last setMaxOL in raw jSON, defaults to 20 )
oneLRawXML()     ( returns last setMaxOL in raw XML, defaults to 20 )

bbsList()        ( returns stdClass of entire bbslist )
rBBSList()       ( returns stdClass of random bbs entry )
bbsListRawJson() ( returns entire bbslist in raw jSON )
bbsListRawXML()  ( returns entire bbslist in raw XML )
 *
Direct questions, bugs or whatever to sk5@bbs.godta.com
