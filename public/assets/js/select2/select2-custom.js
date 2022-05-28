"use strict";
(function ($) {
    "use strict";
    // Single Search Select
    $(".js-example-basic-single").select2();
    $(".select2").select2({
        dropdownParent: $(".card-body"),
    });
    $(".select2-basic").select2();
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
        dropdownParent: $("#bulkUploadProduct .modal-content"),
    });
    $(".product-modal-2-mobile, #modalSelect-02, #modalSelect-01").select2({
        dropdownParent: $("#product-modal-2-mobile .modal-content"),
    });
    $("#shop_city_id_input").select2({
        dropdownParent: $("#add_shop_modal .modal-content"),
    });
    $("#edit_city_id").select2({
        dropdownParent: $("#editShop .modal-content"),
    });
    editShop;
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
        dropdownParent: $(".card-body"),
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
})(jQuery);
