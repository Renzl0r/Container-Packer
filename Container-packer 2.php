<?php
// Open connection to database
$db = new PDO('odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\Path\To\Your\Database.mdb');

// Query to retrieve container data
$query = "SELECT * FROM Container_registration";

// Execute the query and get the results
$results = $db->query($query);

// Loop through each container
foreach ($results as $row) {
    $container_type = $row['Container_Type'];
    $container_weight = $row['Container_Weight'];

    // Determine the hold and slot for the container based on its type and weight
    if ($container_type == '20TEU') {
        // Check if there is space in Hold 1
        // If yes, allocate the container to the first available slot
        // If no, display an error message
        // Assume each slot in Hold 1 can hold up to 5 kilos
        $hold = 1;
        $slot = '';
        $slot_found = false;
        $remaining_weight = $container_weight;
        for ($i = 1; $i <= 4; $i++) {
            if (!$slot_found) {
                $slot_name = 'Hatch';
                switch ($i) {
                    case 1:
                        $slot_name .= ' Starboard';
                        break;
                    case 2:
                        $slot_name .= ' Port';
                        break;
                    case 3:
                        $slot_name .= ' Upper Starboard';
                        break;
                    case 4:
                        $slot_name .= ' Upper Port';
                        break;
                }
                $slot_weight_limit = 5;
                if ($remaining_weight <= $slot_weight_limit) {
                    $slot = $slot_name;
                    $slot_found = true;
                } else {
                    $remaining_weight -= $slot_weight_limit;
                }
            }
        }
        if (!$slot_found) {
            echo "Error: No available slot in Hold 1 for container $container_type.\n";
            continue;
        }
    } else if ($container_type == '40TEU') {
        // Check which hold can accommodate the container based on its weight
        // If a hold is found, allocate the container to the first available slot
        // If no hold can accommodate the container, display an error message
        // Assume each slot in Holds 2-5 can hold up to their respective weight limits
        $hold_found = false;
        $remaining_weight = $container_weight;
        for ($i = 2; $i <= 5; $i++) {
            if (!$hold_found) {
                switch ($i) {
                    case 2:
                        $hold_weight_limit = 10;
                        break;
                    case 3:
                        $hold_weight_limit = 15;
                        break;
                    case 4:
                        $hold_weight_limit = 25;
                        break;
                    case 5:
                        $hold_weight_limit = 50;
                        break;
                }
                if ($remaining_weight <= $hold_weight_limit) {
                    $hold = $i;
                    $slot_found = false;
                    for ($j = 1; $j <= 4; $j++) {
                        if (!$slot_found) {
                            $slot_name = 'Hatch';
                            switch ($j) {
                                case 1:
                                    $slot_name .= ' Starboard';
                                    break;
                                case 2:
                                    $slot_name .= ' Port';
                                    break;
                                case 3:
                                    $slot_name .= ' Upper Starboard';
                                    break;
                                case 4:
                                    $slot_name .= ' Upper Port';
// ===================================================
// Step 5: Retrieve the container weight from the database
$containerWeight = $row['mass'];

// Step 6: Determine the location to place the container
if ($containerType == '20TEU') {
    // Place the container in Hold 1
    if ($hold1Containers < 4) {
        // Place the container in Hold 1, in the next available slot
        if ($hold1Starboard < 2) {
            echo "Place container $containerNumber in 'Hold 1, Starboard'<br>";
            $hold1Starboard++;
        } else {
            echo "Place container $containerNumber in 'Hold 1, Hatch'<br>";
            $hold1Hatch++;
        }
        $hold1Containers++;
    } else {
        echo "Hold 1 is full, cannot place container $containerNumber<br>";
    }
} else if ($containerType == '40TEU') {
    // Place the container in Hold 2, 3, 4, or 5
    if ($containerWeight <= 5) {
        // Place the container in Hold 2
        if ($hold2Containers < 4) {
            // Place the container in Hold 2, in the next available slot
            if ($hold2Starboard < 2) {
                echo "Place container $containerNumber in 'Hold 2, Starboard'<br>";
                $hold2Starboard++;
            } else {
                echo "Place container $containerNumber in 'Hold 2, Hatch'<br>";
                $hold2Hatch++;
            }
            $hold2Containers++;
        } else {
            echo "Hold 2 is full, cannot place container $containerNumber<br>";
        }
    } else if ($containerWeight <= 15) {
        // Place the container in Hold 3
        if ($hold3Containers < 4) {
            // Place the container in Hold 3, in the next available slot
            if ($hold3Starboard < 2) {
                echo "Place container $containerNumber in 'Hold 3, Starboard'<br>";
                $hold3Starboard++;
            } else {
                echo "Place container $containerNumber in 'Hold 3, Hatch'<br>";
                $hold3Hatch++;
            }
            $hold3Containers++;
        } else {
            echo "Hold 3 is full, cannot place container $containerNumber<br>";
        }
    } else if ($containerWeight <= 25) {
        // Place the container in Hold 4
        if ($hold4Containers < 4) {
            // Place the container in Hold 4, in the next available slot
            if ($hold4Starboard < 2) {
                echo "Place container $containerNumber in 'Hold 4, Starboard'<br>";
                $hold4Starboard++;
            } else {
                echo "Place container $containerNumber in 'Hold 4, Hatch'<br>";
                $hold4Hatch++;
            }
            $hold4Containers++;
        } else {
            echo "Hold 4 is full, cannot place container $containerNumber<br>";
        }
    } else if ($containerWeight <= 50) {
        // Place the container in Hold 5
        if ($hold5Containers < 4) {
            // Place the container in Hold 5, in the next available slot
            if ($hold5Starboard < 2) {
                echo "Place container $containerNumber in 'Hold 5, Starboard'<br>";
                $hold5Starboard++;
            } else {
                echo "Place container $containerNumber in
// ===============================================
