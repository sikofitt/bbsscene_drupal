jQuery(document).ready(function ($) {

  $('#block-bbs_scene-bbs_scene_random_png img').one('error', function () {
  
    $(this).attr('src', Drupal.settings.bbs_scene.path + 'images/noimg.png').css('height', '160px');
  
  });
        
});
        