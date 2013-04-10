// Diaporama
$(function(){
  $('.feature-slider a').click(function(e) {
    $('.featured-posts .featured-post').css({
      opacity: 0,
      visibility: 'hidden',
      left: '-960px'
    });
    $(this.hash).css({
      opacity: 1,
      visibility: 'visible',
      left: '0'
    });
    $('.feature-slider a').removeClass('active');
    $(this).addClass('active');
  });
});
