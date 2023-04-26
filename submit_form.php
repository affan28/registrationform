
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $donationAmount = $_POST["donationAmount"];

    // Insert the submitted form data into the 'donations' table in the database
    $sql = "INSERT INTO donations (name, email, donation_amount) VALUES (:name, :email, :donationAmount)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":donationAmount", $donationAmount);

    if ($stmt->execute()) {
        echo "<h2>Submitted Form Data</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><td>" . $name . "</td></tr>";
        echo "<tr><th>Email</th><td>" . $email . "</td></tr>";
        echo "<tr><th>Donation Amount</th><td>" . $donationAmount . "</td></tr>";
        echo "</table>";
        echo "<p>Form data has been successfully inserted into the database.</p>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt = null;
    $conn = null;
}
?>
