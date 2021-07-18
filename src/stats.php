<?php 
//Set Default Time Zone
 date_default_timezone_set("Asia/Jerusalem");

 
// === Connect To Database === 
$servername = "db";
$username = "zero";
$password = "a123123a";
$dbname = "myweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// === * Connect To Database === 

// === Functions ===
	
  function getProducts () {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY sales DESC LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo '
        <h6 class="card-title">'.$row["title"].' &nbsp;-&nbsp; '.$row["sales"].'</h6>

        ';
      }
    } else {
      echo "<h2> No Products Yet </h1>";
    }
  }

  function getUniqueProducts () {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY unique_sale DESC LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo '
          <h6 class="card-title">'.$row["title"].' &nbsp;-&nbsp; '.$row["unique_sale"].'</h6>

        ';
      }
    } else {
      echo "<h2> No Unique Products Yet </h1>";
    }
  }

  function getSales () {
    global $conn;
    $sql = "SELECT * FROM orders ORDER by date DESC LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<h6>".date('Y/m/d', $row['day'])." - ".$row['total']."$</h6>";
      }
    } else {
      echo "0 results";
    }
  }

// === * Functions ===

// ===== Ajax Requests =====


// ===== * Ajax Requests =====


// print_r($_SESSION);

 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Shopping APP Stats</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">



<meta name="theme-color" content="#7952b3">


    <style>
      .card {
        margin:10px !important;
      }
      .home_img {
        width:150px;
        height:150px;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .shopping_cart {
        padding:15px;
      }
      .shopping_cart .col-md-4 {
        padding-top:10px !important;
      }
      .dropdown-menu.show {
        /*margin-left: 10px !important;*/
        width: 70%;
      }
      .edit_btn {
        width:60%;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./dist/css/starter-template.css" rel="stylesheet">
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            
            <div class="row" style="width: 100%;">
              <div class="col-md-8"><span class="fs-4">Stats</span></div>
              <div class="col-md-4" style="text-align: right;"></div>

  </header>

<div class="row">
  <div class="col-md-4">
    <h3>Top 5 Sell</h3>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <?php getProducts(); ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <h3>Top 5 Unique Sell</h3>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <?php getUniqueProducts(); ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <h3>latest 5 orders</h3>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <?php getSales(); ?>
      </div>
    </div>
  </div>
</div>

</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

  </body>
</html>
<?php $conn->close(); ?>
