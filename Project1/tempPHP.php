        <?php
              function getEvents() {
                $dbHost = "localhost";
                $dbUser = "root";
                $dbPass = "";
                $dbName =  "showshouts";
            
            
                // Databse connection
                $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            
                // check connection
                if(!$conn){
                    die("Connection Failed: " . mysqli_connect_error());
                }
        
                $sql_query = "SELECT * FROM events ORDER BY publishDate DESC";
                $result = $conn->query($sql_query);

                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc()) 
                    {
                        echo "<div class='post-preview'>";
                          echo "<a href=post.html>";
                            echo "<h2 class='post-title'>";
                              echo $row["title"];
                              echo "</h2>";
                              echo "<h3 class='post-subtitle'>";
                              echo $row["content"];
                              echo "</h3>";
                            echo "</a>";
                          echo "<p class='post-meta'>";
                            echo "Published by " . $row["artist"] . " on " . $row["publishDate"];
                          echo "</p>";
                        echo "</div>";
                        echo "<hr>";
                    }
                }
                else 
                {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
          echo getEvents();
          ?>