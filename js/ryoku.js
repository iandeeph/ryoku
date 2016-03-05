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

    $("#btnAddProjectCategory").click(function(){
        var projCatValue = $("#addProjectCategory").val();
        $("#selectCategoryWrapper").remove();
        $("#categoryWrapper").append('<div id="inputProjCatWrapper" class="input-field"><input id="projCatAddInput" name="catProjAddSelect" type="text" class="validate"><label id="projCatLabel" for="projCatAddInput">Project Category</label></div>');
        $("#projCatAddInput").val(projCatValue);
        $("#projCatLabel").addClass('active');
    });

    $(".dropdown-button").dropdown();$('.collapsible').collapsible({
        accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $('#selectCatExperienceList').change(function() {
        this.form.submit();
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
        $('a[id^="delSelection"], button[id^="updateSelection"]').removeAttr('disabled');
        $('a[id^="delSelection"]').addClass('modal-trigger');
        $('.modal-trigger').leanModal();
    } else if (($(this).not(':checked')) && ($("input:checkbox:checked").length <= 0)) {
        $('a[id^="delSelection"], button[id^="updateSelection"]').addClass('disabled');
        $('a[id^="delSelection"]').removeClass('modal-trigger');
        $('a[id^="delSelection"], button[id^="updateSelection"]').attr('disabled', '');
        $('input[id^="checkAll"]').prop('checked', false);
        $('a[id^="delSelection').leanModal().unbind();
    }
});

$("input[name^='title'], textarea[name^='contentWord'], input[name^='linkAboutSocial'], input[name^='originProductBrand'], input[name^='categoryProductBrand'], textarea[name^='descriptionProductBrand']").change(function () {
    $(this).closest('tr').find(':checkbox').prop('checked', true);
    $('button[id^="updateSelection"]').removeClass('disabled');
    $('button[id^="updateSelection"]').removeAttr('disabled');
    if ($(this).closest('tr').find(':checkbox').is(":disabled") || parseInt($(this).closest('tr').find("input[name^='productCountProductBrand']").val()) > 0) {
        $('a[id^="delSelection"]').addClass('disabled');
        $('a[id^="delSelection"]').removeClass('modal-trigger');
        $('a[id^="delSelection"]').attr('disabled', '');
        $(this).closest('tr').find(':checkbox').prop('checked', true);
        $(this).closest('tr').find(':checkbox').removeAttr('disabled');
    }else{
        $('a[id^="delSelection"]').removeClass('disabled');
        $('a[id^="delSelection"]').addClass('modal-trigger');
        $('a[id^="delSelection"]').removeAttr('disabled');
    }
});

$("#changeImagePathAboutContact, #nameCompany, #phoneCompany, #faxCompany, #addressCompany").change(function () {
    $('#btnUpdateAboutContact').removeClass('disabled');
    $('#btnUpdateAboutContact').removeAttr('disabled');
});