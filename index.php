<?php 

$title = 'Haymarket'; 
include 'header.php'; 
include 'showBooks.php';
    
?>

    <?php include 'navigation.php'; ?>
        <div id="queryResult"></div>

    <div id="buttonCategory">
        <a data-fancybox data-src="#leftNav" href="javascript:;">
        <button name="categoryBtn" id="categoryBtn" style="color: black;">Categories</button>
        </a>
    </div>
    

<?php include 'footer.php'; ?>