    $connection3 = Connection::connectToDB();
    $sql3 = "SELECT userid FROM USER WHERE fullname = ?";
    if(($stmt3 = $connection3->prepare($sql3)) == false)
        echo "We got an error!!!";
    $stmt3->bind_param('s', $fullName);
    $result3 = $stmt3->get_result();

    if($result3->num_rows != 1) {
        echo "We could not enter your address. You could enter it when you order an item";
        exit;
    }

    $row3 = $result3->fetch_assoc());
    $id = $row3['id'];

    $sql4 = "INSERT INTO address VALUES(NULL, ?, ?, ?, ?, ?, ?)";
    if(($stmt4 = $connection2->prepare($sql2)) == false)
        echo 'We got an error!!!';