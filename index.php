<?php
session_start();

include 'connections/settings.php';
include 'connections/dbh.php';


$pdo = new mypdo();

$menus =  $pdo->get_menus("SELECT * FROM menus   ORDER BY class DESC LIMIT 3"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="home.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Home - BH Bags</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    </head>
    <body style = "background-image:  url(image/kuku.jpg) ">
        
        
       
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
                <center><p class="title" style = "color: #FFEBCD;font-size: 35px; background-color:#29465B;border: 7px dotted #FFEBCD; width:17%;">
                    BH BAGS</p></center>
                
            </div>
        </div>
      
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
        <br></br><br></br>
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1"></input>
                <input type="radio" name="radio-btn" id="radio2"></input>
                <input type="radio" name="radio-btn" id="radio3"></input>
                <input type="radio" name="radio-btn" id="radio4"></input>
                
                <div class="slide first">
                    <img src="image/home1.jpg" alt=""></img>
                </div>
                <div class="slide">
                    <img src="image/home2.jpg" alt=""></img>
                </div>
                <div class="slide">
                    <img src="image/home3.jpg" alt=""></img>                   
                </div>
                <div class="slide">
                    <img src="image/home4.jpg" alt=""></img>                  
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
            </div>
        
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>
        <br></br>
        <script type="text/javascript">
            var counter = 1;
            setInterval(function(){
                document.getElementById('radio' + counter).checked = true;
                counter++;
                if(counter > 4){
                    counter = 1;
                }
            }, 5000);
            </script>
        
        <br></br><br></br>
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    NEW ARRIVALS</h2>
                
            </div>
        </div>
        <section class="section-best">
            <div class="container-best"> 
                <main class="best">
                
                <?php foreach($menus as $menu){  ?>
                <div class="card" id="menu_<?php echo $menu['id']; ?>">
                    <img src="image/<?php echo $menu['image_url']; ?>"></img>                  
                    <div class="blogcontent"><br></br>
                        <h4><?php echo $menu['name']; ?></h4>
                        <p class="price" style="color:gold;" >RM <?php echo $menu['price']; ?></p>
                        <p class="desc"><?php echo $menu['desc_n']; ?></p>
                        <?php if(isset($_SESSION['carts'][$menu["id"]])){ ?>
					 		<a href="cart.php" class="added"><small><?php echo $_SESSION['carts'][$menu["id"]]; ?> item(s) added.</small>  Checkout Now</a>
						 <?php } else{ ?>
                         	<form action="connections/main.php" method="post"><input type="hidden" name="ch" value="add_cart"><input type="hidden" name="link" value="index.php"><input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"><button class="btn btn_n"> Add to cart</button></form>
                          <?php } ?>
                        
                        
                         
                    </div>
                </div>
                <?php }  ?>
                
                </main>
            </div>    
            </section>
        
            <section id="mission">
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <br><br><br><br><br><br><br>
			<h2>WHY BAGS ARE IMPORTANT?</h2>
                        <br></br>
			<div style="font-size:18px;color:#E59866;font-family: Trebuchet MS, sans-serif;font-weight: bold;">After dresses, the next most popular accessory, which can be the armament of your fashion, is nothing other than designer bags. Bags are thus, more than just carrying essential items, as you can even use them for your fashion needs. Fortunately, you can find a number of beautiful bags in our BH Bags Store</div>
		</div>
            </div>
            </div>
            </section>
            
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