










<?php 

/* 
include 'vendor/autoload.php';

use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

// Create a Notifier
$notifier = NotifierFactory::create();
 */

if(isset($_SESSION['user_id'])){
  $x=$_SESSION['user_id'];
$marginleft=0;
$query = "SELECT * FROM `notifications` WHERE `notification_user_id`='$x' ORDER BY `date` DESC limit 5";
 $result = $conn->prepare($query);    
 $result->execute();    
while($row = $result->fetch()){
$notification_post_id      = $row['notification_post_id'];
$name                      = $row['username'];
$type                      = $row['type'];
$status                    = $row['status'];
$date                      = $row['date'];    
$notification_user_id      = $row['notification_user_id'];   

 
 $count = 0;
$query = "SELECT * from `notifications` where `notification_user_id`='$x' order by `date` DESC";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
    $count = $row['notification_count'];}
    if($count>0){
      ?>
<div class="position-fixed bottom-0 right-0 p-3 xd" style="z-index: 5; right: 0; bottom: 0; margin-right:<?php echo $marginleft?>px">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
      <strong class=" text-center"><?php echo $date?></strong>
      <button type="button" class="ml-2 mb-1 close mr-auto" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
    <?php echo "You Have A New Notification From" . "<a class='text-dark' href='/cms/profile.php?u_id=$notification_user_id'>$name</a>" ?>    </div>
  </div>
</div>  



<?php 




/* $notification =
    (new Notification())
    ->setTitle($name)
    ->setBody($date)
    ->setIcon('images/1.png')
    ->addOption('subtitle', 'This is a subtitle')
    ->addOption('sound', 'Frog') 
;


$notifier->send($notification); */


$marginleft=$marginleft+210 ; }} }?>
<script>



setTimeout(function () {

  $('.toast').toast('show');

}, 500);  
</script>




<ul class="nav static-bottom glow coloor">
<div class="container" >
<div class="row">
<div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200" data-aos-easing="ease-in-out-cubic"  
data-aos-mirror="true" data-aos-offset="-50">
    <a href="/cms/index.php" class="footer" > &copy; Programming Institution </a></div>
<div class="col" data-aos="flip-up" data-aos-duration="1500" data-aos-delay="200" data-aos-easing="ease-in-out-cubic" 
 data-aos-mirror="true" data-aos-offset="-50">
  
    <a href="https://www.facebook.com/profile.php?id=100009681182207" class="footer" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="https://twitter.com/chris13198557" class="footer" target="_blank"><i class="fab fa-twitter-square"></i></a>
    <a href="https://www.linkedin.com/in/ali-fahad-394a6217a/" class="footer" target="_blank"><i class="fab fa-linkedin"></i></a>
    <a href="/cms/contact.php" class="footer"><i class="fas fa-envelope"></i></a></div>
</div></div></ul>
        <!-- jQuery -->
<script src="/cms/js/jquery.js"></script>
<!-- color -->
<script src="/cms/js/jscolor.min.js"></script>
<!-- JavaScript --> 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<!-- ck -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script> -->
<!-- editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- js -->
<script type="text/javascript" src="/cms/js/script.js"></script>

<?php include "jquery.timeago.php";?>
<script>
        jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});


const file = document.querySelector('#file');
if(file){
file.addEventListener('change', (e) => {
  // Get the selected file
  const [file] = e.target.files;
  // Get the file name and size
  const { name: fileName, size } = file;
  // Convert size in bytes to kilo bytes
  const fileSize = (size / 1000).toFixed(2);
  // Set the text content
  const fileNameAndSize = `${fileName} - ${fileSize}KB`;
  document.querySelector('.file-name').textContent = fileNameAndSize;
});
}

    </script>



<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-3132cfb2-c836-43d2-b96c-a6afc09ffaf9"></div>

  <!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60c7920a7f4b000ac0379049/1f85p4u9q';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->
</body>
</html>