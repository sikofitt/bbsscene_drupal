jQuery(document).ready(function ($) {

  $('img').one('error', function () {
  
    $(this).attr('src', Drupal.settings.bbs_scene.path + 'images/noimg.png').css('height', '160px');
  
  });
        
});
        