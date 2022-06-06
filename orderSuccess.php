<?php 


        
// if(!isset($_REQUEST['id'])){ 
//     header("location: index.php"); 
// } 
 
// Include the database config file 
require_once 'dbConfig.php'; 
 
// Fetch order details from database 
$sql = "SELECT r.*, c.first_name, c.last_name, c.email, c.phone FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id WHERE r.id = :rid"; //.$_REQUEST['id']; 
$stmt= $db->prepare($sql);
$stmt->execute([":rid" => $_REQUEST['id']]); 

$orderInfo = $stmt->fetchAll() ;
// echo "<pre>".print_r($orderInfo, true). "</pre>";
// exit("<h1>einde voor dit moment</h1>");

if(sizeof($orderInfo) == 0){ 
    // $orderInfo = $stmt->fetchAll(PDO::FETCH_ASSOC); 
// }else{ 
    header("Location: index.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Order Status Shopping Cart</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css1/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>ORDER STATUS</h1>
    <div class="col-12">
        <?php if(!empty($orderInfo)){ ?>
            <div class="col-md-12">
                <div class="alert alert-success">Your order has been placed successfully.</div>
            </div>
            <?php
            // to do test with the below code 
			//echo "<pre>".print_r($orderInfo, true)."</pre>";
            //exit("<h1>einde in !empty</h1>");
            ?>
            <!-- Order status & shipping info -->
            <div class="row col-lg-12 ord-addr-info">
                <div class="hdr">Order Info</div>
                <p><b>Reference ID:</b> #<?php echo $orderInfo[0]['id']; ?></p>
                <p><b>Total:</b> <?php echo '€'.$orderInfo[0]['grand_total'].' EUR'; ?></p>
                <p><b>Placed On:</b> <?php echo $orderInfo[0]['created']; ?></p>
                <p><b>Buyer Name:</b> <?php echo $orderInfo[0]['first_name'].' '.$orderInfo[0]['last_name']; ?></p>
                <p><b>Email:</b> <?php echo $orderInfo[0]['email']; ?></p>
                <p><b>Phone:</b> <?php echo $orderInfo[0]['phone']; ?></p>
            </div>
			
            <!-- Order items -->
            <div class="row col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Get order items from the database 
                        $sql = "SELECT i.*, p.name, p.price FROM order_items as i LEFT JOIN products as p ON p.id = i.product_id WHERE i.order_id = :oid"; //.$orderInfo['id']); 
                        $stmt= $db->prepare($sql);
                        $stmt->execute([":oid" => $orderInfo[0]['id']]); 
                        
                        
                        // if($stmt->num_rows > 0){  
                            // while($item = $result->fetch_assoc()){ 
                            while($item = $stmt->fetch(PDO::FETCH_OBJ)) {  
                                 $price = $item->price;
                                //  ["price"]; 
                                 $quantity = $item-> quantity;
                                //  ["quantity"]; ["name"]
                                 $sub_total = ($price*$quantity); 
                        ?>
                        <!-- <form action="makepdf.php" method="POST"> -->
                        <tr>
                            <td><?php 
                            echo $item->name; ?></td>
                            <td><?php 
                            echo '€'.$price.' EUR'; ?></td>
                            <td><?php 
                            echo $quantity; ?></td>
                            <td><?php 
                            echo '€'.$sub_total.' EUR'; ?></td>
                        </tr>
                       
                        <!-- </form> -->
                        <?php } 
                        header("location: makepdf.php?id=".$orderID);
                         ?>
                    </tbody>
                </table>
                

            </div>
        <?php } else { ?>
        <div class="col-md-12">
            <div class="alert alert-danger">Your order submission failed.</div>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>