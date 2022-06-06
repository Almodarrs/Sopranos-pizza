<?php 
// Initialize shopping cart class 
include_once 'Cart.class.php'; 
$cart = new Cart; 
 
// Include the database config file 
require_once 'dbConfig.php'; 
?>

<!DOCTYPE html>
<html lang="nl">

<head>
<title>Sopranos Pizza</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/aos.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/bootstrap-datepicker.css">
<link rel="stylesheet" href="css/jquery.timepicker.css">
<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/style.css">
<link href="css/font_style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
<div class="container">
<a href="index.html"><img class="navbar-brand" src="images/logo.png"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
<span class="oi oi-menu"></span> Menu
</button>
<div class="collapse navbar-collapse" id="ftco-nav">
<ul class="navbar-nav ml-auto">
<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
<li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
<li class="nav-item"><a href="about.php" class="nav-link">Over ons</a></li>
<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
<div class="cart-view">
        <a href="viewCart.php" title="View Cart"><i class="icart"></i> (<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':'Leeg'; ?>)</a>
    </div>

</ul>
</div>
</div>
</nav>

<section class="home-slider owl-carousel img" style="background-image: url(images/pizza-1442946_1920.jpg);">
<div class="slider-item">
<div class="overlay"></div>
<div class="container">
<div class="row slider-text align-items-center" data-scrollax-parent="true">
<div class="col-md-6 col-sm-12 ftco-animate">
<span class="subheading">Bestel nu</span>
<h1 class="mb-4">Pizza Sopranos Deluxe</h1>
<p class="mb-4 mb-md-5">Tomatensaus, mozzarella, tonijn en ui. De lekkere tonijn in combinatie met de smaakvolle ui zorgt voor een ware smaaksensatie.</p>
<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Bestel online</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Bekijk menu</a></p>
</div>
<div class="col-md-6 ftco-animate">
<img src="images/bg_1.png" class="img-fluid" alt="">
</div>
</div>
</div>
</div>
<div class="slider-item">
<div class="overlay"></div>
<div class="container">
<div class="row slider-text align-items-center" data-scrollax-parent="true">
<div class="col-md-6 col-sm-12 order-md-last ftco-animate">
<span class="subheading">Bestel online</span>
<h1 class="mb-4">Pizza Quattro formaggio</h1>
<p class="mb-4 mb-md-5">Tomatensaus, mozzarella, olijven. de heerlijke steenovenpizza met de beste ingrediënten, op traditionele Italiaanse wijze bereid.</p>
<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Bestel nu</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Bekijk menu</a></p>
</div>
<div class="col-md-6 ftco-animate">
<img src="images/Pizza 3.png" class="img-fluid" alt="">
</div>
</div>
</div>
</div>
<div class="slider-item">
<div class="overlay"></div>
<div class="container">
<div class="row slider-text align-items-center" data-scrollax-parent="true">
<div class="col-md-6 col-sm-12 order-md-last ftco-animate">
<span class="subheading">Bestel online</span>
<h1 class="mb-4">Pizza Tonno</h1>
<p class="mb-4 mb-md-5">Tomatensaus, mozzarella, olijven. de heerlijke steenovenpizza met de beste ingrediënten, op traditionele Italiaanse wijze bereid.</p>
<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Bestel nu</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Bekijk menu</a></p>
</div>
<div class="col-md-6 ftco-animate">
<img src="images/pizza 5.png" class="img-fluid" alt="">
</div>
</div>
</div>
</div>
<div class="slider-item">
<div class="overlay"></div>
<div class="container">
<div class="row slider-text align-items-center" data-scrollax-parent="true">
<div class="col-md-6 col-sm-12 order-md-last ftco-animate">
<span class="subheading">Bestel online</span>
<h1 class="mb-4">Pizza Vegetariano</h1>
<p class="mb-4 mb-md-5">Tomatensaus, mozzarella, olijven. de heerlijke steenovenpizza met de beste ingrediënten, op traditionele Italiaanse wijze bereid.</p>
<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Bestel nu</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Bekijk menu</a></p>
</div>
<div class="col-md-6 ftco-animate">
<img src="images/Pizza 4.png" class="img-fluid" alt="">
</div>
</div>
</div>
</div>
<div class="slider-item" style="background-image: url(images/slider-3.jpg);">
<div class="overlay"></div>
<div class="container">
<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
<div class="col-md-7 col-sm-12 text-center ftco-animate">
<span class="subheading">Welkom bij</span>
<h1 class="mb-4">Sopranos Pizzabar</h1>
<p class="mb-4 mb-md-5">In alle smaken en variaties die je kunt bedenken, inclusief vegetarische, veganistische en glutenvrije opties. Eet smakelijk!</p>
<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Bestel nu</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Bekijk menu</a></p>
</div>
</div>
</div>
</div>
</section>
<section class="ftco-intro">
<div class="container-wrap">
<div class="wrap d-md-flex">
<div class="info">
<div class="row no-gutters">
<div class="col-md-4 d-flex ftco-animate">
<div class="icon"><span class="icon-phone"></span></div>
<div class="text">
<h3>+31 6331 4730 81</h3>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
<div class="icon"><span class="icon-my_location"></span></div>
<div class="text">
<h3>Luifelbaan 2, 2242 KT Wassenaar</h3>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
<div class="icon"><span class="icon-clock-o"></span></div>
<div class="text">
<h3>Open vanaf Maandag-Vrijdag</h3>
</div>
</div>
</div>
</div>
<div class="social d-md-flex pl-md-5 p-4 align-items-center">
<ul class="social-icon">
<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
</ul>
</div>
</div>
</div>
</section>
<section class="ftco-about d-md-flex">
<div class="one-half img" style="background-image: url(images/pizza-2810589_1920.jpg);"></div>
<div class="one-half ftco-animate">
<div class="heading-section ftco-animate ">
<h2 class="mb-4">Welkom bij <span class="flaticon-pizza">Sopranos</span> Pizzabar</h2>
</div>
<div>
<p>Pizza’s uit Sopranos kenmerken zich door de medium dikke korst die knapperig is en tegelijkertijd toch een bite heeft. Dit combineren wij met smaakvolle tomatensaus, verse mozzarella en natuurlijk de heerlijkste toppings, van traditioneel tot de beste variaties. Bij ons kun je altijd de pizza bestellen die perfect bij jouw smaak past en ben je verzekerd van de meest verse ingrediënten. Je kunt bij Sopranos Pizza ook terecht voor de heerlijkste pasta’s, salades en desserts. </p>
</div>
</div>
</section>

    <br><br><br><br><br>
<div class="container">
<div class="row justify-content-center mb-5 pb-3">
<div class="col-md-7 heading-section ftco-animate text-center">
<h2 class="mb-4">Hot Pizza Meals</h2>
<p>Wij maken de beste Pizza voor je te genieten</p>
</div>
</div>
</div>
<div class="container-wrap">
<?php 
        // Get products from database 
        $result = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 4"); 
        // if($result->num_rows > 0){  
        //     while($row = $result->fetch_assoc()){
          if ($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
        ?>
<div class="row no-gutters d-flex">
<!-- <div class="col-lg-4 d-flex ftco-animate"> -->
<div class="services-wrap d-flex">
<!-- <a href="#" class="img" style="background-image: url;"></a> -->

<div class="text p-4">
<img class="img" src="<?php echo $row["image"]; ?>">
<h3><?php 
echo $row["name"]; ?></h3>
<p><?php 
echo $row["description"]; ?> </p>


<p class="price"><span><?php echo '€'.$row["price"].' EUR'; ?></span> <a href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>" class="ml-2 btn btn-white btn-outline-white">TOEVOEGEN</a></p>
<select onChange="getdistrict(this.value);" name="size" id="size" >
<option value="">Select</option>
<!--- Fetching States--->
<?php
$sql="SELECT items.id, sizes.name
FROM items
INNER JOIN sizes
ON items.id = items.product_id;
";
$stmt=$db->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row =$stmt->fetch()) { 
  ?>
<option value="<?php echo $row['size_id'];?>"><?php echo $row['name'];?></option>
<?php
 }?>
                    </select>

</div>
<div >


</div>
<?php  }}else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</section>

