<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/vendor/autoload.php';
require_once 'dbConfig.php'; 

// Fetch order details from database 
//$sql = "SELECT r.*, c.first_name, c.last_name, c.email, c.phone, c.address FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id WHERE r.id = :rid"; //.$_REQUEST['id']; 
$sql = "SELECT r.*, ri.product_id, ri.quantity,c.first_name, c.last_name, c.email, c.phone, c.address,p.name FROM orders as r LEFT JOIN order_items as ri ON r.id = ri.order_id  
LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN products as p ON p.id = ri.product_id WHERE r.id = :rid";
$stmt= $db->prepare($sql);
$stmt->execute([":rid" => $_REQUEST['id']]); 

$orderInfo = $stmt->fetchAll() ;
 var_dump ($orderInfo);
                        // to make a pdf reciept
                        
                        $mpdf = new \Mpdf\Mpdf();
                        
                       

                        $data = '';

                        $data .= '<h1>Bestelling Gegevens</h1>';
                        $data .= '<p><b>Koop ID:</b>'. $orderInfo[0]['id'].'</p>';
                        $data .= '<p><b>Naam:</b>'.  $orderInfo[0]['first_name'].' '.$orderInfo[0]['last_name'].'</p>';
                        $data .= '<p><b>Email:</b>'. $orderInfo[0]['email'].'</p>';
                        $data .= '<p><b>Telefoon Nr.:</b>'.$orderInfo[0]['phone'].'</p>';
                        $data .= '<p><b>Adres:</b>'.$orderInfo[0]['address'].'</p>';
                        $data .= '<p><b>Geplaatst OP:</b>'.$orderInfo[0]['created'].'</p>';
                        $data .= '<p><b>Pizza:</b>'.$orderInfo[0]['name'].'</p>';
                        $data .= '<p><b>Aantal Pizzas:</b>'.$orderInfo[0]['quantity'].'</p>';
                        $data .= '<p><b>Totaal:</b>'.'€'.$orderInfo[0]['grand_total'].' EUR'.'</p>';
                        

                        $mpdf->WriteHtml($data);

                       $pdf= $mpdf->Output('', 'S');
                        

// to get the Information inside an array to show it in the email
                    $enquirydata = [

                              'id' => $orderInfo[0]['id'],
                              'grand_total'=> $orderInfo[0]['grand_total'],
                              'created'=> $orderInfo[0]['created'],
                              'first_name'=> $orderInfo[0]['first_name'],
                             'email' => $orderInfo[0]['email'],
                             'phone' => $orderInfo[0]['phone'],
                             'address' => $orderInfo[0]['address']

                        ];

                        sendEmail($pdf, $enquirydata);



                        
                        function sendEmail($pdf, $enquirydata)
                        {
                            $mail = new PHPMailer(true);

                            try {
                                //Server settings
                                $mail->SMTPDebug = false;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'sopranos.pizza@outlook.com';                     //SMTP username
                                $mail->Password   = 'sopranospizza2021';                               //SMTP password
                                $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
                                //Recipients
                                $mail->setFrom('sopranos.pizza@outlook.com', 'Nieuw Bestelling');
                                $mail->addAddress($enquirydata['email'], $enquirydata['first_name']);     //Add a recipient
                                $mail->addBCC('sopranos.pizza@outlook.com');
                            //attachment
                                $mail->addStringAttachment($pdf, 'bon.pdf');
                               
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'Sopranos Pizza Nieuw Bestelling';
                                $mail->Body    = 'U kunt uw betalingsbewijs zien in de <b> Bijlagen </b>';
                                $mail->AltBody = 'U kunt uw betalingsbewijs zien in de Bijlagen';
                            
                                $mail->send();
                                echo 'Message has been sent';

                                header("location: Thanks.php");


                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        }
                        
                        ?>