"use strict";
/* category  js*/
$("#editcategory").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data("url"); // Extract info from data-* attributes
    $.ajax({
        url: url,
        success: function (response) {
            modal.find("#edit_category_id").val(response.data.id);
            modal.find("#edit_catgeory_name").val(response.data.name);
            modal
                .find("#edit_catgeory_image_preview")
                .attr("src", response.data.image);
        },
    });
    var modal = $(this);
});

$("body").on("click", "#update_category", function () {
    clearError();
    var fdata = new FormData();
    var myform = $("#edit_category_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#edit_category_image")[0].files[0];
    fdata.append("category_image", image);
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $("#category-list").html(response.html);
                myform[0].reset();
                showToast("Category has been updated successfully", "success");
                $("#editcategory").modal("hide");
                hideloader();
            }
        },
    });
    hideloader();
});

$("body").on("click", "#ajax_add_category_button", function () {
    clearError();
    var fdata = new FormData();
    var myform = $("#ajax_add_category"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#add_category_image")[0].files[0];
    if ($("#add_category_image")[0]) {
        fdata.append("category_image", image);
    }
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                if ($("#category-list").length > 0) {
                    $("#category-list").html(response.html);
                } else if ($("#product_cat").length > 0) {
                    $("[name='category_id']").append(
                        '<option value="' +
                            response.data.id +
                            '" selected> ' +
                            response.data.name +
                            "</option>"
                    );
                }
                myform[0].reset();
                showToast("Category has been added successfully", "success");
                $("#add_catgeory_modal").modal("hide");
                hideloader();
            }
        },
        error: function (e) {
            if (e.status === 400) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    $("#category_" + key + "_input").addClass("is-invalid");
                    $("#category_" + key + "_input")
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
            hideloader();
        },
    });
});
/** Shop js */

$("body").on("click", "#ajax_add_shop_button", function () {
    clearError();
    var fdata = new FormData();
    var myform = $("#ajax_add_shop"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#add_shop_image")[0].files[0];
    if ($("#add_shop_image")[0]) {
        fdata.append("shop_image", image);
    }
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                if ($("#shop-list").length > 0) {
                    $("#shop-list").html(response.html);
                } else if ($("#product_shop").length > 0) {
                    $("[name='shop_id']").append(
                        '<option value="' +
                            response.data.id +
                            '" selected> ' +
                            response.data.name +
                            "</option>"
                    );
                }
                myform[0].reset();
                showToast("Shop has been added successfully", "success");
                $("#add_shop_modal").modal("hide");
                hideloader();
            }
        },
        error: function (e) {
            if (e.status === 400) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    $("#shop_" + key + "_input").addClass("is-invalid");
                    $("#shop_" + key + "_input")
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
            hideloader();
        },
    });
});

$("#editShop").on("show.bs.modal", function (event) {
    clearError();
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data("url"); // Extract info from data-* attributes
    $.ajax({
        url: url,
        success: function (response) {
            modal.find("#edit_shop_id").val(response.data.id);
            modal
                .find("#edit_city_id")
                .val(response.data.city_id)
                .trigger("change");
            modal.find("#edit_shop_name").val(response.data.name);
            modal
                .find("#edit_shop_image_preview")
                .attr("src", response.data.image);
        },
    });
    var modal = $(this);
    hideloader();
});

$("body").on("click", "#update_shop", function () {
    clearError();
    var fdata = new FormData();

    var myform = $("#edit_shop_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#edit_shop_image")[0].files[0];
    fdata.append("shop_image", image);
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                hideloader();
                $("#shop-list").html(response.html);
                myform[0].reset();
                showToast("Shop has been updated successfully", "success");
                $("#editShop").modal("hide");
            }
        },
        error: function (e) {
            let modal = $("#editShop");
            if (e.status === 422) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    modal.find('[name="' + key + '"]').addClass("is-invalid");
                    modal
                        .find('[name="' + key + '"]')
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
        },
    });
    hideloader();
});

///product Page js
$("#editProductModal").on("show.bs.modal", function (event) {
    clearError();
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data("url"); // Extract info from data-* attributes
    var modal = $(this);
    $.ajax({
        url: url,
        success: function (response) {
            if (response.success == true) {
                let product = response.product;
                $("#edit_product_category")
                    .val(product.category_id)
                    .trigger("change");
                $("#edit_product_id").val(product.id);
                $("#edit_product_shop").val(product.shop_id).trigger("change");
                modal.find("#edit_product_name").val(product.name);
                modal.find("#edit_kg_pc_price").val(product.kg_pc_price);
                modal.find("#edit_product_country").val(product.country);
                modal.find("#edit_product_value").val(product.value);
                modal.find("#edit_product_price").val(product.price);
                modal.find("#edit_product_price").val(product.price);
                modal
                    .find("input[name=type][value=" + product.type + "]")
                    .attr("checked", "checked");
                $(".edit-product-type").text(product.type);
                if (product.is_offer == 1) {
                    modal.find("#edit_product_offer").prop("checked", "true");
                } else {
                    modal.find("#edit_product_offer").prop("checked", false);
                }
                if (product.is_duty_free == 1) {
                    modal
                        .find("#edit_product_duty_free")
                        .prop("checked", false);
                } else {
                    modal
                        .find("#edit_product_duty_free")
                        .prop("checked", false);
                }
                modal
                    .find("#edit_product_image_preview")
                    .attr("src", product.image);
                modal
                    .find("#edit_product_delete")
                    .attr("data-url", button.data("destroy"));
            }
        },
    });
    hideloader();
});

