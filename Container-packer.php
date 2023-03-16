<?php 

// Connect to the database
$dsn = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:\\Users\\Sammmy\\Desktop\\School project\\School_Project.accdb";
$username = "";
$password = "";
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Query the database to get container data
$query = "SELECT * FROM Container_registration";
$stmt = $conn->prepare($query);
$stmt->execute();
$containers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output table of container data
echo "<table>";
echo "<tr><th>Container Name</th><th>Location</th><th>Weight</th></tr>";
foreach ($containers as $container) {
    $first_name = $container['first_name'];
    $container_type = $container['container_type'];
    $container_weight = isset($container['Container_weight']);

    // Determine location based on container type and mass
    if ($container_type == "20 TEU") {
        $location = "Hold 1, Starboard";
    } else {
        $location = "";
        $mass = "";
        if ($mass <= 5) {
            $location = "Hold 1, Hatch";
        } elseif ($container_weight <= 10) {
            $location = "Hold 2, Starboard";
        } elseif ($container_weight <= 15) {
            $location = "Hold 3, Hatch";
        } elseif ($container_weight <= 25) {
            $location = "Hold 4, Starboard";
        } elseif ($container_weight <= 50) {
            $location = "Hold 5, Hatch";
        }
    }

    echo "<tr><td>$first_name</td><td>$location</td><td>$container_weight</td></tr>";
}
echo "</table>";

?>
