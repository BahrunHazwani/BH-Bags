<?php
session_start();



include '../connections/settings.php';


$log_error = '';

$active_det = '';

if(isset($_POST['login'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($password == '#Admin123' && $username == 'Admin'){
		$_SESSION['aid'] = 1;
		$_SESSION['ausername'] = 'Admin';
		header('Location: contact_messages.php');
		exit();
	}
	else{
		
		$log_error = "Please enter a valid Login details";
		}

		
	 
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="adminhome.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Admin Login - BH Bags</title>
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
       
        <br></br><br></br><br></br>
        
        <div class="title" id="title">
           <?php if(!isset($_SESSION['aid'])){ ?>
            <div class="max-width">
                <h2 class="title">
                   Admin Login
                </h2>
                </div>
            </div>
            <?php } ?>
        </div>
        <br></br>
        
        <section class="section-menu">
            <div class="container-menu"> 
            <?php
           if(!isset($_SESSION['aid'])){ ?>
           
            <p class="msg_error"><?php echo $log_error; ?></p>
            <center>
                <form  class="modal-content" method="post" action="">
                <div class="my_form1">
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Username</label><br>
                        <input type="hidden" name="login"  value="m"  />
                        <input required minlength="3" name="username"  style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" value="<?php echo @$username; ?>" placeholder= "Username"/><br>
                    </div>
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Password</label><br>
                        <input type="password" required  name="password" style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px; " placeholder= "Password"/><br>
                    </div>
                    <div>
                        <center><button class="btn"> Login </button></center>
                    </div>
                </div>
                </form></center>
              <br><br><br><br>
            <?php }
				else{
			?>
         		<p style="text-align:center; font-size:24px;; padding:100px;color:gold;font-family: Trebuchet MS, sans-serif;"> You are logged in</p><br /><br /><br />   
            
            <?php 
				}
			?>
              
              </div>
                
                
                                
            </div>
            </div>
        </section>
        <br><br><br><br>
        <footer>
        		<p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        
    <script src="js/main.js"></script></footer>
    </body>
</html>

