define([], function() {

    return {
        init: function() {
            $(document).ready(function() {
                $(".delete_btn").on('click',function(){
                    var dd = $(this).attr('ide');
                    // confirm();
                    $.ajax({
                        url:"delete.php",
                        type:"POST",
                        data:{
                            id : dd,
                        },
                        success:function(result){
                                location.reload();
                        }      
                    });
                    // alert('It changed!');
                });
            });
        }
    }
});