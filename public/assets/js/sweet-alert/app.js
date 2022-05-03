document.querySelectorAll(".delete-product").forEach(function (e) {
    e.onclick = function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(this).parent("form").submit();
            }
        });
    };
});
