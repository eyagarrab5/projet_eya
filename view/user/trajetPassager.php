<?php

include '../../controller/UserC.php';
include '../../controller/TrajetC.php';


$UserC = new UserC();
$trajetC= new TrajetC();
session_start();
$id= $_SESSION["iduser"];
$user=$UserC->findUserById($id);
$searchValue = isset($_POST['search']) ? $_POST['search'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : '';


if (!empty($searchValue)) {
  $list = $trajetC->searchTrajets($searchValue);
} else if ($sort === 'date' || $sort === 'price') {
  $list = $trajetC->getAllSortedBy($sort);
} else {
    $list = $trajetC->getAll();
    }


 



?>



<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Rent4u</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/styl.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <span>
              covoiturage
            </span>
          </a>

        
            <div class="navbar-collapse" id="">
            <div class="user_option">
              <a href="">
                Welcome   <?php echo $user['firstName'];?>
              </a>
              <a href="../login.php" style="color:red;">
                logout
              </a>
            </div>
           
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div class="slider_container">
        <div class="img-box">
          <img src="images/hero-img.jpg" alt="">
        </div>
        <div class="detail_container">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="detail-box">
                  <h1>
                    Rent Car <br>
                    Experts <br>
                    Service
                  </h1>
                  <a href="">
                    Contact Us
                  </a>
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h1>
                    Rent Car <br>
                    Experts <br>
                    Service
                  </h1>
                  <a href="">
                    Contact Us
                  </a>
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h1>
                    Rent Car <br>
                    Experts <br>
                    Service
                  </h1>
                  <a href="">
                    Contact Us
                  </a>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
      </div>
    </section>

  </div>

  
  <section class="client_section layout_padding">
 
    <div class="container">
    <form id="searchForm" method="POST" action="">
          <div class="row">
              <div class="col-md-2">
                  <input type="text" name="search" placeholder="Search..." class="form-control" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
              </div>
              
              <div class="col-md-3">
          <select name="sort" class="custom-select">
            <option value="">Sort By</option>
            <option value="date" <?php echo isset($_POST['sort']) && $_POST['sort'] === 'date' ? 'selected' : ''; ?>>Date</option>
            <option value="price" <?php echo isset($_POST['sort']) && $_POST['sort'] === 'price' ? 'selected' : ''; ?>>Price</option>
          </select>
        </div>
        <div class="col-md-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
      </form>
      <div class="heading_container">
   
      <h2>List des trajets</h2>
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Conducteur ID</th>
                    <th>Number of Places</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $trajet){
                  ?>
                <tr>
                    
                    <td><?php echo $trajet['departure']; ?></td>
                    <td><?php echo $trajet['destination']; ?></td>
                    <td><?php echo $trajet['date']; ?></td>
                    <td><?php echo $trajet['price']; ?></td>
                    <td><?php echo $trajet['conductuer_id']; ?></td>
                    <td><?php echo $trajet['nb_place']; ?></td>
                    <td><a href="reservationPassager.php?id=<?php echo $trajet['id']; ?>" class="action-btn">about</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
  </section>


  <footer class="container-fluid footer_section">
    <p>
      Copyright &copy; 2020 All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </footer>
  <!-- footer section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>


</body>

</html>