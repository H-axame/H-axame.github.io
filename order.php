<?php
	require_once('auth.php');
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Roman's pizza</title>

<meta name="keywords" content="free website templates, CSS layout, Pizza Company Website, HTML CSS" />

<meta name="description" content="Pizza Company Website - free CSS website template, Free HTML CSS Layout" />

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />



<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
 
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      })
    })
  </script>

<script type="text/javascript">
function validateForm()
{


if (document.abcd.checkbox.checked == false)
{
alert ('pls. agree the term and condition of this company');
return false;
}
else
{
return true;
}
}
</script>


<script type="text/javascript">
    function ShowTime()
    {
      var time=new Date()
      var h=time.getHours()
      var m=time.getMinutes()
      var s=time.getSeconds()
      // add a zero in front of numbers<10
      m=checkTime(m)
      s=checkTime(s)
      document.getElementById('txt').value=h+" : "+m+" : "+s
      t=setTimeout('ShowTime()',1000)
	
    }
    function checkTime(i)
    {
      if (i<10)
      {
        i="0" + i
      }
      return i
    }
    </script>




<script type="text/javascript">
function showDiv(prefix,chooser) 
{
        for(var i=0;i<chooser.options.length;i++) 
		{
        	var div = document.getElementById(prefix+chooser.options[i].value);
            div.style.display = 'none';
        }
 
		var selectedOption = (chooser.options[chooser.selectedIndex].value);
		
 
		if(selectedOption == "1")
		{
			displayDiv(prefix,"1");
		}
		else if(selectedOption == "2")
		{
			displayDiv(prefix,"2");
		}
		
 
}
 
function displayDiv(prefix,suffix) 
{
        var div = document.getElementById(prefix+suffix);
        div.style.display = 'block';
}

</script>



</head>
<body onLoad="ShowTime()">
<div id="templatemo_container">
  <div id="templatemo_header_section"><div style="float:right; margin-right:30px;">
  <?php 
  include('config.php');
  $id=$_SESSION['SESS_MEMBER_ID'];
  
  $resulta = mysqli_query($bd, "SELECT * FROM marias_members WHERE id = '$id'");
while ($row = mysqli_fetch_array($resulta)) {
    echo $row['firstname'] . ' ' . $row['lastname'];
}
  
  ?>&nbsp;<a href="index.php">&nbsp;logout</a></div> 
  </div>
  <div id="templatemo_menu_bg">
    <div id="templatemo_menu">
      <ul>
	  <div style="float:left">
      <input name="time" type="text" id="txt" style="border: 0px none; font-size: 25px; margin-top: -5px; height: 23px; width: 130px; background-color:#000000; color:#FF0000; font-stretch:wider" readonly/> </div> 
      </ul>
	  
    </div>
  </div>
  <div id="templatemo_header_pizza"> </div>
  <div id="templatemo_content">
    <div id="templatemo_content_left">
	  <div class="text">List Of Product </div>
     
	                  <div class="view1"><?php
			   include('config.php');
								
								

								
         $result2 = mysqli_query($bd, "SELECT * FROM category");

         while ($row2 = mysqli_fetch_array($result2)) {
             $ble = $row2['id'];
             $result3 = mysqli_query($bd, "SELECT * FROM marias_products where product_id='$ble'");
             $row3 = mysqli_fetch_array($result3);
								  
								  
      echo '<div class="templatemo_pizza_box"> <a rel="facebox" href=portal.php?id=' . $row3["product_id"] . '><img alt="Pizza" src="images/pizza/'.$row3['product_photo'].'" width="65px" height="65px" /></a>';
          echo '<div class="textbox"> '.$row3['product_name'].' </div>';
      echo '</div>';
	 
								  }
										  
	?></div>
    </div>
	
	
	
	
    <div id="templatemo_content_right">
	<form method="post" action="paymentportal.php" name="abcd" onsubmit="return validateForm()">
	<input name="cusid" type="hidden" value="<?php echo $_SESSION['SESS_MEMBER_ID']; ?>" />
	<input name="transactioncode" type="hidden" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>" />
      <h2>Order Details </h2>
      
	  
	  
	  
	  
	  
	  <table width="335" border="1" cellpadding="0" cellspacing="0" style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
        <tr>
          <td width="90"><div align="center"><strong>Product Name </strong></div></td>
          <td width="84"><div align="center"><strong>Size</strong></div></td>
          <td width="27"><div align="center"><strong>Qty</strong></div></td>
          <td width="45"><div align="center"><strong>Price</strong></div></td>
          <td width="46"><div align="center"><strong>total</strong></div></td>
          <td width="29"><div align="center"><strong>del</strong></div></td>
        </tr>
		<?php
		include('config.php');

    $memid = $_SESSION['SESS_FIRST_NAME'];
    $resulta = mysqli_query($bd, "SELECT * FROM orderdetails WHERE transactioncode = '$memid'");
    
    if (!$resulta) {
        die('Query Error: ' . mysqli_error($bd));
    }

