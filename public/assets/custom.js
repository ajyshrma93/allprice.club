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
            modal.find("#edit_catgeory_image").attr("src", response.data.image);
        },
    });
    var modal = $(this);
});

$("body").on("click", "#update_category", function () {
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
            }
        },
    });
});

$("body").on("click", "#ajax_add_category_button", function () {
    $("input").removeClass("is-invalid");
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
                    $("#product_cat").append(
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
            }
        },
        error: function (e) {
            if (e.status === 400) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    $("#category_" + key + "_input").addClass("is-invalid");
                    $("#category_" + key + "_error").text(val[0]);
                });
            }
        },
    });
});
/** Shop js */

$("body").on("click", "#ajax_add_shop_button", function () {
    $("input").removeClass("is-invalid");
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
                    $("#product_shop").append(
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
            }
        },
        error: function (e) {
            if (e.status === 400) {
                var response = $.parseJSON(e.responseText);
                $.each(response.errors, function (key, val) {
                    $("#shop_" + key + "_input").addClass("is-invalid");
                    $("#shop_" + key + "_error").text(val[0]);
                });
            }
        },
    });
});

$("#editShop").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data("url"); // Extract info from data-* attributes
    $.ajax({
        url: url,
        success: function (response) {
            modal.find("#edit_shop_id").val(response.data.id);
            modal.find("#edit_shop_name").val(response.data.name);
            modal.find("#edit_shop_image").attr("src", response.data.image);
        },
    });
    var modal = $(this);
});

$("body").on("click", "#update_shop", function () {
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
                $("#shop-list").html(response.html);
                myform[0].reset();
                showToast("Shop has been updated successfully", "success");
                $("#editShop").modal("hide");
            }
        },
    });
});

//// common function
function showToast(message, type) {
    $.notify("<strong>" + message + "</strong>", {
        type: type,
        allow_dismiss: true,
        delay: 2000,
        showProgressbar: true,
        timer: 300,
        animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutUp",
        },
    });
}

function previewFile(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}

function increase(input) {
    let weight = $(input).val();
    if (weight == "") {
        weight = 0;
    }
    let newWeight = parseFloat(weight) + 1;
    $(input).val(newWeight.toFixed(2));
}
function decrease(input) {
    let weight = $(input).val();
    if (weight == "") {
        weight = 0;
    }
    if (weight > 1) {
        let newWeight = parseFloat(weight) - 1;
        $(input).val(newWeight.toFixed(2));
    }
}
function increaseByTen(input) {
    let weight = $(input).val();
    if (weight == "") {
        weight = 0;
    }
    let newWeight = parseFloat(weight) + 10;
    $(input).val(newWeight.toFixed(2));
}
