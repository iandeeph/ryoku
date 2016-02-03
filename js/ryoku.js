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

    jQuery(function($) {
        $(".swipebox").swipebox();
    });

    $(".dropdown-button").dropdown();$('.collapsible').collapsible({
        accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $('.materialboxed').materialbox();
    $('.scrollspy').scrollSpy();
    $('.modal-trigger').leanModal();
    $('.slider').slider({full_width: false});
    $('select').material_select();
});

CollapsibleLists.apply();

tinymce.init({
    selector: '#wysiwygEditor'
});

$('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('img[id^="image_upload_preview"]').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("input[id^='changeImageFile']").change(function () {
    readURL(this);
});

$('input[name="age"], input[name="poscode"]').change(function(){
  if ($(this).val())
  {
    $("input[name='submit']").removeAttr('disabled');
  }
});

$('input[id^="checkAll"]').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});

$('input:checkbox').change(function () {
    if ($(this).is(':checked')) {
        $('a[id^="delSelection"], button[id^="updateSelection"]').removeClass('disabled');
    } else if (($(this).not(':checked')) && ($("input:checkbox:checked").length <= 0)) {
        $('a[id^="delSelection"], button[id^="updateSelection"]').addClass('disabled');
        $('input[id^="checkAll"]').prop('checked', false);
    }
});

$("input[name^='title'], textarea[name^='contentWord']").change(function () {
    $(this).closest('tr').find(':checkbox').prop('checked', true);
    $('a[id^="delSelection"], button[id^="updateSelection"]').removeClass('disabled');
});