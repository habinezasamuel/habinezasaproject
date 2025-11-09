<?php
$conn = mysqli_connect('localhost', 'root', '', 'customermanagement');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM customer WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #555;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {background-color: #f9f9f9;}
        a.button {
            display: inline-block;
            padding: 8px 15px;
            margin-top: 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.action {
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
        }
        a.edit {
            background-color: #2196F3;
        }
        a.delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>

<h2>Customer Records</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Address</th>
        <th>Item</th>
        <th>Purchase Date</th>
        <th>Operations</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['item']}</td>
                    <td>{$row['date']}</td>
                    <td>
                        <a class='action edit' href='edit.php?id={$row['id']}'>Edit</a>
                        <a class='action delete' href='?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this customer?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='text-align:center;'>No records found</td></tr>";
    }
    ?>
</table>

<a class="button" href="index.php">Add New Customer</a>

</body>
</html>
