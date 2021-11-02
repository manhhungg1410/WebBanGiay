$(function (){
    $('.edit').on('click',function(e){
        var form = $(this).parents('form');
      e.preventDefault();
       Swal.fire({
           title: 'Do you want to update?',
           icon: 'question',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, I do!',
       }).then((result)=>{
           if(result.isConfirmed){
                form.submit();
           }
       })
   });
});
