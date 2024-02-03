<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

include '../connections/settings.php';
include '../connections/dbh.php';

$pdo = new mypdo();

if(isset($_POST['name']) && isset($_POST['price'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
	$desc_n = $_POST['desc_n'];
	$class = $_POST['class'];
	$mid = $_POST['mid'];
	
	
	$menu = $pdo->get_one('SELECT * FROM menus WHERE id = ?', $mid);
	
	$image_url_n = $menu['image_url'];
	
	if(isset($_FILES['image']) && $_FILES['image']['size'] > 20){
	
		$image = $_FILES['image'];	
		
		$mime = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
		if(!in_array($mime, array("jpg", "jpeg", "png", "gif")))
			die(header('Location: add_menu_item.php?erro=not a valid image file'));
		
		if($image['size'] > 5206000)
			die(header('Location: add_menu_item.php?erro=Filesize is too much. Limit is 5000kb'));
		
		$image_url = 'menu_'.time().'.'.$mime;
		
		move_uploaded_file($image['tmp_name'], '../image/'.$image_url);
		
		unlink('../image/'.$image_url_n);
		
		$image_url_n = $image_url;
	}
	$pdo->update_menu($mid, $name, $desc_n, $price, $class, $image_url_n);
	
	die(header('Location: menu.php'));
	
}




if(!isset($_REQUEST['menu_id']))
	header('Location: menu.php');


$mid = $_REQUEST['menu_id'];

$menu = $pdo->get_one('SELECT * FROM menus WHERE id = ?', $mid);


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="updateitem.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Update- BH Bags</title>
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
                <li><a class="user_name"  style = "color:white;"> <?php echo $_SESSION['ausername']; ?></a></li>
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
            <div class="max-width">
                <h2 class="title">
                    Update Menu Item
                   </h2>

            </div>
        </div>
        <br></br>
        
        <section class="section-menu">
            <div class="container-menu"> 
            <p class="msg_error" style="padding:5px;"><?php echo @$_GET['erro']; ?></p>
                <form method="post" action="" enctype="multipart/form-data">
                <div class="my_form1">
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Menu Item Name</label>
                        <input type="hidden" name="mid" value="<?php echo $menu['id']; ?>" />
                        <input required minlength="3"   style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" name="name"  value="<?php echo $menu['name']; ?>"/>
                    </div>
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Description</label>
                        <textarea required minlength="6"   style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" name="desc_n"><?php echo $menu['desc_n']; ?></textarea>
                    </div>
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Price</label>
                        <input type="number" step="0.01" required   style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" name="price" value="<?php echo $menu['price']; ?>" />
                    </div>
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Ranking (Popularity) <small> 0 - 10</small></label>
                        <select required  name="class"  style= "width: 30%;height: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" ><option value=""></option><option selected="selected" value="<?php echo $menu['class']; ?>"><?php echo $menu['class']; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select>
                    </div>
                    <div>
                        <label style="font-weight: bold;font-size: 20px; color: gold;font-family: Trebuchet MS, sans-serif;font-size: 20px;text-align: left;">Upload Photo </label>
                        <input  type="file"   name="image"  style= "width: 30%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;"/>
                    </div>
                    <div>
                        <button class="btn"> Update</button>
                    </div>
                </div>
                </form>
              
              </div>
                
                
                                
            </div>
            </div>
        </section>
        
<footer>
                <p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        
    <script src="js/main.js"></script></footer>
    </body>
</html>



