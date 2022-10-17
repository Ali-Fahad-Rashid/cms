
<script>   


$(".edii").click(function(){  
    var com_id = $(this).attr("data");
  $("#edd"+com_id).attr("contenteditable", "true");
  $("#edd"+com_id).focus(); 
  $("#edss"+com_id).show(500);  

});

$(".savv").click(function(){  
    var com_id = $(this).attr("data");

  $("#edss"+com_id).hide(500);  
  $("#edd"+com_id).attr("contenteditable", "false");
  var con = $("#edd"+com_id).html(); 
  var post_id = <?php echo $the_post_id;?>;

$.ajax({
url: "includes/comments/edit.php",
type: 'POST',
data: {
'reply': 1,
'post_id': post_id,
'con': con,
'com_id' : com_id,

}

});


});










 $(".edi").click(function(){  
    var com_id = $(this).attr("data");
  $("#ed"+com_id).attr("contenteditable", "true");
  $("#ed"+com_id).focus(); 
  $("#eds"+com_id).show(500);  

});

$(".sav").click(function(){  
    var com_id = $(this).attr("data");

  $("#eds"+com_id).hide(500);  
  $("#ed"+com_id).attr("contenteditable", "false");
  var con = $("#ed"+com_id).html(); 
  var post_id = <?php echo $the_post_id;?>;

$.ajax({
url: "includes/comments/edit.php",
type: 'POST',
data: {
'edit': 1,
'post_id': post_id,
'con': con,
'com_id' : com_id,

}

});


});


</script>          

<script>
 function showReplyForm(self) {
     var commentId = self.getAttribute("data-comment_id");
     if (document.getElementById("form-" + commentId).style.display == "") {
         document.getElementById("form-" + commentId).style.display = "none";
     } else {
         document.getElementById("form-" + commentId).style.display = "";     } }
 </script>
<script>
function showReplyForReplyForm(self) {
    var commentId = self.getAttribute("data-comment_id");
    var name = self.getAttribute("data-comment_user");
    if (document.getElementById("form-" + commentId).style.display == "") {
        document.getElementById("form-" + commentId).style.display = "none";
    } else {
        document.getElementById("form-" + commentId).style.display = "";    }
    document.querySelector("#form-" + commentId + " textarea[name=comment]").value = "@" + name;
    document.getElementById("form-" + commentId).scrollIntoView();}

$(document).ready(function(){   
var post_id = <?php echo $post_id;?>;
var user_id = <?php echo $_SESSION['user_id'];?>;
$(document).on('click', '.likee', function(){
    var com_id = $(this).attr("data");
$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'JSON',
data: {
'likedd' : 1,
'post_id': post_id,
'user_id': user_id,
'com_id' : com_id
},
success: function(array){
  $("#ghj"+com_id).text(array.likes);
  $("#zxc"+com_id).text(array.unlikes);
}
});
$("#idd"+com_id).html("<i class='fas fa-thumbs-up fa-2x'></i>");
$("#idd"+com_id).addClass('unlikee').removeClass('likee');

$("#idxd"+com_id).html("<i class='far fa-thumbs-down fa-2x'></i>");
$("#idxd"+com_id).addClass('likee2').removeClass('unlikee2');

});

$(document).on('click', '.unlikee', function(){
    var com_id = $(this).attr("data");

$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'text',
data: {
'unlikedd': 1,
'post_id': post_id,
'user_id': user_id,
'com_id' : com_id

},
success: function(data){
  $("#ghj"+com_id).text(data);
}
});
$("#idd"+com_id).html("<i class='far fa-thumbs-up fa-2x'></i>");
$("#idd"+com_id).addClass('likee').removeClass('unlikee');
});
$(document).on('click', '.likee2', function(){
    var com_id = $(this).attr("data");


$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'JSON',
data: {
'likedd2': 1,
'post_id': post_id,
'user_id': user_id,
'com_id' : com_id

},
success: function(array){
  $("#ghj"+com_id).text(array.likes);
  $("#zxc"+com_id).text(array.unlikes);
}
});
$("#idxd"+com_id).html("<i class='fas fa-thumbs-down fa-2x'></i>");
$("#idxd"+com_id).addClass('unlikee2').removeClass('likee2');

$("#idd"+com_id).html("<i class='far fa-thumbs-up fa-2x'></i>");
$("#idd"+com_id).addClass('likee').removeClass('unlikee');
});

$(document).on('click', '.unlikee2', function(){
    var com_id = $(this).attr("data");

$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'text',
data: {
'unlikedd2': 1,
'post_id': post_id,
'user_id': user_id,
'com_id' : com_id

},
success: function(data2){
  $("#zxc"+com_id).html(data2);
}
});
$("#idxd"+com_id).html("<i class='far fa-thumbs-down fa-2x'></i>");
$("#idxd"+com_id).addClass('likee2').removeClass('unlikee2');
});

});

</script>

