<?php
error_reporting();
// require('db.php');
$servername = "localhost";
$username = "root";
$password = "";
$db = "int_assmnt";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// define variables and set to empty values


    $name = test_input($_POST["name"]);
    $query = "insert into tbl_list_items (id,name,status) values('','$name','1')";
	$result = mysqli_query($conn,$query);
	if($result)
		echo "1";
	else
		echo "0";
    // if(isset($_REQUEST['save'])){
    //     $ins_qry = "INSERT INTO `tbl_list_items` (`id`,`name`, `status`) VALUES ('','$name','1')";
    //     mysqli_query($conn,$ins_qry);
    // }



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="resources/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="dist/jquery-simple-multi-select.js"></script>
  <link href="resources/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="resources/bootstrap.min.css">

  <title></title>
  
</head>
<body>
  
  <div class="container">
    <form action="#" method="POST">
        <div class="row">
        <div class="col-md-4">
            <input type="text" name="name" id="name" placeholder="Item">
            <button class="btn  btn-default" type="submit" name="save" onclick="clear()"> Add </button>
        </div>
        </div>
    </form>
    <div id="callback">
      <div>
        <select id="callback_src" multiple style="width: 7em; height: 10em;" class="form-control">
        <?php
        $sql = "SELECT * FROM tbl_list_items";
        if($result = mysqli_query($conn, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                 ?> <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option><?php 
                }
            }
        }
        ?>
        </select>
      </div>
      <div>
        <div><button type="button" id="callback_adder" class="btn btn-primary mb-1">&gt;</button></div>
        <div><button type="button" id="callback_remover" class="btn btn-primary mb-1">&lt;</button></div>
      </div>
      <div>
        <select id="callback_dst" multiple style="width: 7em; height: 10em;" class="form-control"></select>
      </div>
    </div>
    <!-- <div id="callback_message" class="alert alert-danger mt-3"></div> -->
  
  <script>
  $('#callback').simpleMultiSelect({
    source: '#callback_src',
    destination: '#callback_dst',
    adder: '#callback_adder',
    remover: '#callback_remover',
    
  });
  
  </script>
</div>

</script>
</body>
</html>
