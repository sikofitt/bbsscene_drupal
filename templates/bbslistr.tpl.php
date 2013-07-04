
<div id="random_bbs" data-bbslist-id="<?php print $entry->id; ?>" data-bbslist-ts="<?php print $entry->timestamp; ?>">
  <span class="bbsname"><?php print $entry->bbsname; ?></span><br />
  <a class="bbs" href="telnet://<?php print $entry->address; ?><?php print ($entry->port == '23' ? '' : ':' . $entry->port ); ?>" title="<?php print $entry->notes; ?>">
    <img border="0" src="<?php print $entry->png; ?>" <?php print ($entry->hasImg ? '' : ' style="width:35%;" ' ); ?> alt="<?php print $entry->bbsname; ?>" />
  </a><!-- /.bbs -->
</div><!-- /#random_bbs -->

<?php 
/* 
stdClass Object
(
    [id] => 210
    [bbsname] => Blood Island
    [sysop] => jojo, xzip
    [software] => The Progressive
    [address] => bloodisland.ph4.se
    [port] => 23
    [location] => Sweden
    [nodes] => 32
    [notes] => This is a place of nostalgia that might one day see the light again! This BBS runs on the beta version of The Progressive BBS software built in Python (obsolete). Check out x/84 for a continuation of that code base.
    [ansi] => http://bbs-scene.org/api/grab.php?ansi=210
    [ansiraw] => G1swbS0vLSBZb3UgaGF2ZSBjb25uZWN0ZWQgdG8gQmxvb2QgSXNsYW5kLCAbWzFtZWxpdGUbWzBtIHBpcmF0ZSBzeXN0ZW0gLS8tICAgICAgICAgICAgICAgDQogICAgICAgICAgICAgICAgIC4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICANCiAgICAgIC9cX19fX19fX18vfCAgICAgIF9fX18vXF8gIF9fX18vXF9fX19fX18vXCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICANCiAgICBfL19fX18gICBcXyAgfCAgICAgLyAgXyAgXC8gLyAgXyAgIFxfX19fXyAgXFxfICAgICAgICAgICAgICAgICAgICAgICAgICAgICANCi4tLS1cLyAgIC4gICBfLyAgfC0tLS0vICAgfCAgIFwvICAgfCAgIFwvICAgfCAgIFwvLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLiAgICANCnwgIF8vICAgIHwgICAgXCAgfF9fXy9fICAgfCAgICBcICAgfCAgICBcICAgfCAgICBcICAgICAgICAgICAgICAgICAgICAgICAgfCAgICANCnwgIFwgICAgIHwgICAgIFwgfCAgICAgXCAgfCAgICAgXCAgfCAgICAgXCAgfCAgICAgXCAgICAgICAgICAgICAgICAgICAgICAgfCAgICANCnwgICBcX18gICAgICAgXy9fICAgICBfLyAgICAgICBfLyAgICAgICBfLyAgICAgICBfLyAgICAgICAgICAgICAgICAgICAgICAgfCAgICANCnwgICAgICBcX19fX19fKCAgXF9fX18oIFxfX19fX18oIFxfX19fX18oIFxfX19fX18oICAgICAgICAgICAgICAgICAgICAgICAgfCAgICANCnwgICAgICAgICAgICAgICAgICAgICAgICAgIC4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfCAgICANCnwgICAgICBfX18vXCBfL1xfX19fX19fX19fL3wgICAgICBfX19fXy9cIF9fX19fX18vXF9fX19fX18vXCAgICAgICAgICAgICAgfCAgICANCnwgICAgIChfX19fXylcLyAgXyAgICBcX18gIHwgICAgIC8gIF8gICAgXF9fX19fICAgIFxfX19fXyAgXFxfICAgICAgICAgICAgfCAgICANCnwgICAgIC8gICAgIFwvICAgfF9fX19fLyAgIHwgICAgLyAgIHwgICAgXC8gICB8ICAgIFwvICAgfCAgIFwvICAgICAgICAgICAgfCAgICANCnwgICBfLyAgICAgICBcX19fXyAgICAgXCAgIHxfX18vXyAgIF8gICAgIFwgICB8ICAgICBcICAgfCAgICBcICAgICAgICAgICAgfCAgICANCnwgICBcICAgICAgICAgXCAgfCAgICAgLyAgIHwgICAgIFwgIHwgICAgICBcICB8ICAgICAgXCAgfCAgICAgXCAgICAgICAgICAgfCAgICANCmAtLS0tXF9fICAgICBfL18gICAgIF8vX18gICAgICAgXy9fX3wgICAgIF8vX198ICAgICBfLyAgICAgICBfLy1baVP4IV0tLS0tJyAgICANCiAgICAgICAgXF9fX18oICBcX19fXyggICBcX19fX19fKCAgIHxfX19fXyggICB8X19fX18oIFxfX19fX18oICAgICAgICAgICAgICAgICANCg0KbG9naW46IBtbMW1qb2pvG1swbQ0KcGFzc3dvcmQ6IBtbMW14eHh4G1swbQ0K
    [png] => http://bbs-scene.org/api/grab.php?png=210
    [timestamp] => 2012-11-02 05:28:29
)
*/
?>
