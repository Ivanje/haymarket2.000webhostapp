<?php $title = ''; include 'header.php'; ?>
    
<?php
    include 'config.php';
    include 'showBooks.php';
    $id = ($_GET["id"]);

    $db = Connection::connectToDB();


 
    $query = "SELECT * from book where isbn = ?";
    if(($stmt = $db->prepare($query)) == false )
        echo "<p>We got an error";

    $authorQuery = "SELECT * from author, book_author where book_author.authorId = author.authorId and book_author.isbn  = ?";
    if(($stmt2 = $db->prepare($authorQuery)) == false)
        echo "<p>We got an error";

    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_of_rows = $result->num_rows;

    while($row = $result->fetch_assoc()) {
        echo '<div id="mainBook">';
        echo '<div id="bookImgDiv"><img id="bookImage" src="img/' . $row['isbn'] . '.jpg"></img><div id="bookClearDiv"></div></div>'; 
        echo '<h1 id="title">' . $row['title'] . "</h1>";
        $stmt2->bind_param('s', $row['isbn']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while($obj = $result2->fetch_object()) {
            echo '<span id="author">' .  $obj->FirstName . " " . $obj->MiddleName . " " . $obj->LastName . " | </span>";
        }
        echo '<p id="desciption">' . $row['description'] . '</p>';
        echo '<p>' . '<span class="boldSpan">' . "Format: " . "</span>" . $row['format'] . " | " . $row['pages'] . '</p>';
        echo '<p id="dimensions">' . '<span class="boldSpan">' . "Dimensions: " . "</span>" .
            $row['width']  . ' x ' . $row['length'].  ' x ' . $row ['thick'] . '</p>';
        echo '<p>' . '<span class="boldSpan">' . "ISBN: " . "</span><span id='isbn'>" . $row['isbn'] . '</span></p>';
        echo '<p>' . '<span class="boldSpan">' . "Price: " . "</span>" . Show::getFinalPrice($row) . "\xE2\x82\xAc" . '</p>';
        echo "<div style='clear:both'></div>";
        echo '</div>';
    }
    $stmt->free_result();

?>
        <div id="queryResult"></div>
        <button type="button" id="addButton" class="stylishButton">Add</button>
<?php include 'footer.php'; ?>