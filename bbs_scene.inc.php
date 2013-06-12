<?php
/*********************************************************************
 * functions for retrieving data from http://bbs-scene.org/api_docs/ *
 *********************************************************************/
 
function parseOnelinerz($username, $password, $number, $last = False, $rand = False) // Function to parse and display onelinerz
{
	if($last) {
		$url = "http://bbs-scene.org/api/onelinerz.php?limit=1";
	}
	else if($rand) {
		$url = "http://bbs-scene.org/api/onelinerz?random";
	}
	else {
		$url = "http://bbs-scene.org/api/onelinerz.php?limit=" . $number;
	}
	
	$ch = curl_init($url); // Initialize curl and set curl options

	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$data = curl_exec($ch);
	curl_close($ch);
	
	$xml = new SimpleXmlElement($data, LIBXML_NOCDATA); // Set XML element

    $cnt = count($xml->node);
    if($last) {
		$onelinerz_data = '<div id="bbs_scene_onelinerz_last">';
    }
    else if($rand) {
		$onelinerz_data = '<div id="bbs_scene_onelinerz_random">';
	}
    else {
		$onelinerz_data = '<div id="bbs_scene_onelinerz">';
		$onelinerz_data .= '<div id="bbs_scene_onelinerz_hdr">';
		$onelinerz_data .= '<img src="'.drupal_get_path('module', 'bbs_scene').'/images/onelinerz_hdr_trans.png" alt="Global Onelinerz Header" />';
		$onelinerz_data .= '</div> <!-- /#bbs_scene_onelinerz_hdr -->';
	drupal_add_js('jQuery("#content-header .title").hide("fast")',
    array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
	);
	}
	
	
    for($i=0; $i<$cnt; $i++)
    {
	$oneliner 	= preg_replace('/[|][0-9][0-9]/','',$xml->node[$i]->oneliner);

	$alias 	= $xml->node[$i]->alias;
	$bbs = $xml->node[$i]->bbsname;
	
	$onelinerz_data .= 
		"<span class=\"alias_bracket\">(</span>
		<span class=\"alias\">" . strtolower($alias) . "</span>
		<span class=\"alias_bracket\">)</span>
		<span class=\"seperator\">@</span>
		<span class=\"oneliner_bbsname\">" . $bbs . "</span>
		<span class=\"oneliner\"> " . $oneliner . "</span>
		<br />";
   
    }
    if($last) {
		$onelinerz_data .= "</div> <!-- /#bbs_scene_onelinerz_last -->";
	}
	else if($rand) {
		$onelinerz_data .= '</div> <!-- /#bbs_scene_onelinerz_random -->';
	}
	else {
		$onelinerz_data .= '<div id="bbs_scene_onelinerz_ftr">';
		$onelinerz_data .= '<img src="'.drupal_get_path('module', 'bbs_scene').'/images/onelinerz_ftr_trans.png" alt="Global Onelinerz Footer" />';
		$onelinerz_data .= "</div> <!-- /#bbs_scene_onelinerz_ftr -->";
		$onelinerz_data .= "</div> <!-- /#bbs_scene_onelinerz -->";
		
	}
    return $onelinerz_data;
    
}

function randomPng($username, $password, $pngsize) // Function to display random png's from bbs-scene.org bbs list
{
	
	$pngurl = "http://bbs-scene.org/api/bbslist.php?randomansi";

	$pngch = curl_init($pngurl); // Initialize curl and set curl options

	curl_setopt($pngch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($pngch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($pngch, CURLOPT_HEADER, 0);

	$pngdata = curl_exec($pngch);
	curl_close($pngch);

	$xml = new SimpleXmlElement($pngdata, LIBXML_NOCDATA); // Set XML element

	$name 	 = $xml->node->bbsname;
	$address = $xml->node->address;
	$port    = $xml->node->port;
	$id		 = $xml->node->id;
	$sysop   = $xml->node->sysop;
	
    $random_png = "<span class=\"bbsname\">".$name."</span><br /><a href=\"telnet://". $address . "\"><img border=\"0\" src=\"http://bbs-scene.org/grab.php?png=". $id ."&size=". $pngsize . "\" alt=\"" . $name . "\"/></a>";
    return $random_png;
}

function bbslist($username, $password) // Function to return entire bbslist from bbs-scene.org
{
	
	$bbsurl = "http://bbs-scene.org/api/bbslist.php";
	
	$ch = curl_init($bbsurl); // Initialize curl and set curl options

	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$bbsdata = curl_exec($ch);
	curl_close($ch);

	$xml = new SimpleXmlElement($bbsdata, LIBXML_NOCDATA); // Set XML element
	
	$div = "<div id=\"bbslist\">\n\t";
	$div .= "<table id=\"bbs_entries\" class=\"bbs_entries tablesorter\" cellpadding=\"0\" cellspacing=\"0\">\n\t";
	$div .= "<thead><tr>";
	$div .= "
		<th>name</th>\n
		<th>location</th>\n
		<th>software</th>\n
		<th>nodes</th>\n
	";
	$div .= "</tr></thead><tbody>";
	foreach($xml->node as $x) {
		
		$id		 	= $x->id;
		$name 	 	= $x->bbsname;
		$sysop   	= $x->sysop;
		$software 	= $x->software;
		$address 	= $x->address;
		$port		= $x->port;
		$location 	= $x->location;
		$nodes 		= $x->nodes;
		$notes 		= $x->notes;
		$ansi 		= $x->ansi;
		$ansiraw 	= $x->ansiraw;
		$png 		= $x->png;
		$ts 		= $x->timestamp;

	
		$div .= "<tr class=\"entry\" id=\"bbs_rec_".$id."\">";
		$div .= "<td class=\"name\">" . "<a href=\"telnet://" . $address . "\" title=\"" . $notes . "\">" . $name . "</a>" . "</td>";
		$div .= "<td class=\"location\">" . $location . "</td>";
		$div .= "<td class=\"software\">" . $software . "</td>";
		$div .= "<td class=\"nodes\">" . $nodes . "</td>";
		$div .= "</tr>";
	}
	
	$div .= "</tbody></table> <!-- /.bbs_entry -->";
	$div .= "<div id=\"pager\" class=\"pager\">";
	$div .= "<form>";
	$div .= "<img src=\"/" . drupal_get_path('module', 'bbs_scene') . "/images/arrows/first-32.png\" class=\"first\" />";
	$div .= "<img src=\"/" . drupal_get_path('module', 'bbs_scene') . "/images/arrows/prev-32.png\" class=\"prev\" />";
	$div .= "<input class=\"pagedisplay\" disabled=\"disabled\" />";
	$div .= "<img src=\"/".drupal_get_path('module', 'bbs_scene') . "/images/arrows/next-32.png\" class=\"next\" />";
	$div .= "<img src=\"/".drupal_get_path('module', 'bbs_scene') . "/images/arrows/last-32.png\" class=\"last\" />";
	$div .= "<select class=\"pagesize\">";
	$div .= "<option value=\"5\">5</option>";
	$div .= "<option selected=\"selected\" value=\"10\">10</option>";
	$div .= "<option value=\"15\">15</option>";
	$div .= "<option value=\"25\">25</option>";
	$div .= "<option value=\"". count($xml) ."\">All (".count($xml).")</option>";
	$div .= "</select> <!-- /.pagesize -->";
	$div .= "</form>";
	$div .= "</div> <!-- /#pager .pager -->";
	$div .= "</div> <!-- /#bbslist -->";
	
	return $div;
}
