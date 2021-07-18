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
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo '
            <div class="col-md-12" style="">
            <center>
              <div class="card" style="width: 90%;">
                <center><img src="'.$row["img"].'" class="card-img-top home_img" alt="..."></center>
                <div class="card-body">
                  <p class="card-text">Title:<b> '.$row["title"].'</b></p>
                  <p class="card-text">Desc:<b> '.$row["info"].'</b></p>
                  <p class="card-text">Price:<b> '.$row["price"].'$</b></p>
                  <p class="card-text">Sold:<b> '.$row["sales"].' Times</b></p>
                  <center><button id="'.$row["id"].'" href="#" class="btn btn-danger edit_btn" data-bs-toggle="modal" data-bs-target="#editModal'.$row["id"].'">EDIT</button></center>
                </div>
              </div>
            </div>
            </center>
            <div class="modal fade" id="editModal'.$row["id"].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit: '.$row["title"].'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                  <form id="modalForm'.$row["id"].'" class="modalForm" action="admin.php?edit=1&id='.$row["id"].'" method="POST">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="hidden" class="form-control" name="id" id="title" value="'.$row["id"].'" required>
                      <input type="text" class="form-control" name="title" id="title" value="'.$row["title"].'" required>
                    </div>
                    <div class="mb-3">
                      <label for="info" class="form-label">Describtion</label>
                      <input type="textbox" class="form-control" name="info" id="info" value="'.$row["info"].'" required>
                    </div>
                    <div class="mb-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="number" class="form-control" name="price" id="price" value="'.$row["price"].'" required>
                    </div>
                    <div class="mb-3">
                      <label for="img" class="form-label">Image</label>
                      <input type="text" class="form-control" name="img" id="img" value="'.$row["img"].'" required>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="savebtn'.$row["id"].'"type="submit" class="savebtn btn btn-primary">Save changes</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>


        ';
      }
    } else {
      echo "<h1>No Products Yet</h1>";
    }
  }

// === * Functions ===

// ===== Ajax Requests =====

if (isset($_GET['add'])) {
  $sql = "INSERT INTO products (title, info, price, img)
  VALUES ('".$_POST['title']."', '".$_POST['info']."', '".$_POST['price']."', '".$_POST['img']."')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  die();
}

if (isset($_GET['dashboard'])) {
  getProducts ();
  ?>
  <?php
  die();
}

if ( isset($_GET['edit']) && isset($_GET['id']) ) {
  $sql = "UPDATE products SET title='".$_POST['title']."', info='".$_POST['info']."', price='".$_POST['price']."', img='".$_POST['img']."' WHERE id=".$_GET['id'];

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
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
    <title>Shopping APP Admin</title>


    

    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<meta name="theme-color" content="#7952b3">


    <style>
      .card {
        margin:10px !important;
      }
      .home_img {
        width:250px;
        height:250px;
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
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            
            <div class="row" style="width: 100%;">
              <div class="col-md-8"><span class="fs-4">Admin</span></div>
              <div class="col-md-4" style="text-align: right;">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
            Add Item
          </button>

          <!-- Modal -->
            <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" style="text-align:left;">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                  <form id="addItemModalForm" class="addItemModalForm" action="admin.php?add=1" method="POST">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" id="title" value="" required>
                    </div>
                    <div class="mb-3">
                      <label for="info" class="form-label">Describtion</label>
                      <input type="textbox" class="form-control" name="info" id="info" value="" required>
                    </div>
                    <div class="mb-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="number" class="form-control" name="price" id="price" value="" required>
                    </div>
                    <div class="mb-3">
                      <label for="img" class="form-label">Image</label>
                      <input type="text" class="form-control" name="img" id="img" value="" required>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="addbtn"type="submit" class="savebtn btn btn-primary">Save changes</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>

  </header>

  <div class="row maindashboard">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $( document ).ready(function() {
          console.log( "ready!" );

          $(".modalForm").submit(function(e) {

              e.preventDefault(); // avoid to execute the actual submit of the form.

              var form = $(this);
              var url = form.attr('action');
              
              $.ajax({
                     type: "POST",
                     url: url,
                     data: form.serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                         alert(data); // show response from the php script.
                        $.ajax({url: "admin.php?dashboard=1", success: function(result){
                          $(".maindashboard").html(result);
                          location.reload(true);
                        }});
                     }
                   });
          });         
          // Add Item Modal Submit
            $(".addItemModalForm").submit(function(e) {

              e.preventDefault(); // avoid to execute the actual submit of the form.

              var form = $(this);
              var url = form.attr('action');
              
              $.ajax({
                     type: "POST",
                     url: url,
                     data: form.serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                         alert(data); // show response from the php script.
                        $.ajax({url: "admin.php?dashboard=1", success: function(result){
                          $(".maindashboard").html(result);
                          location.reload(true);
                        }});
                     }
                   });
          });  

      });


    </script>
  </body>
</html>
<?php $conn->close(); ?>
