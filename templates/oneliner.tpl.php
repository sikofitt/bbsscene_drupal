<?php
/*
 * @file templates/oneliner.tpl.php
 * @var $delta = block id
 * @var $oid = oneliner id
 * @var $oneliner = the oneliner
 * @var $bbsname = the bbsname the oneliner is from
 * @var $alias = alias of the person who posted the oneliner
 * @var $ts = timestamp of oneliner
 * 
 */
?>

<div id="<?php print $delta; ?>" data-oneliner-id="<?php print $oid; ?>" data-oneliner-ts="<?php print $ts; ?>">
	<span class="alias_bracket">(</span>
	<span class="alias"><?php print strtolower($alias) ?></span>
	<span class="alias_bracket">)</span>
	<span class="seperator">@</span>
	<span class="oneliner_bbsname"><?php print $bbsname; ?></span>
	<span class="oneliner"><?php print preg_replace('/[|][0-9][0-9]/','', $oneliner); ?></span>
</div> <!-- /#<?php print $delta; ?> -->
