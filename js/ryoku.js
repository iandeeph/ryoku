$(".button-collapse").sideNav();
$(".button-hide").sideNav();
$(document).ready(function() {
  $("#owl-demo").owlCarousel({
    items : 4,
    lazyLoad : true,
    autoPlay : true,
    navigation: false,
    pagination: false,
   });
  $('.materialboxed').materialbox();
  $('.scrollspy').scrollSpy();
  $(".dropdown-button").dropdown();$('.collapsible').collapsible({
    accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
  });
  $('.modal-trigger').leanModal();

});
jQuery(function($) {
  $(".swipebox").swipebox();
});

CollapsibleLists.apply();

tinymce.init({
  selector: '#wysiwygEditor'
});