<footer class="ftco-footer ftco-section img">
<div class="overlay"></div>
<div class="container">
<div class="row mb-5">
<div class="col-lg-3 col-md-6 mb-5 mb-md-5">
<div class="ftco-footer-widget mb-4">
<h2 class="ftco-heading-2"><img src="images/logo.PNG" style="width: 100%; height: 180px;"></h2>
<p>In alle smaken en variaties die je kunt bedenken, inclusief vegetarische, veganistische en glutenvrije opties. Eet smakelijk!</p>
<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-6 mb-5 mb-md-5">
<div class="ftco-footer-widget mb-4" style="display: none;">
<h2 class="ftco-heading-2">Recent Blog</h2>
<div class="block-21 mb-4 d-flex">
<a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
<div class="text">
<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
<div class="meta">
<div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
<div><a href="#"><span class="icon-person"></span> Admin</a></div>
<div><a href="#"><span class="icon-chat"></span> 19</a></div>
</div>
</div>
</div>
<div class="block-21 mb-4 d-flex">
<a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
<div class="text">
<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
<div class="meta">
<div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
<div><a href="#"><span class="icon-person"></span> Admin</a></div>
<div><a href="#"><span class="icon-chat"></span> 19</a></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-2 col-md-6 mb-5 mb-md-5" style="right:200px; top: 148px;">
<div class="ftco-footer-widget mb-4 ml-md-4">
<h2 class="ftco-heading-2" style="bottom: 20px;">Pagina's</h2>
<ul class="list-unstyled">
<li><a href="menu.html" class="py-2 d-block">Menu</a></li>
<li><a href="about.html" class="py-2 d-block">Over ons</a></li>
<li><a href="contact.html" class="py-2 d-block">Contact</a></li>
<li><a href="menu.html" class="py-2 d-block">Bestel nu</a></li>
</ul>
</div>
</div>
<div class="col-lg-3 col-md-6 mb-5 mb-md-5" style="top: 148px;">
<div class="ftco-footer-widget mb-4">
<h2 class="ftco-heading-2" style="bottom: 20px;">Heeft u een vraag?</h2>
<div class="block-23 mb-3">
<ul>
<li><span class="icon icon-map-marker"></span><span class="text">Luifelbaan 2, 2242 KT Wassenaar</span></li>
<li><a href="#"><span class="icon icon-phone"></span><span class="text">+31 392 3929 210</span></a></li>
<li><a href="#"><span class="icon icon-envelope"></span><span class="text"><span class="__cf_email__" data-cfemail="a5cccbc3cae5dccad0d7c1cac8c4cccb8bc6cac8">Sopranos@pizza.nl</span></span></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 text-center">
<p>
this template is designed by <a href="https://colorlib.com/" target="_blank" style="color: #ffa500 ;">Ahmed Almodares</a>
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</footer>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" /><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&amp;sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>
</html>