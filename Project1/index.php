<?php 
  include 'upload.php'; 

  // get event attributes from 'events' database
  $eventsResult = $conn->query("SELECT * FROM events ORDER BY publishDate DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>ShowShouts</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="css/clean-blog.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/Project1/index.php">ShowShouts</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/Project1/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post.html">Shout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal HTML Markup -->
<div id="ModalAddPost" class="modal fade">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h1 id="modal-title" class="modal-title">Add A Show</h1>
          </div>
          <div class="modal-body">
            <?php if(!empty($statusMsg)) { ?>
                <p class="status <?php echo $status; ?>"><?php echo $statusMsg; ?></p>
            <?php } ?>
              <form id="showForm" name="showForm" method="POST" onsubmit="this.submit();this.reset(); return false;"action="" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="">
                  <div class="form-group">
                      <div>
                        <label for="image"></label>
                          <input id="image" type="file" class="form-control input-lg" name="image" value="Image">
                      </div>
                  </div>
                  <div class="form-group">
                      <div>
                        <label for="eventName"></label>
                          <input id="eventName" type="text" class="form-control input-lg" name="eventName" placeholder="Event Name">
                      </div>
                  </div>
                  <div class="form-group">
                      <div>
                        <label for="artist"></label>
                          <input id="artist" type="text" class="form-control input-lg" name="artist" placeholder="Artist">
                      </div>
                  </div>
                  <div class="form-group">
                      <div>
                          <label for="description"></label>
                          <input id="description" type="text" class="form-control input-lg" name="description" placeholder="Brief Description">
                      </div>
                  </div>
                  <div class="form-group">
                      <div>
                          <label for="fullContent"></label>
                          <textarea id="fullContent" type="text" class="form-control input-lg" name="fullContent" placeholder="Say something about the show..." rows="7"></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <div style="display:flex;justify-content: center;">
                          <input type="submit" value="Upload" name="submit" class="btn btn-primary"></imput>
                      </div>
                  </div>
              </form>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/festival.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Say. It. Loud.</h1>
            <span class="subheading">Live Music Reviews All in One Place</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <button type="button" class="addShowBtn" data-toggle="modal" data-target="#ModalAddPost"> + Add Show</button>
      <div class="col-md-10 mx-auto">                 
        <!-- retrieve event info -->
        <?php
           if ($eventsResult->num_rows > 0)
           {
               while ($row = $eventsResult->fetch_assoc()) 
               {
                ?>
                <div id="event" class='post-preview' style="display:flex">
                  <div class="event-thumbnail">
                    <img class="event-thumbnail" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>"/>
                  </div>  
                  <div class="post-text">
                    <a href=post.html>
                      <h2 class='post-title'>
                        <?php
                          echo $row["title"];
                          ?>
                      </h2>
                      <h3 class='post-subtitle'>
                        <?php
                          echo $row["content"];
                          ?>
                      </h3>
                    </a>
                    <p class="pub-info">
                  <?php
                    echo "Published by " . $row["artist"] . " on " . $row["publishDate"];
                  ?>
                </p>
                  </div>
                </div>
                <hr class="mg-y">
                <?php
               }
           }
        ?>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Shows &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; ShowShouts 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
