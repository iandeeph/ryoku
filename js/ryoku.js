$(".button-collapse").sideNav();
$(".button-hide").sideNav();

function checkPasswordMatch() {
    var password = $("#addUserPassword").val();
    var confirmPassword = $("#addUserReenterPassword").val();

    if (password != confirmPassword){
        $("#txtConfirmPassword").text("Passwords do not match!");
        $("#txtConfirmPassword").addClass('red-text');
        $("#txtConfirmPassword").removeClass('green-text');
        
    }else{
        $("#txtConfirmPassword").text("Passwords match.");
        $("#txtConfirmPassword").addClass('green-text');
        $("#txtConfirmPassword").removeClass('red-text');
    }
}

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

    $(document).ready(function () {
        $("#addUserReenterPassword").keyup(checkPasswordMatch);
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

$("input[name^='title'], input[name^='linkAboutSocial']").change(function () {
    $(this).closest('tr').find(':checkbox').prop('checked', true);
    $('a[id^="delSelection"], button[id^="updateSelection"]').removeClass('disabled');
});

$("#changeImagePathAboutContact, #nameCompany, #phoneCompany, #faxCompany, #addressCompany").change(function () {
    $('#btnUpdateAboutContact').removeClass('disabled');
    $('#btnUpdateAboutContact').prop("disabled", false);
});