$("body").on("click", "#update_product_btn", function () {
    clearError();
    var fdata = new FormData();
    var myform = $("#edit_product_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#edit_product_image")[0].files[0];
    if (image != undefined) {
        fdata.append("product_image", image);
    }
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product_list_grid").html(response.html);
                showToast(response.message);
                $("#editProductModal").modal("hide");
                hideloader();
            }
        },
        error: function (e) {
            let productEditModal = $("#editProductModal");
            if (e.status === 422) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    productEditModal
                        .find('[name="' + key + '"]')
                        .addClass("is-invalid");
                    productEditModal
                        .find('[name="' + key + '"]')
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
            hideloader();
        },
    });
});

$("#cloneProductModal").on("show.bs.modal", function (event) {
    clearError();
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data("url"); // Extract info from data-* attributes
    var modal = $(this);
    $.ajax({
        url: url,
        success: function (response) {
            if (response.success == true) {
                let product = response.product;
                $("#clone_product_category")
                    .val(product.category_id)
                    .trigger("change");
                $("#clone_product_id").val(product.id);
                $("#clone_product_shop").val(product.shop_id).trigger("change");
                modal.find("#clone_product_name").val(product.name);
                modal.find("#clone_kg_pc_price").val(product.kg_pc_price);
                modal.find("#clone_product_country").val(product.country);
                modal.find("#clone_product_value").val(product.value);
                modal.find("#clone_product_price").val(product.price);
                modal.find("#clone_product_price").val(product.price);
                modal
                    .find("input[name=type][value=" + product.type + "]")
                    .attr("checked", "checked");
                $(".clone-product-type").text(product.type);
                if (product.is_offer == 1) {
                    modal.find("#clone_product_offer").prop("checked", "true");
                } else {
                    modal.find("#clone_product_offer").prop("checked", false);
                }
                if (product.is_duty_free == 1) {
                    modal
                        .find("#clone_product_duty_free")
                        .prop("checked", "true");
                } else {
                    modal
                        .find("#clone_product_duty_free")
                        .prop("checked", false);
                }
                modal
                    .find("#clone_product_image_preview")
                    .attr("src", product.image);
                modal
                    .find("#clone_product_delete")
                    .attr("data-url", button.data("destroy"));
            }
        },
    });

    hideloader();
});

$("body").on("click", "#clone_product_btn", function () {
    clearError();
    var fdata = new FormData();
    var myform = $("#clone_product_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#clone_product_image")[0].files[0];
    if (image != undefined) {
        fdata.append("product_image", image);
    }
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product_list_grid").html(response.html);
                showToast(response.message);
                $("#cloneProductModal").modal("hide");
                hideloader();
            }
        },
        error: function (e) {
            let productEditModal = $("#cloneProductModal");
            if (e.status === 422) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    productEditModal
                        .find('[name="' + key + '"]')
                        .addClass("is-invalid");
                    productEditModal
                        .find('[name="' + key + '"]')
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
            hideloader();
        },
    });
});

///// add product js

$("body").on("click", "#add_product_btn", function (e) {
    e.preventDefault();
    clearError();
    var fdata = new FormData();
    var myform = $("#add_product_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#add_product_image")[0].files[0];
    if (image != undefined) {
        fdata.append("product_image", image);
    }
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product-wrapper-grid").prepend(response.html);
                showToast(response.message, "success", false);
                myform.find("input[name='name']").val("");
                myform.find("input[name='value']").val("1");
                myform.find("input[name='price']").val("");
                myform.find("input[name='product_image']").val("");
                myform.find("input[name='type'][value='pcs']").trigger("click");
                if ($("#empty_product_image").length > 0) {
                    $("#empty_product_image").remove();
                }
                resetDropzone();
                hideloader();
            }
        },
        error: function (e) {
            let productEditModal = $("#product_add_box");
            if (e.status === 422) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    productEditModal
                        .find('[name="' + key + '"]')
                        .addClass("is-invalid");
                    productEditModal
                        .find('[name="' + key + '"]')
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );
                });
            }
            hideloader();
        },
    });
});
/// bulk upload js

