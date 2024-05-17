<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ewmsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_GET['del']))
{
  $rid=$_GET['del'];
  $query=mysqli_query($con,"delete from tblemployee  where ID='$rid'");
  echo "<script>alert('Data Deleted');</script>";
}

?>


<!DOCTYPE html>
<head>
<title>E-Waste Management System|| B/w Dates Report Details</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<?php include_once('includes/header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
    
   
   
    <div><?php $fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$fdate = date("d-m-Y", strtotime($fromdate));
$tdate = date("d-m-Y", strtotime($todate));
?>
<div class="panel-heading">
            B/w Dates Report Details From <?php echo $fdate;?> To <?php echo $tdate;?></div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>
        <thead>
          <tr>
            <th data-breakpoints="xs">S.NO</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Employee Email</th>
            <th>Status</th>
            <th>Joining Date</th>
            <th data-breakpoints="xs">Action</th>
           
           
          </tr>
        </thead>
        <?php
$ret=mysqli_query($con,"select * from  tblemployee where date(JoiningDate) between '$fdate' and '$tdate'");
$cnt=1;
$count=mysqli_num_rows($ret);
if($count>0){
while ($row=mysqli_fetch_array($ret)) {

?>
        <tbody>
           <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['EmployeeID'];?></td>
                  <td><?php  echo $row['Name'];?></td>
                  <td><?php  echo $row['Email'];?></td>
                  <?php if($row['Status']=='Active'){?>
                  <td><?php  echo $row['Status'];?></td>
                  <?php } else { ?>
                  <td><?php  echo $row['Status'];?></td><?php } ?>
                  <td><?php  echo $row['JoiningDate'];?></td>
                  <td><a href="edit-employee.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary">Edit</a> 
                    <a href="manage-employee.php?del=<?php echo $row['ID'];?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete?')">Delete</a>
                           <a href="empassigned-products.php?empid=<?php echo $row['EmployeeID'];?>&&empname=<?php echo $row['Name'];?>" class="btn btn-warning" target="_blank">Assigned Products</a>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else {?>
<tr>
  <th colspan="7" style="color:red">No Record found</th>
</tr>
 <?php } ?> 
 </tbody>
            </table>
            
            
          
    </div>
  </div>
</div>
</section>
 <!-- footer -->
		 <?php include_once('includes/footer.php');?>  
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php }  ?>