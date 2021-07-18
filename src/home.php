<?php 
//Set Default Time Zone
 date_default_timezone_set("Asia/Jerusalem");

// === Cart Session Start ===
  session_start();
  //initialize cart if not set or is unset
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }
 
  //unset quantity
  unset($_SESSION['qty_array']);
// === * Cart Session Start ===

// === Connect To Database === 
$servername = "db";
$username = "root";
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
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo '
            <div class="col-md-3">
              <div class="card shadow" style="width: 18rem;">
                <center><img src="'.$row["img"].'" class="card-img-top home_img" alt="..."></center>
                <div class="card-body">
                  <p class="card-text">Title: '.$row["title"].'</p>
                  <p class="card-text">Desc: '.$row["info"].'</p>
                  <p class="card-text">Price: '.$row["price"].'$</p>
                  <center><button id="'.$row["id"].'" href="#" class="btn btn-primary buy_btn shadow">Buy</button></center>
                </div>
              </div>
            </div>
        ';
      }
    } else {
      echo "<h1>No Products Yet<h1>";
    }
  }
  
  function getCartTotalPrice () {
    global $conn;
    $total_price = 0;
    foreach($_SESSION['cart'] as $value){

      $sql = "SELECT * FROM products WHERE id='".$value."'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $total_price =  $total_price + $row["price"];
        }
      } else {
        echo "0 results";
      }

      } return $total_price;
  }
  function addToCart ($id) {
      array_push($_SESSION['cart'], $id);
      // enable file already in cart
      // if(!in_array($id, $_SESSION['cart'])){
      //     array_push($_SESSION['cart'], $id);
          $_SESSION['message'] = 'Product added to cart';
      //   }
      //   else{
      //     $_SESSION['message'] = 'Product already in cart';
      //   }
        
      }

  function deleteFromCart ($id) {
      // array_push($_SESSION['cart'], $id);
      // $array = $_SESSION['cart'];
      $delete_value = $id;
      if(($key = array_search($delete_value, $_SESSION['cart'])) !== false) {
          unset($_SESSION['cart'][$key]);
      }
      $_SESSION['message'] = 'Product deleted from cart';;            
  }

      
  function makeOrder ($orderArray) {
    global $conn;
    $error = 0;
    foreach ($orderArray1 as $item)  {

      // == get latest sale ==
        $sql = "SELECT * FROM products WHERE id='".$item."'";
        // echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $sales = $row['sales'];
            $sales++;
            // echo $sales;
          }
        }
      // == * get latest sale ==

      // == update sales ==
        $sql = "UPDATE products SET sales='".$sales."' WHERE id=".$item;

        if ($conn->query($sql) === TRUE) {
          echo "";
        } else {
          echo "Error updating record: " . $conn->error;
        }
      // == * update sales ==

    }
      $uniqueOrderArray =  array_unique($orderArray);
      foreach ($uniqueOrderArray as $item)  {
      // == get latest unique ==
        $sql = "SELECT * FROM products WHERE id='".$item."'";
        // echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $unique_sale = $row['unique_sale'];
            $unique_sale++;
            // echo $unique_sale;
          }
        }
      // == * get latest unique ==
      
      // == update latest unique ==
        $sql = "UPDATE products SET unique_sale='".$unique_sale."' WHERE id=".$item;

        if ($conn->query($sql) === TRUE) {
          echo "";
        } else {
          echo "Error unique record: " . $conn->error;
        }
      // == * update latest unique ==
      }
      
       $sql = "INSERT INTO orders (item, date, day, total) VALUES ('".$item."', '".strtotime(date("Y/m/d H:i:s"))."', '".strtotime(date("Y/m/d"))."', '".getCartTotalPrice ()."')";
       // print_r($sql);
        if ($conn->query($sql) === TRUE) {
          
        } else {
          $error++;
        }

    if ($error == 0) { echo "Payment Successful"; session_unset(); } else { echo $error; }
  }


// === * Functions ===

// ===== Ajax Requests =====
if (isset($_GET['makeOrder'])) {
  $order_done = makeOrder ($_SESSION['cart']);
  // print_r($_SESSION['cart']);
  die($order_done);
}

if ( isset($_GET['cart']) && isset($_GET['getitems']) ) {
  print_r(json_encode($_SESSION['cart']));
  die();
}

if (isset($_GET['cart']) && isset($_GET['count'])) {
  echo count($_SESSION['cart']);
  die();
}

if ( isset( $_GET['cart'] ) && isset( $_GET['id'] ) ) {
  addToCart ($_GET['id']);
  die($_SESSION['message']);
}

if ( isset( $_GET['delete'] ) && isset( $_GET['id'] ) ) {
  deleteFromCart ($_GET['id']);
  die($_SESSION['message']);
}

