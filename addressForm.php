  <div class="form-group">
    <label for="country" class="col-sm-3 control-label">Country</label>
    <div class="col-sm-9">
        <select id="country" name="country" class="form-control">
        <optgroup>
        <?php
            require_once 'config.php';
            $db = Connection::connectToDB();
            $sql = "SELECT country_name from apps_countries";
            $result = $db->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo  '<option>' . $row['country_name'] . '</option>';
                }
            }
            else
                echo '0 results';

        ?>
        </optgroup>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label for="city" class="col-sm-3 control-label">City/Town</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="city" name="city" placeholder="City/Town">
    </div>
   </div>
    <div class="form-group">
    <label for="address1" class="col-sm-3 control-label">Address 1</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="address1" id="address1" placeholder="Address 1">
    </div>
   </div>
    <div class="form-group">
    <label for="address2" class="col-sm-3 control-label">Address 2</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="address2" id="address2" placeholder="Address 2">
    </div>
   </div>
  <div class="form-group">
    <label for="zip" class="col-sm-3 control-label">Zip code</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="zip" name="zip">  
    </div>
  </div>