while ($row = mysqli_fetch_array($resulta)) {
    echo '<tr>';
    echo '<td><div align="center">' . $row['pizzaname'] . '</div></td>';
    echo '<td><div align="center">' . $row['pizasize'] . '</div></td>';
    echo '<td><div align="center">' . $row['qty'] . '</div></td>';
    echo '<td><div align="center">' . $row['price'] . '</div></td>';
    echo '<td><div align="center">' . $row['total'] . '</div></td>';
    echo '<td><div align="center"><a href="deleteorder.php?id=' . $row["orderid"] . '">Cancel</a></div></td>';
    echo '</tr>';
}

		?>
        <tr>
          <td colspan="4"><div align="right">Grand Total: </div></td>
          <td colspan="2"><div align="left">
		  <?php
        include('config.php');

        $memid = $_SESSION['SESS_FIRST_NAME'];
        $result = mysqli_query($bd, "SELECT SUM(total) AS totalSum FROM orderdetails WHERE transactioncode = '$memid'");

        if (!$result) {
            die('Query Error: ' . mysqli_error($bd));
        }

        $row = mysqli_fetch_assoc($result);
        $totalSum = $row['totalSum'];

        echo '<input name="total" type="text" size="10" value="' . $totalSum . '"/>';
      ?>

		  
		  
		  </div></td>
        </tr>
      </table>
	  <br />
	  <table width="273" border="0" cellpadding="0" cellspacing="0" style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
        <tr>
          <td width="76"><div align="right"><strong>Delivery Time:</strong></div></td>
          <td width="97"><select name="time">
            <option value="8:00am">8:00am</option>
            <option value="8:15am">8:15am</option>
            <option value="8:30am">8:30am</option>
            <option value="8:45am">8:45am</option>
          </select></td>
        </tr>
        <tr>
          <td><div align="right"><strong>Select One:</strong></div></td>
          <td><select name="portal" id="cboOptions" onChange="showDiv('div',this)">
	
	<option value="1">Delivery</option>
	<option value="2">Pick-Up</option>
	</select>
            
          </select></td>
        </tr>
        
		<div id="div1" style="display:none; color:#000000">
		
            &nbsp;Delivery Destination:<input name="dist" type="text" />
          
		  </div>
		<div id="div2" style="display:none; color:#000000">
		
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recepient:<input name="person" type="text" />
         
		  </div>  
		  
		  
        <tr>
          <td><div align="right"><strong>Distination:</strong></div></td>
          <td><select name="distination" id="distination">
            <option value="City Proper">City Proper</option>
            <option value="Outside City">Outside City</option>
          </select></td>
        </tr>
		
		<tr>
          <td colspan="2"><label>
            <input type="checkbox" name="checkbox" value="checkbox" />
            I Agree The <a rel="facebox" href="terms.php">Terms and Condition</a> of this company</label></td>
          </tr>
		
      </table><br />
	  <input name="" type="submit" value="Confirm Order" />
	  </form>
    </div>
    <div id="templatemo_card"></div>
  </div>
  <div id="templatemo_container_end"></div>
</div>
<div id="templatemo_footer">
  <div class="middle">
        Copyright © mamma marias pizzeria</div>
        <div class="button"></div>
</div>
<div>
</div>
</body>
</html>