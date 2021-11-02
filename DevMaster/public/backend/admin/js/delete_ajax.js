$(function(){
    $('#idForm').submit(function (event) {
        event.preventDefault();
        let urlRequest = $(this).attr('action');
        let that = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlRequest,
                    type: 'GET',
                    data: that.serialize(),
                    success: function (response) {
                        if(response.code == 200) {

                                if($('input[type="checkbox"][name="checkDelete[]"]:checked')){
                                    $('input[type="checkbox"][name="checkDelete[]"]:checked').parent().parent().remove();
                                }
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                        else if(response.status == false){
                            Swal.fire(
                                'Fails!',
                                'You can not delete it.',
                                'warning'
                            )
                        }
                        else {
                            Swal.fire(
                                'Fails!',
                                'Please choose record you want delete.',
                                'warning'
                            )
                        }

                    },
                    error: function (response) {

                    }
                });
            }
        });
    });
});

