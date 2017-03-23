<?php 
    $title = "Register now";
    include'header.php';
    include 'Messages.php';
    session_start();

    if(isset($_SESSION['error'])) {
    foreach($_SESSION['error'] as $value) {
        Messages::printBadMessage($value);
    }
        $_SESSION['error'] = null;
    }
?>

<form class="form-horizontal" id="registerForm" method="post" action="registerBack.php">
  <div class="form-group">
    <label for="fullName" class="col-sm-3 control-label">Full name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Full name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password1" id="password">
    </div>
   </div>
   <div class="form-group">
    <label for="password2" class="col-sm-3 control-label">Repeat Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password2" id="password2">
    </div>
   </div>
   <button type="submit" id="registerSubmitButton" class="stylishButton" value="Submit">Submit</button>
</form>
