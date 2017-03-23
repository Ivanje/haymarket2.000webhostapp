<?php
    $searchRequest = trim($_GET['q']);
    $title = "Search: " . $searchRequest;
    include 'header.php';
    include 'navigation.php';
    include 'showBooks.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    

    $db = new mysqli('localhost', 'root', 'limonada', 'haymarket', 3307);
    if(mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database. <br/>
        Please try again letter. </p>';
        exit;
    }

    $query = "select distinct title, price, discountrate, pages, book.isbn, firstname, middlename, lastname from book, book_author, author where book.isbn = book_author.isbn and author.AuthorID = book_author.AuthorID and (title like ?
    or concat_ws(' ',firstname, middlename, lastname) like ? or concat_ws(' ',lastname, middlename ,firstname) like ?) group by book.isbn";
    $likeString = '%'. $searchRequest . '%';
    if(($stmt = $db->prepare($query)) == false) echo "<p> We got an error";
    $stmt->bind_param('sss',$likeString, $likeString, $likeString);
    $stmt->execute();
    $result = $stmt->get_result();
    Show::showBooks($result);


    mysqli_close($db);
    include 'footer.php';
?>