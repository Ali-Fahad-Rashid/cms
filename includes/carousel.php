<link rel="stylesheet" href="/cms/css/slick.css">
<link rel="stylesheet" href="/cms/css/slick-theme.css">
</br></br>

<div dir="ltr" class="autoplay ">
<?php
$query = "SELECT * FROM admin_category ORDER BY cat_id DESC";
$result = $conn->prepare($query);   
$result->execute();      
foreach($result->fetchall() as $index => $row){
  $cat_id            = $row['cat_id'];
  $cat_post_id       = $row['cat_post_id'];
  $cat_user          = $row['cat_user'];
  $cat_title         = $row['cat_title'];
  $cat_status        = $row['cat_status'];
  $cat_image         = $row['cat_image'];
  $cat_date          = $row['cat_date'];
  $cat_content       = $row['cat_content'];?>


<div class="col m-12 col-lg-11 col-md-12 col-sm-13 ">
<div class="card bg-dark text-white">
<a href=""><img class="cv" alt="" height="200" width="307" src="/cms/upload/<?php echo $cat_image ;?>"></a>
  <div class="card-img-overlay"></br></br></br></br></br></br>
    <h5 id="shsh" class="text-center mb-3 "><?php echo $cat_title ;?></h5>
  </div></div>
</div>


  



  <?php } ?>

  </div> </br>
  </br>
  </br>
  </br>

<!--   <script src="/cms/js/slick.min.js"></script>
 -->
 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="/cms/js/slick.js" type="text/javascript" charset="utf-8"></script>
 <script type="text/javascript">


$('.autoplay').slick({  
  



  rtl:false,

  
  autoplay: true,
  autoplaySpeed: 2000,
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ],

  
});
		
</script>

<style type="text/css">




    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    
   
  </style>