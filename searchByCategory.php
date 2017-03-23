<?php
    include 'config.php';

    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

    $category = trim($_GET['cat']);

    $db = Connection::connectToDB();

    $query = "SELECT title, pages, isbn FROM book
                where isbn in (select isbn from book_category where category = ?)";
        
    if(($stmt = $db->prepare($query)) == false) echo "<p> We got an error";    
    $stmt->bind_param('s', $category);
    
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($title, $pages, $imagename);

    echo '<catalog>';
    while($stmt->fetch()) {
        echo '<book>';
        echo '<title>';
        echo $title;
        echo '</title>';
        echo '<pages>';
        echo $pages;
        echo '</pages>';
        echo '<image>';
        echo "<img src='img/$imagename.jpg'></img>";
        echo '</image>';
        echo '</book>';
    }
    echo '</catalog>';

    mysqli_close($db);



?>