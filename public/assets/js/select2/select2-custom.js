"use strict";
(function ($) {
    "use strict";
    // Single Search Select
    $(".js-example-basic-single").select2();
    $(".js-example-disabled-results").select2();
    $(".js-example-basic-multiple").select2();

    $("#edit_product_shop, #edit_product_category").select2({
        dropdownParent: $("#editProductModal .modal-content"),
    });
    $("#clone_product_shop, #clone_product_category").select2({
        dropdownParent: $("#cloneProductModal .modal-content"),
    });
    $("#modalSelect-6, #modalSelect-7").select2({
        dropdownParent: $("#product-modal-3 .modal-content"),
    });

    $("#modalSelect-2, #modalSelect-3").select2({
        dropdownParent: $("#product-modal-2 .modal-content"),
    });
    $(".product-modal-2-mobile, #modalSelect-02, #modalSelect-01").select2({
        dropdownParent: $("#product-modal-2-mobile .modal-content"),
    });

    // custom
    function iformat(icon) {
        var originalOption = icon.element;
        return $(
            '<span><i class="fi ' +
                $(originalOption).data("icon") +
                '"></i> ' +
                icon.text +
                "</span>"
        );
    }
    $(".country-list").select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
    });
    $("#edit_product_country").select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
        dropdownParent: $("#editProductModal .modal-content"),
    });
    $("#clone_product_country").select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
        dropdownParent: $("#cloneProductModal .modal-content"),
    });

    // With Placeholder
    $("#bm-group").select2({
        dropdownParent: $("#addNewItem .modal-content"),
    });

    //Limited Numbers
    $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2,
    });

    //RTL Suppoort
    $(".js-example-rtl").select2({
        dir: "rtl",
    });
    // Responsive width Search Select
    $(".js-example-basic-hide-search").select2({
        minimumResultsForSearch: Infinity,
    });
    $(".js-example-disabled").select2({
        disabled: true,
    });
    $(".js-programmatic-enable").on("click", function () {
        $(".js-example-disabled").prop("disabled", false);
    });
    $(".js-programmatic-disable").on("click", function () {
        $(".js-example-disabled").prop("disabled", true);
    });
})(jQuery);