if ( isset( $_GET['cart'] ) && isset( $_GET['view'] ) ) {
  ?>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <?php
        $total = 0;
        if(!empty($_SESSION['cart'])){
          //create array of initail qty which is 1
          $index = 0;
          // if(!isset($_SESSION['qty_array'])){
          //   $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
          // }
            $total_price = 0;
        foreach($_SESSION['cart'] as $value){

          $sql = "SELECT * FROM products WHERE id='".$value."'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '
                      <div class="row" style="margin-top:3px;">
                        <div class="col-md-6">'.$row["title"].'</div>
                        <div class="col-md-4">'.$row["price"].'$</div>
                        <div class="col-md-2"><a id="'.$row["id"].'"  class="delbtn btn btn-danger btn-sm">X</a></div>
                      </div>
              ';
              $total_price =  $total_price + $row["price"];
            }
          } else {
            echo "0 results";
          }

          }
                      echo '<script>          $(".delbtn").click(function(event) {
              $.ajax({url: "home.php?delete&id="+event.target.id, success: function(result){
                $.fn.getCart();
                alert(result);
              }});
              // alert(event.target.id);
          });</script>';
                                  echo '
                    </div>

                    <div class="row" style="padding-top:40px; padding-left:12px;">
                      <div class="col-md-8"><b>Total</b></div>
                      <div class="col-md-4"><b>'.$total_price.'$</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="text-align: center; padding-top:30px;"><button type="button" id="pay_btn" class="pay_btn btn btn-primary" style="width:80%;">Pay</button></div>
                    </div>
            ';
        } else echo '<h3>No Items</h3>';
        ?>
            <script>
      $( document ).ready(function() {
          $("#pay_btn").click(function(event) {
              $.ajax({url: "home.php?makeOrder=1", success: function(result){
                alert(result);
                $.fn.getCart();
              }});
              // alert(event.target.id);
          });


      });


    </script>
        <?php
        die();
}

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
    <title>Shopping APP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<meta name="theme-color" content="#7952b3">


    <style>
      .card {
        margin:10px !important;
      }
      .home_img {
        width:200px;
        height:200px;
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
      .dropdown-menu.show {
        /*margin-left: 10px !important;*/
        width: 100%;
        font-size:14px;
      }
      .buy_btn {
        width:60%;
      }
    </style>

    
    <!-- Custom styles for this template -->
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            
            <div class="row" style="width: 100%;">
              <div class="col-md-8"><span class="fs-4">Home</span></div>
              <div class="col-md-4" style="text-align: right;">
                <div class="dropdown">
                  <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Shopping Cart
                    <span class="badge bg-danger cart_item_num"><?php echo count($_SESSION['cart']); ?></span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    <div class="row shopping_cart">
                      <!-- Shopping Cart Item -->
                      <div class="col-md-8">item 1</div>
                      <div class="col-md-4">3$</div>
                      <!-- * Shopping Cart Item -->

                      <!-- Shopping Cart Item -->
                      <div class="col-md-8">item 1</div>
                      <div class="col-md-4">3$</div>
                      <!-- * Shopping Cart Item -->

                      <!-- Shopping Cart Item -->
                      <div class="col-md-8">item 1</div>
                      <div class="col-md-4">3$</div>
                      <!-- * Shopping Cart Item -->



                  </div>
                </div>
              </div>
            </div>
  </header>

  <div class="row">
<?php // remove all session variables
// session_unset();  ?>
    <?php getProducts (); ?>
  <!-- Home Element -->
<!--     <div class="col-md-3">
      <div class="card" style="width: 18rem;">
        <img src="https://i.stack.imgur.com/y9DpT.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Title: </p>
          <p class="card-text">Desc: </p>
          <p class="card-text">Price: </p>
          <center><button href="#" class="btn btn-primary buy_btn">Buy</button></center>
        </div>
      </div>
    </div> -->
  <!-- * Home Element -->

  </div>

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $( document ).ready(function() {
          console.log( "ready!" );

          $.fn.getCart = function() { 
             $.ajax({url: "./home.php?cart&view=1", success: function(result){
               $(".shopping_cart").html(result);
             }});
             $.ajax({url: "./home.php?cart&count=1", success: function(result){
               $(".cart_item_num").html(result);
             }});
            }
            $.fn.getCart(); // Get Cart

          $(".buy_btn").click(function(event) {
              $.ajax({url: "home.php?cart&id="+event.target.id, success: function(result){
                $.fn.getCart();
                alert(result);
              }});
              // alert(event.target.id);
          });

      });


    </script>
      
  </body>
</html>
<?php $conn->close(); ?>
