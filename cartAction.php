<?php 
// Initialize shopping cart class 
require_once 'Cart.class.php'; 
$cart = new Cart; 
 
// Include the database config file 
require_once 'dbConfig.php'; 
 
// Default redirect page 
$redirectLoc = 'index.php'; 
 
// Process request based on the specified action 
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        $productID = $_REQUEST['id']; 
         
        // Get product details 
        $query = $db->query("SELECT * FROM products WHERE id = ".$productID); 
        // $row = $query->fetch_assoc();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $itemData = array( 
            'id' => $row['id'], 
            'name' => $row['name'], 
            'price' => $row['price'], 
            'qty' => 1 
        ); 
         
        // Insert item to cart 
        $insertItem = $cart->insert($itemData); 
         
        // Redirect to cart page 
        $redirectLoc = $insertItem?'viewCart.php':'index.php'; 
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){ 
        // Update item data in cart 
        $itemData = array( 
            'rowid' => $_REQUEST['id'], 
            'qty' => $_REQUEST['qty'] 
        ); 
        $updateItem = $cart->update($itemData); 
         
        // Return status 
        echo $updateItem?'ok':'err';die; 
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){ 
        // Remove item from cart 
        $deleteItem = $cart->remove($_REQUEST['id']); 
         
        // Redirect to cart page 
        $redirectLoc = 'viewCart.php'; 
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){ 
        $redirectLoc = 'checkout.php'; 
         
        // Store post data 
        $_SESSION['postData'] = $_POST; 
     
        $first_name = strip_tags($_POST['first_name']); 
        $last_name = strip_tags($_POST['last_name']); 
        $email = strip_tags($_POST['email']); 
        $phone = strip_tags($_POST['phone']); 
        $address = strip_tags($_POST['address']); 
         
        $errorMsg = ''; 
        if(empty($first_name)){ 
            $errorMsg .= 'Please enter your first name.<br/>'; 
        } 
        if(empty($last_name)){ 
            $errorMsg .= 'Please enter your last name.<br/>'; 
        } 
        if(empty($email)){ 
            $errorMsg .= 'Please enter your email address.<br/>'; 
        } 
        if(empty($phone)){ 
            $errorMsg .= 'Please enter your phone number.<br/>'; 
        } 
        if(empty($address)){ 
            $errorMsg .= 'Please enter your address.<br/>'; 
        } 
         
        if(empty($errorMsg)){ 
            // Insert customer data in the database 
            $insertCust = ("INSERT INTO customers (first_name, last_name, email, phone, address) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$phone."', '".$address."')"); 
            $stmt= $db->prepare($insertCust);
            $stmt->execute([":first_name"=>$first_name,":last_name"=>$last_name, ":email"=>$email,":phone"=>$phone,":address"=> $address]); 
            if($insertCust){ 
                $custID = $db->lastInsertId();
                
                 $date=date('Y-m-d H:i:s');
                // Insert order info in the database 
                $insertOrder = ("INSERT INTO orders (customer_id, grand_total, created, status) VALUES ('".$custID."', '".$cart->total()."','".$date."', 'Pending')"); 
                $stmt= $db->prepare($insertOrder);
                $stmt->execute([":customer_id"=>$custID,":grand_total"=>$cart->total(),":created"=>$date,":status"=> 'Pending']); 
                
                if($insertOrder){ 
                    $orderID = $db->lastInsertId(); 
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents(); 
                     
                    // Prepare SQL to insert order items 
                      $sql = ''; 
                    foreach($cartItems as $item){ 
                        $sql = ("INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."')"); 
                        
                        $stmt= $db->prepare($sql);
                        $stmt->execute([":order_id"=>$orderID,":product_id"=>$item['id'], ":quantity"=>$item['qty'],]);
                        // $result = $stmt->rowCount();
                    } 
                     
                    // Insert order items in the database 
                    //  $insertOrderItems = $db->query($stmt);
                     
                   
                    if($stmt->rowCount()> 0){ 
                    //     // Remove all items from cart 
                        $cart->destroy(); 
                    
                        //exit("<h1>dit is even een eindpunt NA destroy</h1>");
                        // header("location: orderSuccess.php?id=".$orderID);
                        header("location: makepdf.php?id=".$orderID);
                        
                        // Redirect to the status page ????!!!!!!!!!!
                        //$redirectLoc = 'orderSuccess.php?id='.$orderID;
                        
                        exit();
                    }else{ 
                        $sessData['status']['type'] = 'error'; 
                        $sessData['status']['msg'] = 'Some problem occurred, please try again 1.'; 
                    } 
                }else{ 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Some problem occurred, please try again 2.'; 
                } 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again 3.'; 
            } 
        }else{ 
            $sessData['status']['type'] = 'error'; 
            $sessData['status']['msg'] = 'Please fill all the mandatory fields.<br>'.$errorMsg;  
        } 
        $_SESSION['sessData'] = $sessData; 
    } 

}
// Redirect to the specific page 
header("Location: $redirectLoc"); 

exit();


