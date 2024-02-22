<?php



//connecting the database

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "notes";

        $conn = mysqli_connect($servername,$username,$password,$database);

        if(!$conn){
            echo "Server Not Connected";

        }


        $insert = false;
        $update = false;
        $delete = false;

        $nameErr = ""; //print the form validation required
        $name = "";

        //delete the data in the table
        if(isset($_GET['delete'])){
          $sno = $_GET['delete'];
          //echo $sno;
        $sql = "DELETE FROM notes WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn,$sql);
        $delete = true;
        }

        //post the form
        if($_SERVER['REQUEST_METHOD']=='POST'){
          
          //edit the data in after clicking data

          if(isset($_POST['snoEdit'])){ //use modal keywords in html & fetching here
          $sno = $_POST['snoEdit'];
          $title = $_POST['titleEdit'];
          $desc = $_POST['descriptionEdit'];
          $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$desc'  WHERE `notes`.`sno` = $sno";
          $result = mysqli_query($conn, $sql);
          if($result){
            $insert = true;
        }
        else{
            echo "Your Value is not Inserted";
        }
          }


          //storing the data into the database
          else{
        
          $title = $_POST['title'];
          $desc = $_POST['description'];

          $sql = "INSERT INTO `notes` (`title`, `description`, `date`) VALUES ('$title', '$desc', current_timestamp())";
          $result = mysqli_query($conn, $sql);

          if($result){
                $insert = true;
          }
          
        }
      }

      


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    

    <title>CRUD Operation</title>
    
  </head>
  <body>
  

<!-- Modal --> <!--first you can change modal id -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Please Edit Your Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- modal form submitting -->
      <div class="modal-body">
        <form action="/PHP_TUT/CRUD.php" method = "POST">
          <input type="hidden" name="snoEdit" id="snoEdit" >
          <h2>Notes </h2>
        <div class="form-group">
          <label for="title">Note Title</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit">
          <span class="error">* <?php echo $nameErr;?></span>
        </div>
      
       <div class="form-group">
          <label for="exampleFormControlTextarea1">Note Description</label>
          <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- navbar  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">CRUD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!-- showing popup message  -->
<?php
    if($insert){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Note !</strong> Submitted Successfully
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if($update){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Note !</strong> Updated Successfully
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if($delete){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Note !</strong> Deleted Successfully
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }

?>

<!-- main form  -->

<div class="container my-4">
<form action="/PHP_TUT/CRUD.php" method = "POST">
    <h2>Notes </h2>
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" id="title" name="title">
    <span class="error">* <?php echo $nameErr;?></span>
  </div>

 <div class="form-group">
    <label for="exampleFormControlTextarea1">Note Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>

    <div class="container">
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php

  //storing the data in the form of table

    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn, $sql);
    $srno = 0;
    while($row = mysqli_fetch_assoc($result)){
        // echo var_dump($row);
        $srno = $srno + 1;
       echo' <tr>
      <th scope="row">'.$srno.'</th>
      <td>'.$row['title'].'</td>
      <td>'.$row['description'].'</td>
      <td><button class="edit btn btn-sm btn-primary" id=' .$row['sno']. '>Edit</button> <button class="delete btn btn-sm btn-primary" id=d' .$row['sno']. '>Delete</button>';
    }

    ?>
    
    
  </tbody>
</table>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- jquery inserted here for the table. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- datatables using by jquery -->
    <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable');
    </script>

    <!-- fetching edit element by the javascript  -->
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle')
        
      })
    })

    // <!-- fetching delete element by the javascript  -->

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/PHP_TUT/CRUD.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
  </body>
</html>