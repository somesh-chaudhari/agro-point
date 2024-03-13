<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnection.php");
$loopcount = 0;
							  $sql = "SELECT * FROM product";
							  if(isset($_SESSION['sellerid']))
							  {
								  $sql = $sql . " WHERE seller_id='$_SESSION[sellerid]'";
							  }
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  $sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								   $sql2 = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2= mysqli_fetch_array($qsql2);
								  
							 		$producetitle[$loopcount] =  $rs['title'];								
//Jan
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-7 months")) . "' AND '" . date("Y-m-31", strtotime("-7 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Feb
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-6 months")) . "' AND '" . date("Y-m-31", strtotime("-6 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Mar
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-5 months")) . "' AND '" . date("Y-m-31", strtotime("-5 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Apr
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-4 months")) . "' AND '" . date("Y-m-31", strtotime("-4 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] ;
$loopcount = $loopcount +1;

//Nov
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-3 months")) . "' AND '" . date("Y-m-31", strtotime("-3 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Dec
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-2 months")) . "' AND '" . date("Y-m-01", strtotime("-2 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Jan
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '" . date("Y-m-01", strtotime("-1 months")) . "' AND '" . date("Y-m-01", strtotime("-1 months")) . "' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
							  }								  	  
$prolist = 0;							  
foreach($producetitle as $val)
{					
  
	$productwise =  $productwise .  "{
            name: '$val',
            data: [$profit[$prolist]]
      },
		";							
	$prolist = $prolist + 1;		  
}
//echo $productwise;
?>
		<style type="text/css">
${demo.css}
		</style>
		
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>