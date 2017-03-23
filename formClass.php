<?php

class Form {
    
    function printForm($action) {    
        echo '<form class="form-horizontal" id="signInForm" method="post" action="' . $action . '">';
        echo '
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="email" id="fullName" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="fullName" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password" id="password">
            </div>
          </div>
         <button type="submit" id="signInButton" class="stylishButton" value="Submit">Submit</button>
        </form> ';
    }
    
    function printNoAccount() {
         echo '<div id="mainSignInDiv">If you do not have account click <a href="registerForm.php">here</a></div>';
    }
}


?>