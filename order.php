<?php
session_start();
if(!isset($_SESSION['id']))header('Location: ./login.php');
$uid = $_SESSION['id'];
		
include 'connections/settings.php';
include 'connections/dbh.php';


if(!isset($_REQUEST['order_id']))header('Location: ./orders.php');
$oid = $_REQUEST['order_id'];

	
$pdo = new mypdo();
$menus = $pdo->get_menus("SELECT a.*, b.* FROM order_items a LEFT JOIN menus b ON a.menu_id = b.id WHERE a.order_id = ".$oid);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="order.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Order - BH Bags</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    </head>
    <body style = "background-image:  url(image/kuku.jpg)">
        <header class="max-width">
            <br></br><br></br><br></br><br></br>
            <nav>
                <br><br><center><a href="index.php" class="logo"><img src="image/logo.png" width="50" height="50"></img> </a></center>
             <center><br><br>   
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="review.php">Review</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo (@count($_SESSION['carts']) != 0)? '<b class="cart_cnt">'. @count($_SESSION['carts']). '</b>' : ''; ?></a></li>
                 <?php 
                if(isset($_SESSION['id'])) { ?>
                 <li><a class="user_name" style = "color:white;" href="orders.php">  <?php echo $_SESSION['username']; ?>  | Orders</a></li>
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
            <table class = "table_m">
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
                            <img src="image/<?php echo $menu['image_url']; ?>">
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
                    <td style="background-color:#154360;color:white;">Subtotal</td>
                    <td style="background-color:darkgray;">RM <?php echo  number_format($sub_total, 2); ?></td>
                </tr>
                <tr>
                    <td style="background-color:#154360;color:white;">Tax <small> (5%) </small></td>
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
            <div class="row">
                
                <div class="column">
                    <h2>Contact Us</h2><br></br>
                  <p><i class="fas fa-phone"></i>&nbsp;&nbsp;&nbsp;+6014-6155950</p>
                  <p><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;bahrunhazwani55@gmail.com</p>
                  <p><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;No.26, Jalan Cempaka 32, Taman Cempaka, Senawang,</p>
                  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;70450 Seremban, Negeri Sembilan.</p>
                </div>
                <div class="column3" style="text-align: center;">
                <?php 
                if(!isset($_SESSION['id'])) { ?>
                    <h2 style="font-weight: bold;font-size: 20px; color: #E59866;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Please Login here :)</h2><br></br><form action="./login.php" method="post">
                        <input type="text" placeholder="Username" name="username" style= "width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;"><br>
                        <input type="password" placeholder="Password" name="password" style= "width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;"><input type="hidden"  name="login" value="n">
                        <br><br><center><button type="submit" style="background-color: #f37335;border: none;color: white;padding: 10px 27px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;font-family: Trebuchet MS, sans-serif;margin: 4px 2px;cursor: pointer; font-weight: bold; width:30%;  cursor: pointer;outline: none;border-radius: 15px;">Login</button></center>
                    </form>
                        <br></br><br></br><br><br>
                        <h3 style="font-weight: bold;font-size: 20px; color: #E59866;font-family: Trebuchet MS, sans-serif;font-size: 20px;">New Customer! Please Register Here :)</h3><br></br>
                    <div class="signup">
                        <a href="signup.php" style="background-color: #f37335;border: none;color: white;padding: 10px 27px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;font-family: Trebuchet MS, sans-serif;margin: 4px 2px;cursor: pointer; font-weight: bold; width:50%;  cursor: pointer;outline: none;border-radius: 15px;float: right;">Sign Up</a>
                    </div> <br><br> <br><br>
                  <?php } else { ?>
                    
                    <br></br><p style="text-align:center"><i>You are  logged  in</i></p><br></br><br></br><br></br><br></br><br></br>
                    
                <?php } ?>                   
                </div>                
            </div>
                <span></span>
                <p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        <br><br>
        <script src="js/main.js"></script></footer>
    </body>
</html>