    <div id="leftNav">
      <ul id="ulLeftNav">
          <?php
            require_once 'config.php';
            
            $conn = Connection::connectToDB();
          
            $sql = "SELECT category FROM category ORDER BY category ASC";
            $result = $conn->query($sql);
          
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($category == $row["category"]) // kliknata kategorija ke bide obelezana poinaku
                        echo '<li class="underlined">' . $row["category"] . "</li>";
                    else
                    echo '<li>'.$row["category"]."</li>";
                }
            }else {
                echo "0 results";
            }
          
            mysqli_close($conn);
          ?>    
      </ul>    
    </div>