$("body").on("click", "#bulk_upload_form_btn", function (e) {
    e.preventDefault();
    clearError();
    var fdata = new FormData();
    var myform = $("#bulk_upload_form"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var image = $("#bulk_upload_images")[0].files;

    for (var i = 0; i < image.length; i++) {
        fdata.append("product_images[]", image[i]);
    }

    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });

    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product_list_grid").html(response.html);
                showToast(response.message, "success", false);
                $("#bulk_upload_images").val("");
                $("#bulkUploadProduct").modal("hide");
                hideloader();
            }
        },
        error: function (e) {
            let productEditModal = $("#bulkUploadProduct");
            if (e.status === 422) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    productEditModal
                        .find('[name="' + key + '"]')
                        .addClass("is-invalid");
                    productEditModal
                        .find('[name="' + key + '"]')
                        .parent()
                        .append(
                            ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                        );

                    if (key.indexOf("product_images.") != -1) {
                        clearError();
                        productEditModal
                            .find('[name="product_images"]')
                            .addClass("is-invalid")
                            .parent()
                            .append(
                                ' <span class="invalid-feedback" role="alert"><strong>The product image must be a file of type: jpeg, png, jpg.</strong></span>'
                            );
                    }
                });
            }
            hideloader();
        },
    });
});
function clearError() {
    showLoader();
    $(".invalid-feedback").remove();
    $(".form-control").removeClass("is-invalid");
}
function deleteProduct(button) {
    $.ajax({
        url: button.attr("data-url"),
        type: "DELETE",
        success: function (response) {
            $("#editProductModal").modal("hide");
            if (response.success == true) {
                showToast(response.message);
                $("#product_box_" + response.product_id).remove();
            } else {
                showToast(response.message, "error");
            }
        },
        error: function () {
            $("#editProductModal").modal("hide");

            showToast(
                "Something went wrong. While completeing you request",
                "danger"
            );
        },
    });
}

$("body").on("click", "#applyFilter", function () {
    applyFilter();
});

function applyFilter() {
    var fdata = new FormData();
    var myform = $("#gridSearchForm"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    var sort = $('select[name="sort"]').val();
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    fdata.append("sort", sort);

    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product_list_grid").html(response.html);
                $("#product-modal-2-mobile").modal("hide");
            }
        },
    });
}

$("body").on("click", ".page-link", function (e) {
    e.preventDefault();
    var fdata = new FormData();
    var myform = $("#gridSearchForm"); // specify the form element
    let action = myform.attr("action");
    var idata = myform.serializeArray();
    $.each(idata, function (key, input) {
        fdata.append(input.name, input.value);
    });
    let page = $(this).data("page");

    fdata.append("page", page);
    $.ajax({
        url: action,
        data: fdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success == true) {
                $(".product_list_grid").html(response.html);
                $("#product-modal-2-mobile").modal("hide");
            }
        },
    });
});

//// common function
function showToast(message, type = "success", reset = true) {
    if (reset) {
        $("select").val(null).trigger("change");
    }
    toastr[type](message);
}

function previewFile(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}

function previewAddFile(event, id) {
    $(".dz-message").hide();
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };

    $(".preview_image").show();
}

function increase(input, price = false, increaseBy = 1) {
    let value = $(input).val();
    if (value == "") {
        value = 0;
    }
    let newValue = parseFloat(value) + increaseBy;
    if (price) {
        newValue = newValue.toFixed(2);
    }
    $(input).val(newValue).trigger("change");
}
function decrease(input, price = false, decreaseBy = 1) {
    let value = $(input).val();
    if (value == "") {
        value = 0;
    }
    if (value > 0) {
        let newValue = parseFloat(value) - parseFloat(decreaseBy);
        if (price) {
            newValue = newValue.toFixed(2);
        }
        $(input).val(newValue).trigger("change");
    } else {
        $(input).val(0);
    }
}
function increaseByTen(input, price = false) {
    let value = $(input).val();
    if (value == "") {
        value = 0;
    }
    let newValue = parseFloat(value) + 10;
    if (price) {
        newValue = newValue.toFixed(2);
    }

    $(input).val(newValue).trigger("change");
}

$("body").on("change", ".add_product_type", function () {
    let val = $(".add_product_type:checked").val();
    $(".add-product-type").text(val);
    $("#product_value").trigger("change");
});
$("body").on("change", ".edit_product_type", function () {
    let val = $(".edit_product_type:checked").val();
    $(".edit-product-type").text(val);
});

$("body").on("change", ".clone_product_type", function () {
    let val = $(".clone_product_type:checked").val();
    $(".clone-product-type").text(val);
});

function showLoader() {
    $("#process_request").show();
}

function hideloader() {
    $("#process_request").hide();
}

toastr.options = {
    closeButton: true,
    debug: true,
    newestOnTop: true,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: true,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

$("body").on("click", ".btn-reset", function () {
    let form = $("#add_product_form");
    $("select").val(null).trigger("change");
    form.find("input[name='name']").val("");
    form.find("input[name='value']").val("1");
    form.find("input[name='price']").val("");
    form.find("input[name='product_image']").val("");
    form.find("input[name='type'][value='pcs']").trigger("click");
    resetDropzone();
});

function resetDropzone() {
    $(".dz-message").show();
    $(".preview_image").hide();
}

$("body").on("click", ".btn-advance", function () {
    $("#advance_options").toggleClass("d-none");
    if ($("#advance_options").hasClass("d-none")) {
        $(this).find("i").removeClass("fa-minus");
        $(this).find("i").addClass("fa-plus");
    } else {
        $(this).find("i").removeClass("fa-plus");
        $(this).find("i").addClass("fa-minus");
    }
});
