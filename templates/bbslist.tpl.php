<?php

/*
 * @file templates/bbslist.tpl.php
 * template file to display bbs-scene.org bbslist
 *
 * @var $entries
 * stdClass of bbs entries
 * @var $arrow
 * stdClass of page arrows (next, prev, first, last)
 */

?>

<div id="bbslist">
	<table id="bbs_entries" class="bbs_entries tablesorter" cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th>name</th>
        <th>sysop</th>
        <th>location</th>
        <th>software</th>
        <th>nodes</th>
      </tr>
    </thead>
    <tbody>
    

	<?php 
	/*	
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
  */
	?>
		<?php foreach( $entries as $entry ): ?>
    
      <tr class="entry" id="bbs_rec_<?php print $entry->id ?>">
        <td class="name">
          <a href="telnet://<?php print $entry->address . ( $entry->port == '23' ? '' : ':' . $entry->port ); ?>" title="<?php print $entry->notes; ?>"><?php print $entry->bbsname ?></a>
        </td>
        <td class="sysop"><?php print $entry->sysop; ?></td>
        <td class="location"><?php print $entry->location; ?></td>
        <td class="software"><?php print $entry->software; ?></td>
        <td class="nodes"><?php print $entry->nodes ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table> <!-- /.bbs_entry -->
  <div id="pager" class="pager">
    <form>
      <img src="/<?php print $arrow->first; ?>" class="first" />
      <img src="/<?php print $arrow->prev; ?>" class="prev" />
      <input class="pagedisplay" disabled="disabled" />
      <img src="/<?php print $arrow->next; ?>" class="next" />
      <img src="/<?php print $arrow->last; ?>" class="last" />
      <select class="pagesize">
        <option value="5">5</option>
        <option selected="selected" value="10">10</option>
        <option value="15">15</option>
        <option value="25">25</option>
        <option value="<?php print count((array) $entries); ?>">All (<?php print count( (array) $entries); ?>)</option>
      </select> <!-- /.pagesize -->
    </form>
  </div> <!-- /#pager .pager -->
</div> <!-- /#bbslist --> 
