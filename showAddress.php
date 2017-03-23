<?php

require_once 'config.php';

session_start();

$email = $_SESSION['email'];

if($email == null || $email == '')
    exit;

$conn = Connection::connectToDB();

$query = "select address1, address2, town, zipcode, country_name, addressid 
          from apps_countries as country, user, address
          where country.id = address.countryid and address.userid = user.id
          and user.mail = ?";
    
if($stmt = $conn->prepare($query)) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        echo '<input type="radio" name="adresa" value=' . $row[addressid] . '>' . $row[address1] . ' ' . $row['address2'] . $row['town'] . 
            $row['zipcode'] . ' ' . $row['country_name'] . '</p>';
    }
}


?>