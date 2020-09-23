<?php
	session_start();
	error_reporting(0);
	$sqli = mysqli_connect("localhost", "root", "", "int_assmnt") or die("Could not connect database...");
	$name = "";
	if(isset($_REQUEST['name'])){
		$name = $_POST['name'];
		mysqli_query($sqli, "INSERT INTO `tbl_list_items` (`id`, `name`, `status`) VALUES (NULL, '$name', '1');");
		$_SESSION['msg'] = "Saved";
		header("location:index.php");

	}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="resources/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="dist/jquery-simple-multi-select.js"></script>
	<link href="resources/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="resources/bootstrap.min.css">
</head>
<body>	
	<div class="container">
		<div>
			<nav class="navbar navbar-expand-lg navbar-light bg-light push-right">
				<a class="navbar-brand" href="#">Logo</a>
				<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">About Us</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="jumbotron" style="background-color: white;">
			<h1>Items Management Page</h1>
		</div>
		<div class="">
			<form method="POST" id="go" action="#">
			<div class="row">
				<div class="col-md-4">
					<input type="text" name="name" id="name" placeholder="Item">
					<button class="btn btn-small" type="button" name="save" style="background: green;" onclick="validate('go')"> Add </button>
				</div>
				<div class="col-md-8">&nbsp;</div>
			</div>
			</br>
			</form>
			<div class="row">
				<div id="callback">
					<div class="col-md-4">
						<select id="callback_src" multiple style="width: 15em; height: 10em;" class="form-control">
						<?php
						$sql = "SELECT * FROM tbl_list_items";
						$list = array();
						if($result = mysqli_query($sqli, $sql))
						{
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{
									$list[] = $row['name'];
								?> <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option><?php 
								}
							}
						}
						?>
						</select>
					</div>
					<div class="col-md-2">
						<button type="button" id="callback_adder" class="btn btn-primary mb-1">&gt;</button>
						<button type="button" id="callback_remover" class="btn btn-primary mb-1">&lt;</button>
					</div>
					<div class="col-md-4">
						<select id="callback_dst" multiple style="width: 15em; height: 10em;" class="form-control"></select>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<script>
	var list = new Array();
	<?php foreach($list as $key => $val)
	{ 
	?>
        list.push('<?php echo $val; ?>');
	<?php 
	} 
	?>
	$('#callback').simpleMultiSelect({
		source: '#callback_src',
		destination: '#callback_dst',
		adder: '#callback_adder',
		remover: '#callback_remover',
	});
	function validate(go)
	{
		var error=false;
		if(document.getElementById('name').value.trim()=='' && error==false)
		{
			error=true;
			alert("Please enter the List Item");
			document.getElementById('name').focus();
		}
		if(document.getElementById('name').value.trim()!='' && error==false)
		{
			if(list.includes(document.getElementById('name').value.trim()))
			{
				error=true;
				alert("Item ALready Exists");
				document.getElementById('name').focus();
			}
		}
		if(!error)
		{
			var confrm=confirm("Please confirm the data before saving"); 
			if(confrm==true)
			{
				document.getElementById(go).submit();
			}
		}
	}
	
	</script>
</body>
</html>