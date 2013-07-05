<?php
/*
 * @file templates/onelinerz.tpl.php
 * @var $delta = block id
 * @var $onelinerz = stdClass of onelinerz
 * @var $i = stdClass of header and footer images $i->header, $i->footer
 * 
 */
?>

<div id="bbs_scene_onelinerz">
  <div id="bbs_scene_onelinerz_hdr">
		<img src="<?php print $i->header; ?>" alt="Global Onelinerz Header" />
  </div> <!-- /#bbs_scene_onelinerz_hdr -->
  <?php foreach( $onelinerz as $o ): ?>
  <span class="alias_bracket">(</span>
	<span class="alias"><?php print strtolower($o->alias); ?></span>
	<span class="alias_bracket">)</span>
	<span class="seperator">@</span>
	<span class="oneliner_bbsname"><?php print $o->bbsname; ?></span>
	<span class="oneliner" data-oneliner-id="<?php print $o->id; ?>" data-oneliner-ts="<?php print $o->timestamp; ?>">
    <?php print preg_replace( '/[|][0-9][0-9]/','', $o->oneliner ); ?>
  </span>
	<br />
  <?php endforeach; ?>
  <div id="bbs_scene_onelinerz_ftr">
		<img src="<?php print $i->footer; ?>" alt="Global Onelinerz Footer" />';
	</div> <!-- /#bbs_scene_onelinerz_ftr -->
</div> <!-- /#bbs_scene_onelinerz -->
