<?php

require_once 'config.php';
session_start();
$addressid = $_GET['id'];


$conn = Connection::connectToDB();
$query = "SELECT * FROM address where address.addressid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $addressid);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows == 1)
    $_SESSION['addressid'] = $addressid;

    echo 'Proba ovde so sesijata ' . $_SESSION['addressid'];

?>