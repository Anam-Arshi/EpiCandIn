<?php
session_start();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
	main{
		padding: 5px;
	}	
	.s-table{
		margin-bottom: 15px;
	}
	a{
		
	}
</style>
</head>

<body>
<?php
include("header2.php");	
?>
<main>
<?php
if(isset($_POST["term"])){
	$qry1 = $_POST["term"]; 
	$qry = strtolower($_POST["term"]);
	
	
	if($qry == "candida"){
		
		$cols ="";
	}
	else{
		$cols ="where Species_Prevalence LIKE '%$qry%' OR Niche_Infected LIKE '%$qry%' OR Location LIKE '%$qry%'";
	}
	$_SESSION["qry"]= $qry;
	
	?>
	
	<h4 align="center"><?php echo "Query term: ".$qry1; ?></h4>
	<?php
	include("connect.php");     
	
/*	$qst = "select distinct study_ids from data where $cols";
	$res_stid = mysqli_query($conn, $qst);
	$cnt_stid = mysqli_num_rows($res_stid);
	*/
	#$res = mysqli_query($conn, "SELECT EXISTS(SELECT 1 FROM sps_prevalence WHERE Study_ids = '$stid' LIMIT 1);");
	
	$res_stid = mysqli_query($conn, "select distinct study_ids from data $cols");
	$cnt_stid = mysqli_num_rows($res_stid);
	
	$res_sp = mysqli_query($conn, "select distinct study_ids from sps_prevalence where species LIKE '%$qry%' LIMIT 1");
	$cnt_sp = mysqli_num_rows($res_sp);
	
	$res_ni = mysqli_query($conn, "select distinct study_ids from niche_infected where niche LIKE '%$qry%' LIMIT 1");
	$cnt_ni = mysqli_num_rows($res_ni);
	
	$res_st = mysqli_query($conn, "select distinct study_ids from state_city where city LIKE '%$qry%' OR state_ut LIKE '%$qry%' LIMIT 1");
	$cnt_st = mysqli_num_rows($res_st);
	?>
	<br/>
	
	<table align="center" class="s-table" border="0" cellpadding="5">
	<tr>
	<td width="300px">No. of studies</td>
	
	<td><?php if($cnt_stid > 0){echo "<a href='result.php?val=study_ids' target='_blank'>$cnt_stid</a>";} else{ echo "0";} ?></td>	
	</tr>	
	<tr>
	<td width="300px">No. of species</td>
	
	<td><?php if($cnt_sp > 0){echo "<a href='result.php?val=Species_Prevalence' target='_blank'>$cnt_sp</a>";} else{ echo "0";} ?></td>	
	</tr>
	<tr>
	<td width="300px">No. of infected sites</td>
	
	<td><?php if($cnt_ni > 0){ echo "<a href='result.php?val=Niche_Infected' target='_blank'>$cnt_ni</a>";} else{ echo "0";} ?></td>	
	</tr>
	<tr>
	<td width="300px">No. of states</td>
	
	<td><?php if($cnt_st > 0){ echo "<a href='result.php?val=Location' target='_blank'>$cnt_st </a>" ;} else{ echo "0";}?></td>	
	</tr>
	</table>
	
	<?php
	
	

 }

?>
</main>

<?php 
include("footer.php"); 
?>
</body>
</html>