jQuery(document).ready(function ($) {

  $('#block-bbs-scene-bbs-scene-random-png img').one('error', function () {
  
    $(this).attr('src', Drupal.settings.bbs_scene.path + 'images/noimg.png').css('height', '160px');
  
  });
        
});
        
