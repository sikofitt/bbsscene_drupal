jQuery.noConflict();
jQuery(document).ready(function() { 
  jQuery('#bbs_entries').tablesorter({
    widthFixed: true,
    sortList: [[0,0]],
    offset:1,
  });

  jQuery('#bbs_entries').tablesorterPager({  // create pager last so the pop ups can populate correctly.
    container: jQuery("#pager"),
    cancelSelection : true
  });

});