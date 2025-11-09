
<?php
$conn=mysqli_connect('localhost','root','','customermanagement');
if(isset($_POST['login'])){
	if(!$conn){
	die("Connection failed".mysqli_connect_error());
	}
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$item=$_POST['item'];
	$date=$_POST['date'];
	$sql="SELECT * FROM customer WHERE firstname='$firstname',lastname='$lastname'AND email='$email'AND address='$address'AND item='$item' AND date='$date'";
	$query=mysqli_query($conn,$sql);
	if($query){
	 $result=mysqli_num_rows($query);
	 if($result > 0){
	 	echo "login successfully";
	 }else{
	 	echo "login failed".mysqli_error($conn);
	 }}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Management</title>
</head>
<body>

  <h2>Customer Management Form</h2>

  <form action="display.php" method="POST">
  	<h2>login_here</h2><br><br>
  
    <label>Firstname</label><br>
    <input type="text" name="firstname" placeholder="Enter firstname" 
           required pattern="[A-Za-z]+" title="Firstname should contain only letters"><br><br>

   
    <label>Lastname</label><br>
    <input type="text" name="lastname" placeholder="Enter lastname" 
           required pattern="[A-Za-z]+" title="Lastname should contain only letters"><br><br>


    <label>Email</label><br>
    <input type="email" name="email" placeholder="Enter your email" 
           required title="Enter a valid email address"><br><br>

    
    <label>Address</label><br>
    <input type="text" name="address" placeholder="Enter address" 
           required minlength="3" title="Address must be at least 3 characters"><br><br>

    
    <label>Item</label><br>
    <input type="text" name="item" placeholder="Enter item name" 
           required pattern="[A-Za-z0-9\s]+" title="Item name should contain only letters or numbers"><br><br>

    <label>Purchase Date</label><br>
    <input type="date" name="date" required title="Select purchase date"><br><br>

    <input type="submit" name="login" value="login"><br>
  </form>

</body>
</html>


