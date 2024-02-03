<?php
session_start();
if(!isset($_SESSION['id']))header('Location: ./login.php?extra="pm"');
$uid = $_SESSION['id'];
		
include 'connections/settings.php';
include 'connections/dbh.php';

if(isset($_POST['state']) && isset($_POST['fname'])){
	
	$fname = $_POST['fname'];
	$address = $_POST['address'];
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);	
	$email = $_POST['email'];
	
	$billing_address = $address.', '.$city.', '.$state.', '.$zip;
	
	$carts = $_SESSION['carts'];
	$m_ids = array();
	foreach($carts as $key => $vals)
		$m_ids[] = $key;
		
	$pdo = new mypdo();
	$menus = $pdo->get_menus("SELECT * FROM menus WHERE id IN (".implode(',', $m_ids). " )");
	
	$amount = 0;
	foreach($menus as $menu){
		$amount += ($menu['price'] *  $carts[$menu['id']]);
	}
	
	// Tax inclusion
	$amount = $amount + ($amount * 5/100); 
	
	$order_id = $pdo->new_order($uid, $fname, $email,  $billing_address,  $amount,  date('Y-m-d H:i:s'));
	
	foreach($carts as $key => $vals)
		$pdo->new_order_items($order_id, $key, $vals);
		
	unset($_SESSION['carts']);
	
	header('Location: completed_order.php');
	
}




if(isset($_SESSION['carts']))
	$carts = $_SESSION['carts'];
else
	$carts = array();
$m_ids = array();

foreach($carts as $key => $vals)
	$m_ids[] = $key;
	
if(count($m_ids) != 0){
	$pdo = new mypdo();
	$menus = $pdo->get_menus("SELECT * FROM menus WHERE id IN (".implode(',', $m_ids). " )");


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="payment.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Payment - BH Bags</title>
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
                <li><a href="menu.php">Bags Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="review.php">Review</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo (@count($_SESSION['carts']) != 0)? '<b class="cart_cnt">'. @count($_SESSION['carts']). '</b>' : ''; ?></a></li>
                 <?php 
                if(isset($_SESSION['id'])) { ?>
                 <li><a class="user_name"  style = "color:white;" href="orders.php">  <?php echo $_SESSION['username']; ?>  | Orders</a></li>
                 <li><a href="logout.php">Logout</a></li>
                <?php } ?>
            </ul></center>
        </nav>
        </header>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br><br></br><br></br><br></br>
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    PAYMENT</h2>

            </div>
        </div>
        
        <div class="row-checkout">
            <div class="col-75">
              <div class="container">
                <form action="" method="post">

                  <div class="row-checkout">
                    <div class="col-50"><br><br>
                      <h3>Billing Address</h3><br>
                      <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                      <input type="text" id="fname" name="fname" placeholder="Full Name" required pattern="[a-zA-Z0-9 ]{4,}"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                      <label for="email"><i class="fa fa-envelope"></i> Email</label>
                      <input type="text" id="email" name="email" placeholder="email@example.com"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                      <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                      <input type="text" id="adr" name="address" placeholder="Adress" style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;"required>
                      <label for="city"><i class="fa fa-institution"></i> City</label>
                      <input type="text" id="city" name="city" placeholder="New YorkCity" style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;"required>

                      <div class="row-checkout">
                        <div class="col-50">
                          <label for="state">State</label>
                          <input type="text" id="state" name="state" placeholder="State"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;" required>
                        </div>
                        <div class="col-50">
                          <label for="zip">Zip</label>
                          <input type="text" id="zip" name="zip" placeholder="20002"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;" required>
                        </div>
                      </div>
                    </div>

                    <div class="col-50"><br><br>
                      <h3>Payment</h3><br>
                      <label for="fname">Accepted Cards</label>
                      <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:#E59866;"></i>
                      </div>
                      <label for="cname">Name on Card</label>
                      <input type="text" id="cname" name="cardname" placeholder="Name" required pattern="[a-zA-Z0-9 ]{4,}"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                      <label for="ccnum">Credit card number</label>
                      <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required pattern="[0-9-]{12,}"style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                      <div class="row-checkout">
                      <div class="col-30">
                       <label for="expmonth">Exp Month</label>
                      <select required style="width:100px; height:40px;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                          	<option></option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sept</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                          </select>
                        </div>
                        <div class="col-30" style="margin:0px 5px;">
                          <label for="expyear">Exp Year</label>
                          <select required style="width:100px; height:40px;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                          	<option></option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                          </select>
                        </div>
                        <div class="col-30">
                          <label for="cvv">CVV</label>
                          <input type="text" id="cvv" name="cvv" placeholder="786" required pattern="[0-9]{2,3}"  style="width:100px; height:40px;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;">
                        </div>
                      </div>
                    </div>

                  </div>
                  <div style="text-align:right">
                  <input type="submit" value="Continue to checkout" class="btn" style="max-width:200px;">
                 </div>
                </form>
              </div>
            </div>
            <div class="col-25">
              <div class="container">
                <h4>Cart <span class="price" style="color:black"> </span></h4>
                <table class = "table_m" style="border-collapse:collapse">
                <tr>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Menu</th>
                    <th style = "background-color:#A04000;font-family: Trebuchet MS, sans-serif;">Subtotal</th>
                </tr>
                <?php 
				$sub_total = 0.00;
				foreach($menus as $menu){ 
				 	
					$sub_price =  $menu['price'] * $carts[$menu['id']];
					$sub_total += $sub_price;
				?>
                <tr>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">
                 		<?php echo $menu['name']; ?>
                    </td>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;" class="sub_price">RM <?php echo number_format($sub_price, 2); ?></td>
                </tr>
                <?php } 
				
				$total_tax = $sub_total *  5 / 100;
				$all_total = $total_tax + $sub_total;
				?>
                <tr>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">
                 		Tax:
                    </td>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;">RM <?php echo number_format($total_tax, 2); ?></td>
                </tr>
                <tr>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;font-weight: bold;">
                 		Total:
                    </td>
                    <td  style = "background-color:#E59866;font-family: Trebuchet MS, sans-serif;font-weight:bold;">RM <?php echo number_format($all_total, 2); ?></td>
                </tr>
                
            </table>
                </hr>
              </div>
            </div>
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


