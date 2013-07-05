<?php
/*
 * @file templates/bbslistr.tpl.php
 * @var $entry = stdClass of bbs
 */
?>

<div id="random_bbs" data-bbslist-id="<?php print $entry->id; ?>" data-bbslist-ts="<?php print $entry->timestamp; ?>">
  <span class="bbsname"><?php print $entry->bbsname . ' (' . $entry->location . ')'; ?></span><br />
  <a class="bbs" href="telnet://<?php print $entry->address; ?><?php print ($entry->port == '23' ? '' : ':' . $entry->port ); ?>" title="<?php print $entry->notes; ?>">
    <img border="0" src="<?php print $entry->png; ?>" <?php print ($entry->hasImg ? '' : ' style="width:35%;" ' ); ?> alt="<?php print $entry->bbsname; ?>" />
  </a><!-- /.bbs -->
</div><!-- /#random_bbs -->
