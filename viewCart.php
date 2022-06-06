<?php 
// Initialize shopping cart class 
include_once 'Cart.class.php'; 
$cart = new Cart; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Winkelmandje</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
<link href="css/font_style.css" rel="stylesheet">

<!-- jQuery library -->
<script src="js1/jquery-3.5.1.min.js"></script>

<script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Het bijwerken van de winkelwagen is mislukt, probeer het opnieuw.');
        }
    });
}
</script>
</head>
<body>
<div class="container">
    <h1>Winkelmandje</h1>
    <div class="row">
        <div class="cart">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="45%">Product</th>
                                <th width="10%">Prijs</th>
                                <th width="15%">Aantal</th>
                                <th class="text-right" width="20%">Totaal</th>
                                <th width="10%"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $car =0;
                            $car2 =0;
                            $car3 =0;
                            
                            
                            if($cart->total_items() > 0){ 
                                // Get cart items from session 
                                $cartItems = $cart->contents(); 
                                foreach($cartItems as $item){ 
                            ?>
                            <tr>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo '€'.$item["price"].' EUR'; ?></td>
                                <td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item[ "rowid" ] ?>')"></td>
                                <td class="text-right"><?php 
                                //korting op elke 2de pizza 
                                if($item["qty"]==1){ $discount= $item["subtotal"];
                                    $car = $car + $discount;
                                    echo '€'.$discount.' EUR'; }elseif($item["qty"] % 2 == 0){
                                    $discount2 = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]/2);
                                    $car2 = $car2 + $discount2;
                                  echo '€'.$discount2;} elseif($item["qty"] % 2 != 0){
                                    $discount3 = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]-1)/2;
                                    $car3 = $car3 + $discount3;
                                  echo '€'.$discount3;}
                                 
                                  
                                
                                  ?></td>
                                  
                                <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Bent u zeker?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;"><i class="itrash"></i> </button> </td>
                            </tr>
                            <?php } }else{ ?>
                            <tr><td colspan="5"><p>Uw winkelmandje is leeg.....</p></td>
                            <?php } ?>
                            <?php if($cart->total_items() > 0){ 
                                ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Totaal</strong></td>
                                <td class="text-right"><strong><?php 
                                
                                $cars = $car + $car2 + $car3 ;
                                echo '€'.$cars.' EUR';
                                
                           
                                // if($item["qty"]==1){echo '€'.$item["subtotal"].' EUR'; }elseif($item["qty"] % 2 == 0){
                                    // $discount = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]/2);
                                //   echo '€'.$discount;} elseif($item["qty"] % 2 != 0){
                                    // $discounted = $item["subtotal"]-($item["price"]*50)/100 * ($item["qty"]-1)/2;
                                //   echo '€'.$discounted;} 
                                ?></strong></td>
                                <td></td>
                            </tr>
                                <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="index.php" class="btn btn-block btn-light">Doorgaan winkelen</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <?php if($cart->total_items() > 0){ ?>
                        <a href="checkout.php" class="btn btn-lg btn-block btn-primary">Checkout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>