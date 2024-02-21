<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $start_date = $_POST['start_date'];
    
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "welcometocit123";
    $dbname = "employees";
    
    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO empl (full_name, email, phone, address, position, department, salary, start_date)
        VALUES (:full_name, :email, :phone, :address, :position, :department, :salary, :start_date)");
        
        // Bind parameters
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':start_date', $start_date);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch all rows from the database to display the table
        $stmt = $conn->query("SELECT * FROM empl");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Display the table
        echo "<h2>Employee Table</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Position</th><th>Department</th><th>Salary</th><th>Start Date</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['position'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // Close connection
    $conn = null;
}
?>

