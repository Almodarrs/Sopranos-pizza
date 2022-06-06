<?php 
// Include the database config file 
require_once 'dbConfig.php'; 
 
// Initialize shopping cart class 
include_once 'Cart.class.php'; 
$cart = new Cart; 
 
// If the cart is empty, redirect to the products page 
if($cart->total_items() <= 0){ 
    header("Location: index.php"); 
} 
 
// Get posted data from session 
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array(); 
unset($_SESSION['postData']); 
 
// Get status message from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css1/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>CHECKOUT</h1>
    <div class="col-12">
        <div class="checkout">
            <div class="row">
                <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                </div>
                <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
				
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Uw Winkelmandje</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php 
                         $car =0;
                         $car2 =0;
                         $car3 =0;
                         $korting =0;
                        if($cart->total_items() > 0){ 
                            //get cart items from session 
                            $cartItems = $cart->contents(); 
                            foreach($cartItems as $item){ 
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                                <small class="text-muted"><?php echo '€'.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <!-- for the discount on every 2nd pizza  -->
                            <span class="text-muted"><?php if($item["qty"]==1){ $discount= $item["subtotal"];
                                    $car = $car + $discount;
                                    echo '€'.$discount.' EUR'; }elseif($item["qty"] % 2 == 0){
                                    $discount2 = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]/2);
                                    $car2 = $car2 + $discount2;
                                  echo '€'.$discount2;} elseif($item["qty"] % 2 != 0){
                                    $discount3 = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]-1)/2;
                                    $car3 = $car3 + $discount3;
                                  echo '€'.$discount3;} ?></span>
                        </li>
                        <?php } } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Totaal (EUR)</span>
                            <!-- for the discount on every 2nd pizza  -->
                            <strong><?php $cars = $car + $car2 + $car3 ;
                                echo '€'.$cars.' EUR';?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Korting (EUR)</span>
                            <!-- for the discount on every 2nd pizza  -->
                            <strong><?php $korting += $cart->total() - $cars ;
                                echo '€'.$korting.' EUR';?></strong>
                        </li>
                    </ul>
                    <a href="index.php" class="btn btn-block btn-info">Items Toevoegen</a>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Contact Details</h4>
                    <form method="post" action="cartAction.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Voor Naam</label>
                                <input id="name" type="text" class="form-control" name="first_name" value="<?php echo !empty($postData['first_name'])?$postData['first_name']:''; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Achter Naam</label>
                                <input type="text" class="form-control" name="last_name" value="<?php echo !empty($postData['last_name'])?$postData['last_name']:''; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Telefoon Nr.</label>
                            <input id="phone" type="text" class="form-control" name="phone" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Adres</label>
                            <input id="address" type="text" class="form-control" name="address" value="<?php echo !empty($postData['address'])?$postData['address']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="branch">Branch</label>
                            <select id="branch" type="text" class="form-control" name="branch" value="<?php echo !empty($postData['branch'])?$postData['branch']:''; ?>" required>
                            <option value="none">Kies de branch</option>
                            <option value="amsterdam" style= color:black>Amsterdam</option>
    <option value="rotterdam" style= color:black>Rotterdam</option>
    <option value="utrecht" style= color:black>Utrecht</option>
  </select>
                        </div>
                        <input type="hidden" name="action" value="placeOrder"/>
                        <input class="btn btn-success btn-lg btn-block" type="submit" onclick="sendEmail()" name="checkoutSubmit" value="Bestel Nu">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>