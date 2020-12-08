<?php
// INSERT INTO `take_notes` (`sl no`, `note_title`, `note_desc`, `time_stamp`) VALUES (NULL, 'Lear PHP', 'Learn PHP hard you have things to achieve', CURRENT_TIMESTAMP);
$insert = false;
$update = false;
$delete = false;
//connecting to database
$servername = "localhost";
$username = "jugal";
$password = "Sorbhog@2017";
$database = "notes";

//create connection to database
$con = mysqli_connect($servername, $username, $password, $database);

//die if connection was not successful
if(!$con){
  die("Sorry we failed to connect: " . mysqli_connect_error($con));
}
else{
  // echo "connection was successful";
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['snoEdit'])){
    // echo "Yes";
    $sno = $_POST["snoEdit"];
    $note_title = $_POST["note_titleEdit"];
    $note_desc = $_POST["note_descEdit"];

    //sql query to be executed
    $sql = "UPDATE `take_notes` SET `note_title` = '$note_title', `note_desc` = '$note_desc' WHERE `take_notes`.`sl no` = $sno";
    $result = mysqli_query($con, $sql);
    $update = true;
  }
  else{
    $note_title = $_POST["note_title"];
    $note_desc = $_POST["note_desc"];

    //sql query to be executed
    $sql = "INSERT INTO `take_notes` (`note_title`, `note_desc`, `time_stamp`) VALUES ('$note_title', '$note_desc', CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $sql);

    if($result){
      $insert = true;
    }
    else{
      // echo "Data is not inserted due to this error ----->" . mysqli_erro($con);
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
    </script>

    <title>Project - 1 PHP CRUD</title>
  </head>
  <body>

    <!-- This is edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"> -->
  <!-- Edit Modal -->
</button>

<!--This is edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/index.php" method="post">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="mb-3">
            <label for="note_title" class="form-label">Note title</label>
            <input
              type="text"
              name="note_titleEdit"
              class="form-control"
              id="note_titleEdit"
              aria-describedby="emailHelp"
              required
            />
          </div>
          <div class="mb-3">
            <label for="note_desc" class="form-label">Note description</label>
            <textarea
              class="form-control" name="note_descEdit" id="note_descEdit" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update note</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Project - 1</a>
      </div>
    </nav>

    <?php
      if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success</strong> Note added successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success</strong> Note updated successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($delete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success</strong> Note added successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      // else{
      //   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      //   <strong>Error</strong> no notes are added
      //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      // </div>';
      // }

    ?>

    <div class="container mt-5">
      <h2>Add notes heres</h2>
      <form action="index.php" method="post">
        <div class="mb-3">
          <label for="note_title" class="form-label">Note title</label>
          <input
            type="text"
            name="note_title"
            class="form-control"
            id="note_title"
            aria-describedby="emailHelp"
            required
          />
        </div>
        <div class="mb-3">
          <label for="note_desc" class="form-label">Note description</label>
          <textarea
            class="form-control" name="note_desc" id="note_desc" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add note</button>
      </form>
    </div>

    <div class="container mt-5 mb-5">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Sl NO.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
  $sql = "SELECT * FROM `take_notes` ";
  $result = mysqli_query($con, $sql);
  $sno = 0;
  while($row = mysqli_fetch_assoc($result)){
    $sno = $sno + 1;
    echo '<tr>
    <th scope="row">'. $sno .'</th>
    <td>'. $row['note_title'] .'</td>
    <td>'. $row['note_desc'] .'</td>
    <td><button class="edit btn btn-sm btn-primary" id='.$row['sl no'].'>Edit</button> <button class="delete btn btn-sm btn-primary" id=d'.$row['sl no'].'>Delete</button></td>
  </tr>';
  }
        ?>
        </tbody>
      </table>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"
    ></script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click", (e)=>{
          console.log("edit ", );
          tr = e.target.parentNode.parentNode;
          note_title = tr.getElementsByTagName("td")[0].innerText;
          note_desc = tr.getElementsByTagName("td")[1].innerText;
          console.log(note_title, note_desc);
          note_titleEdit.value = note_title;
          note_descEdit.value = note_desc;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click", (e)=>{
          console.log("edit ", );
          sno = e.target.id.substr(1);
          if(confirm("Are you sure? You want to delete this note!")){
            console.log("yes");
            window.location = `/index.php?delete=${sno}`;
          }
          else{
            console.log("no");
          }
        })
      })
    </script>

  </body>
</html>
