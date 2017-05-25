/**
 * Created by AYUSH on 5/25/2017.
 */

$("#submitform").on("click",function () {
    alert("clicked");
    event.preventDefault();
    console.log( $(this).serialize() );
    var formdata = $(this).serialize();
    var username = '<?php echo $username; ?>';
    // alert(formdata);
    $.ajax({
        type:"POST",
        url:'addEvent.php/',
        dataType:'text',
        data:{username:username},
        success: function(data){

            alert(data);

        },
        error:function (err) {
            console.log(err);
            alert(err);
        }
    });
});