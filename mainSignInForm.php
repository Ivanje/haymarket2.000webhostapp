 <?php 
$title = "Form";
include_once 'header.php'; 
include_once 'formClass.php';

$form = new Form;
echo '<div class="container">';
echo '<div class="jumbotron">';
$form->printForm('mainSignIn.php');
echo '</div>';
echo '</div">';
$form->printNoAccount();
?>