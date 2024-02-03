<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

include '../connections/settings.php';
include '../connections/dbh.php';

$pdo = new mypdo();

if(isset($_POST['ch']) && $_POST['ch'] == 'remove_item'){
	
	$mid = $_POST['mid'];
	$pdo->gen_qry_one('DELETE FROM menus WHERE id = ?', $mid);
	die('success');
	
}

$menus =  $pdo->get_menus("SELECT * FROM menus  ORDER BY id DESC"); 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="menuadmin.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title> Bags Menu - BH Bags</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        
    </head>
        <body style = "background-image:  url(../image/kuku.jpg)">
        <center><header class="max-width">
            <br></br><br></br><br></br><br></br>
            <nav>
                <br><br><center><a href="../index.php" class="logo"><img src="../image/logo.png" width="50" height="50"></img> </a></center>
             <br><br>    
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact_messages.php">Contact Messages</a></li>
                <li><a href="sales_report.php">Sales Report</a></li>
                <li><a href="menu.php">Bags Menu</a></li>
                <li><a class="user_name" style = "color:white;"> <?php echo $_SESSION['ausername']; ?></a></li>
                 <li><a href="logout.php">Logout</a></li>
                
            </ul>

        </nav>
        </header></center>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br><br></br>
        
        
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    BAGS</h2>
            </div>
        </div>
        <section class="section-menu">
            <div class="container-menu"> 
                <div style="text-align:right; margin-bottom:20px;"> <a class="btn" href="add_menu_item.php" style="box-shadow:2px 2px 2px #09C">Add Menu Item </a></div>
                <table class="table_m" style="font-family: Trebuchet MS, sans-serif;">
                	<thead>
                    	<tr>
                        	<th style = "background-color:#A04000;">Menu Item</th>
                            <th style = "background-color:#A04000;">Description</th>
                            <th style = "background-color:#A04000;">Price</th>
                            <th style = "background-color:#A04000;">Rank</th>
                            <th style = "background-color:#A04000;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menus as $menu){  ?>
                    	<tr id="menu_<?php echo $menu['id']; ?>">
                        	<td style = "background-color:#E59866;">
                                
                                <img src="../image/<?php echo $menu['image_url']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <h4><?php echo $menu['name']; ?></h4>
                            </td>
                            <td style = "background-color:#E59866;"><?php echo $menu['desc_n']; ?></td>
                            <td style = "background-color:#E59866;">RM <?php echo $menu['price']; ?></td>
                            <td style = "background-color:#E59866;"><?php echo $menu['class']; ?></td>
                            <td  style = "background-color:#E59866;"class="btn_rw"><a href="update_menu_item.php?menu_id=<?php echo $menu['id']; ?>">Update</a> &nbsp;&nbsp;&nbsp; <button onclick="remove_item(<?php echo $menu['id']; ?>)"> &times; Delete</button></td>
                        </tr>
                    </tbody>
                	
                    <?php } ?>
                </table>
                
            </div>
            </div>
        </section>
        <br><br><br><br>
        <footer>
         <p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        
    <script src="../js/admin.js"></script></footer>
    </body>
</html>

