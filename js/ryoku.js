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

    $("#btnAddMainProdCatList").click(function(){
        var mainCatValue = $("#addMainProdCatList").val();
        $("#selectMainCatWrapper").remove();
        $("#mainCatWrapper").append('<div id="inputMainCatWrapper" class="input-field"><input id="mainCatAddInput" name="mainCatAdd" type="text" class="validate"><label id="mainCatLabel" for="mainCatAddInput">Main Category</label></div>');
        $("#mainCatAddInput").val(mainCatValue);
        $("#mainCatLabel").addClass('active');
    });

    $("#btnAddSubProdCatList").click(function(){
        var subCatValue = $("#addSubProdCatList").val();
        $("#selectSubCatWrapper").remove();
        $("#subCatWrapper").append('<div id="inputSubCatWrapper" class="input-field"><input id="subCatAddInput" name="subCatAdd" type="text" class="validate"><label id="subCatLabel" for="subCatAddInput">Sub Category</label></div>');
        $("#subCatAddInput").val(subCatValue);
        $("#subCatLabel").addClass('active');
    });

    $(".dropdown-button").dropdown();$('.collapsible').collapsible({
        accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $("#addUserReenterPassword").keyup(checkPasswordMatch);

    $('.materialboxed').materialbox();
    $('.scrollspy').scrollSpy();
    $('.modal-trigger').leanModal();
    $('.slider').slider({full_width: false});
    $('select').material_select();
    $('.carousel').carousel();
});

CollapsibleLists.apply();

tinymce.init({
    selector: '#wysiwygEditor'
});

$('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year
      dateFormat: 'yyyy-mm-dd'
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
    var checkboxes = $(this).closest('form').find(':checkbox').not(':disabled');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});

$('input:checkbox').change(function () {
    if ($(this).is(':checked')) {
        $('a[id^="delSelection"], button[id^="updateSelection"]').removeClass('disabled');
        $('a[id^="delSelection"]').addClass('modal-trigger');
        $('a[id^="delSelection"], button[id^="updateSelection"]').prop("disabled", false);
    } else if (($(this).not(':checked')) && ($("input:checkbox:checked").length <= 0)) {
        $('a[id^="delSelection"], button[id^="updateSelection"]').addClass('disabled');
        $('a[id^="delSelection"]').removeClass('modal-trigger');
        $('a[id^="delSelection"], button[id^="updateSelection"]').prop("disabled", true);
        $('input[id^="checkAll"]').prop('checked', false);
    }
});

$("input[name^='title'], textarea[name^='contentWord'], input[name^='linkAboutSocial']").change(function () {
    $(this).closest('tr').find(':checkbox').prop('checked', true);
    $('button[id^="updateSelection"]').removeClass('disabled');
    $('button[id^="updateSelection"]').prop("disabled", false);
    if ($(this).closest('tr').find(':checkbox').is(":disabled")) {
        $('a[id^="delSelection"]').addClass('disabled');
        $('a[id^="delSelection"]').removeClass('modal-trigger');
        $(this).closest('tr').find(':checkbox').prop('disabled', false);
    } else{
        $('a[id^="delSelection"]').removeClass('disabled');
        $('a[id^="delSelection"]').addClass('modal-trigger');
    }
});

$("#changeImagePathAboutContact, #nameCompany, #phoneCompany, #faxCompany, #addressCompany").change(function () {
    $('#btnUpdateAboutContact').removeClass('disabled');
    $('#btnUpdateAboutContact').prop("disabled", false);
});