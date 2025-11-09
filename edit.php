<?php

$conn = mysqli_connect('localhost', 'root', '', 'customermanagement');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (!isset($_GET['id'])) {
    die("No customer ID provided.");
}

$id = $_GET['id'];


$res = mysqli_query($conn, "SELECT * FROM customer WHERE id=$id");
if (mysqli_num_rows($res) == 0) {
    die("Customer not found.");
}

$customer = mysqli_fetch_assoc($res);

// Handle update form submission
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $address   = $_POST['address'];
    $item      = $_POST['item'];
    $date      = $_POST['date'];

    $sql = "UPDATE customer SET 
                firstname='$firstname', 
                lastname='$lastname', 
                email='$email', 
                address='$address', 
                item='$item', 
                date='$date' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Customer updated successfully.</p>";
        // Optionally redirect to customer list
        // header("Location: view_customers.php");
        // exit;
    } else {
        echo "<p style='color:red;'>Error updating customer: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Customer</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #333; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type=text], input[type=email], input[type=date] {
            width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;
        }
        input[type=submit] {
            margin-top: 15px; padding: 10px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer;
        }
        input[type=submit]:hover { background-color: #45a049; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #2196F3; }
    </style>
</head>
<body>

<h2>Update Customer</h2>

<form method="POST">
    <label>Firstname</label>
    <input type="text" name="firstname" value="<?php echo $customer['firstname']; ?>" required pattern="[A-Za-z]+" title="Letters only">

    <label>Lastname</label>
    <input type="text" name="lastname" value="<?php echo $customer['lastname']; ?>" required pattern="[A-Za-z]+" title="Letters only">

    <label>Email</label>
    <input type="email" name="email" value="<?php echo $customer['email']; ?>" required>

    <label>Address</label>
    <input type="text" name="address" value="<?php echo $customer['address']; ?>" required minlength="3">

    <label>Item</label>
    <input type="text" name="item" value="<?php echo $customer['item']; ?>" required pattern="[A-Za-z0-9\s]+" title="Letters or numbers only">

    <label>Purchase Date</label>
    <input type="date" name="date" value="<?php echo $customer['date']; ?>" required>

    <input type="submit" name="update" value="Update">
</form>

<a href="view_customers.php">Back to Customer List</a>

</body>
</html>
