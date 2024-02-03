<?php
session_start();

include 'connections/settings.php';
include 'connections/dbh.php';


if(isset($_POST['fname']) && isset($_POST['email'])){
	
	$pdo = new mypdo();
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	$pdo->add_contact($fname, $email, $subject, $message);
	
	die(header('Location: contact.php?msg=success'));
	
}




?>






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="contact.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Home - Contact Us</title>
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
        <br></br><br></br><br></br><br></br><br></br>
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    CONTACT US</h2>
               
            </div>
        </div>
       
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br>
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'){ ?>
                	<p style="padding:10px; text-align:center; font-size:24px; color:#0C9"> Thank You for contacting us. We will get back to you as soon as possible.</p>
                <?php } ?>
        <div class="contact-wrap">
            <div class="contact-in">
                <h1>Contact Info</h1>
                <h2><i class="fa fa-phone" aria-hidden="true"></i>Phone</h2>
                <p>+6014-6155950</p>
                <h2><i class="fa fa-envelope" aria-hidden="true"></i>Email</h2>
                <p>bahrunhazwani@gmail.com</p>
                <h2><i class="fa fa-map-marker" aria-hidden="true"></i>Address</h2>
                <p>No.26, Jalan Cempaka 32, Taman Cempaka, Senawang, Seremban</p>
                <ul>
                    <li><a href="https://www.facebook.com/hazu.hazu.7712" target="blank"><img src="image/f.jpg" style="width:50px;height:50px;display:inline;"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><a href="https://www.instagram.com/a.bahrun_hazwani/" target="blank"><img src="image/ig.jpg" style="width:50px;height:50px;display:inline;"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><a href="https://twitter.com/_hazuu_" target="blank"><img src="image/t.jpg" style="width:50px;height:50px;display:inline;"></i></a></li>
                </ul>
            </div>
            
            <div class="contact-in">
            	<h1>Send A Message</h1>
                <form method="post" action="">
                    <input type="text" placeholder="Full Name" name="fname"  style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;" required minlength="3" class="contact-in-input"></input>
                    <input type="text" placeholder="E-mail" name="email"  minlength="6" class="contact-in-input"  style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;" ></input>
                    <input type="text" placeholder="Subject" name="subject" required minlength="3" class="contact-in-input"  style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;"></input>
                    <textarea placeholder="Message" class="contact-in-textarea" required minlength="3" name="message"  style= "width: 100%;padding: 5px 20px;margin: 8px 0;border: 1px solid black;background-color:#FBEEE6;font-weight: bold;font-size: 17px;"></textarea>
                    <input type="submit" value="SUBMIT" class="contact-in-btn"></input>
                </form>
            </div>
            <div class="contact-in">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.3663422421755!2d101.981231314575!3d2.706935898027928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cde0b2623c2375%3A0xeb53722d6147abd!2s26%2C%20Jalan%20Cempaka%2032%2C%20Taman%20Seri%20Pagi%2C%2070450%20Seremban%2C%20Negeri%20Sembilan!5e0!3m2!1sen!2smy!4v1627883666638!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            </div>
        </div>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
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