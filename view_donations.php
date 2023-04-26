
<?php
// Create a connection to the MySQL database
$servername = "localhost"; // Replace with your database servername
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "donation"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch and display the donations data from the 'donations_view' view
$sql = "SELECT id, name, email, donation_amount FROM donations_view";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    echo "<div class='form-container'>";
    echo "<h2>List of Donations</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Donation Amount</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        
        echo "<td>" . $row["donation_amount"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

} else {
    echo "No donations found.";
}

$stmt = null;
$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Donations List</title>
</head>
<body>
    <h1>Let's go to home page</h1>
    <!-- Your HTML content goes here -->
    <a href="./">Back</a> <!-- Replace "previous_page.php" with the URL or relative path to the page you want to navigate back to -->
</body>
</html>
