<?php
    $title = 'Haymarket category';
    $category = trim($_GET['cat']);
    require_once 'config.php';
    require_once 'header.php';
    require_once 'navigation.php';
    require_once 'showBooks.php';

?>

    <div id="buttonCategory">
        <a data-fancybox data-src="#leftNav" href="javascript:;">
        <button name="categoryBtn" id="categoryBtn" style="color: black;">Categories</button>
        </a>
    </div>

<?php

    $db = Connection::connectToDB();

    $query = "SELECT * FROM book
                where isbn in (select isbn from book_category where category = ?)";
        
    if(($stmt = $db->prepare($query)) == false) echo "<p> We got an error";    
    $stmt->bind_param('s', $category);
    
    $stmt->execute();
    $result = $stmt->get_result();
    Show::showBooks($result);
    

    mysqli_close($db);
    include 'footer.php';
?>