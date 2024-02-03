<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

include '../connections/settings.php';
include '../connections/dbh.php';




$pdo = new mypdo();

$fdate = '';
$tdate = '';

if(isset($_GET['fdate']) && $_GET['fdate'] != '') 
	$fdate = date('Y-m-d', strtotime($_GET['fdate']));

if(isset($_GET['tdate']) && $_GET['tdate'] != '') 
	$tdate = date('Y-m-d', strtotime($_GET['tdate']));


if($fdate != '' && $tdate == ''){
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) = '$fdate' ORDER BY order_id DESC");
}
elseif($tdate != '' && $fdate == ''){
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) = '$tdate' ORDER BY order_id DESC");

}
elseif($fdate != '' && $tdate != ''){
	
	if($fdate > $tdate){
		$fdate_x = $fdate;
		$fdate = $tdate;
		$tdate = $fdate_x;	
	}
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) between '$fdate' AND '$tdate' ORDER BY order_id DESC");
}
else{
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id ORDER BY order_id DESC");
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="sales_report.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Sales Report - BH Bags</title>
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
                    SALES REPORT</h2><br><br>
                <div class="searc_area"><form method="get" action=""><b>From Date:&nbsp;&nbsp;</b><input type="date" name="fdate"  style= "width: 13%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" value="<?php echo @$fdate; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;   <b>To Date:&nbsp;&nbsp;</b> <input type="date" name="tdate" style= "width: 13%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box: 1 px solid black;border: 1px solid black;background-color: #F5D0A9;font-weight: bold;font-size: 17px;" value="<?php echo @$tdate; ?>" /> &nbsp;&nbsp; <button class="btn"> Submit</button></form></div>
            </div>
        </div>
        <br><br>
        <section class="section-menu">
            <div class="container-menu" style="min-height:370px"> 
                
                
            <?php if(count($orders) > 0){ ?>
                <center><br>
            <table class="table_m" style = "font-family: Trebuchet MS, sans-serif;">
                <tr>
                    <th style = "background-color:#A04000;">View Bag</th>
                    <th style = "background-color:#A04000;">Customer Email</th>
                    <th style = "background-color:#A04000;">Full Name</th>
                    <th style = "background-color:#A04000;">Email</th>
                    <th style = "background-color:#A04000;">Billing Address</th>
                    <th style = "background-color:#A04000;">Sub Total</th>
                    <th style = "background-color:#A04000;">Tax(5%)</th>
                    <th style = "background-color:#A04000;">Total Paid</th>
                    <th style = "background-color:#A04000;">Date</th>
                </tr>
                <?php 
				
				$all_total = 0;
				$all_subtotal = 0;
				$all_tax = 0;
					
				foreach($orders as $order){
					
					$subtotal =  $order['amount'] * 100 / 105;
					$tax = 5 * $subtotal / 100;
					
					$all_total += $order['amount'];
					$all_subtotal += $subtotal;
					$all_tax += $tax;
				?>
                <tr>
                    <td style = "background-color:#E59866;">
                    <br><br>
                    <a  href="order.php?order_id=<?php echo $order['order_id']; ?>"><button class = "btn5">View Menu Bags</button></a></td>
                    <td style = "background-color:#E59866;"><?php echo $order['cemail']; ?></td>
                    <td style = "background-color:#E59866;"><?php echo $order['fname']; ?></td>
                    <td style = "background-color:#E59866;"><?php echo $order['email']; ?></td>
                    <td style = "background-color:#E59866;">
                    <?php echo $order['billing_details']; ?>
                    </td>
                    <td style = "background-color:#E59866;">RM <?php echo (round($subtotal,2)); ?></td>
                    <td style = "background-color:#E59866;">RM <?php echo (round($tax,2)); ?></td>
                    <td style = "background-color:#E59866">RM <?php echo $order['amount']; ?></td>
                    <td style = "background-color:#E59866"><?php echo $order['date']; ?></td>
                </tr>
                <?php } 
				?>
                <tr style="font-weight:bold; background-color:#F9F9F9">
                	<td colspan="5" style="background-color:darkgray;"> Total: </td>
                    <td style="white-space: nowrap; padding-top:20px;background-color:darkgray;">RM <?php echo (round($all_subtotal,2)); ?></td>
                    <td style="white-space: nowrap; padding-top:20px;background-color:darkgray;">RM <?php echo (round($all_tax,2)); ?></td>
                    <td style="white-space: nowrap; padding-top:20px;background-color:darkgray;">RM <?php echo (round($all_total,2)); ?></td>
                    <td style="background-color:darkgray;"></td>
                
                </tr>
                
            </table></center>
        
         <?php } else{?>
         
         <p style="text-align:center; padding:100px 40px; font-size:24px;color:#E59866;font-family: Trebuchet MS, sans-serif;"> You have not made any order</p>
         
         <?php } ?>
                
            </div>
            </div>
        </section>
        <br><br><br><br>
        <footer>
 <p style="font-size:15px;color:#E59866;font-family: Trebuchet MS, sans-serif;">@ 2021 BH Bag Store</p>
        
    <script src="../js/admin.js"></script></footer>
    </body>
</html>

