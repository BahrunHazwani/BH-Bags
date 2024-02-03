<?php
session_start();

if(isset($_SESSION['id'])) header('Location: ./');

include 'connections/settings.php';
include 'connections/dbh.php';


$signup_error = '';

if(isset($_POST['email']) && isset($_POST['password'])){
	
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);	
	$password2 = trim($_POST['password2']);	
	
	$pdo = new mypdo();
	$check1 = $pdo->get_one("SELECT * FROM  users WHERE email = ?", $email);
	
	if($password == "" || $password != $password2){
		$signup_error = "Password not match";
	}
	
	elseif($check1 != null){
			$signup_error =  'Email already taken';
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		 $signup_error = "Please provide a valid email address";
	}
	else{
		
		$pwd = password_hash($password, PASSWORD_DEFAULT);
		$status = $pdo->new_user($email, $pwd);
		if($status){
			header("Location: signup.php?success_reg");
		}
		else{
			
			$signup_error = "Registration not successful. Database Error";
			
			}	
		
	}
	
}

$pdo = new mypdo();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="signup.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Sign Up - BH Bags</title>
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
        
        <center><div class="signup" >
         <?php if(isset($_GET['success_reg'])) echo '<p class="reg_success">You have successfully Signed up. <br><br><a href="./login.php">Login</a></p>'; ?>
             <p class="msg_error"><?php echo $signup_error; ?></p>
            
          <form class="modal-content" action="" method="post">
            <div class="container">
              <h1 style=" color: white;font-family: Trebuchet MS, sans-serif;text-align:center;">Sign Up</h1>

              <hr>
              <label for="email" style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" value="<?php echo @$email; ?>" style= "width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" required=""></input>

              <label for="psw"  style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" style= "width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" required=""></input>

              <label for="psw-repeat"  style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;"><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat Password" name="password2" style= "width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" required=""></input>


              <label  style="font-weight: bold; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 18px"><input type="checkbox" required> I accept the Terms of Use &amp; Privacy Policy</label>
              </hr>

              <div class="clearfix">
                <button type="submit" class="btn" style="margin-top: 0.8cm;">Sign Up</button>
              </div>
            </div>
          </form>
        </div></center>
        <br><br>
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