<?php
session_start();
if(!isset($_SESSION['aid']))header('Location: ./');

		
include '../connections/settings.php';
include '../connections/dbh.php';


if(!isset($_REQUEST['order_id']))header('Location: ./orders.php');
$oid = $_REQUEST['order_id'];

	
$pdo = new mypdo();
$menus = $pdo->get_menus("SELECT a.*, b.* FROM order_items a LEFT JOIN menus b ON a.menu_id = b.id WHERE a.order_id = ".$oid);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="orderadmin.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Order - BH Bags</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    </head>
     <body style = "background-image:  url(../image/kuku.jpg)">
        <header class="max-width">
            <br></br><br></br><br></br><br></br>
            <nav>
                <br><br><center><a href="../index.php" class="logo"><img src="../image/logo.png" width="50" height="50"></img></a></center>

             <center><br><br>     
            <ul>
               <?php if(!isset($_SESSION['aid'])){ ?>
                
                
                <?php }else{ ?>
                
                 <li><a href="index.php">Home</a></li>
                <li><a href="contact_messages.php">Contact Messages</a></li>
                <li><a href="sales_report.php">Sales Report</a></li>
                <li><a href="menu.php">Bags Menu</a></li>
                <li><a class="user_name" style = "color:white;"> <?php echo $_SESSION['ausername']; ?></a></li>
                 <li><a href="logout.php">Logout</a></li>
                
                <?php } ?>
            </ul></center>
        </nav>
        </header>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br><br></br><br></br><br></br>
        
        
        
        <!----------------------------------------------------------------- Cart item------------------------------------------------------------------>
       
        <div class="small-container cart-page">
            <table class="table_m">
                <tr>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Menu</th>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Price</th>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Quantity</th>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Subtotal</th>
                </tr>
                <?php 
				$sub_total = 0.00;
				foreach($menus as $menu){ 
				 	
					$sub_price =  $menu['price'] * $menu['quantity'];
					$sub_total += $sub_price;
				?>
                <tr class="product_item">
                    <td style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">
                        <div class="cart-info">
                            <img src="../image/<?php echo $menu['image_url']; ?>">
                            <div>
                            <p><?php echo $menu['name']; ?></p>
                            <small>Price: RM <?php echo $menu['price']; ?></small>
                            <br><br>
                            </div>
                        </div>
                    </td>
                    <td style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">RM <?php echo $menu['price']; ?></td>
                    <td style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;"><?php echo $menu['quantity']; ?></td>
                    <td style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">RM <?php echo number_format($sub_price, 2); ?></td>
                </tr>
                <?php } 
				
				$total_tax = $sub_total *  5 / 100;
				$all_total = $total_tax + $sub_total;
				?>
                
            </table>
        </div>
       
        <!----------------------------------------------------------------- Cart billing------------------------------------------------------------------>
        <div class="total-price">
            <table class = "table_m" style = "font-family: Trebuchet MS, sans-serif;">
                <tr>
                    <td  style="background-color:#154360;color:white;">Subtotal</td>
                    <td style="background-color:darkgray;">RM <?php echo  number_format($sub_total, 2); ?></td>
                </tr>
                <tr>
                    <td  style="background-color:#154360;color:white;">Tax <small> (5%) </small></td>
                    <td style="background-color:darkgray;">RM <?php echo number_format($total_tax, 2); ?></td>
                </tr>
                <tr>
                    <td  style="background-color:#154360;color:white;">Total</td>
                    <td style="background-color:darkgray;"><b>RM <?php echo number_format($all_total, 2); ?></b></td>
                </tr>
            </table>
        </div>
         
        <br></br><br></br><br></br>
       
        <footer>
                <p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        
    <script src="js/main.js"></script></footer>
    </body>
</html>

