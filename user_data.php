<?php
session_start();

?> 

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
	
<style>
	main{
		padding: 5px;
	}	
</style>

</head>

<body>
<?php
include("header2.php");	
?>
	
<main>
<?php
include("connect.php");



// Check if form has been submitted
if (isset($_POST['submit'])) {
	
$name  = $_POST['nm'];
#echo $name;
$aff  = $_POST['aff'];
$title = $_POST['title'];
$aim = $_POST['aim'];
$pub = $_POST['pub'];
if($pub == "yes"){
	$pmid = $_POST['pmid'];
	$jrn = $_POST['jrn_yp'];
}
else{
	$pmid = "Not given";
	$jrn = "Not given";
}
#echo $pmid;

$durtn = $_POST['duratn'];


$stdes = "";
	$cntt=0;
	if(isset($_POST['st_des'])){
	
    foreach($_POST['st_des'] as $val ){
	if($val != "other"){
	if($cntt==0){
		$stdes = $val;
	}
	else{
	$stdes = $stdes.", ".$val;
	}
	$cntt++;
	}
	else{
		$other_stdes = $_POST["other_StuDes"];
		$stdes =$stdes.", ".$other_stdes;
	}
	
	}
		
}
#echo $stdes;

$setup = "";
$cnt=0;
	if(isset($_POST['setup'])){
	
    foreach($_POST['setup'] as $v ){
	if($v != "other"){
	if($cnt==0)
	{
		$setup=$v;
	}
		else{
			$setup=$setup.", ".$v;
		}
		
		$cnt++;
	}
	else{
		$other_set = $_POST["other_Setup"];
		$setup =$setup.", ".$other_stdes;
	}
	
}
	
	}	
	

	
	
$loc = $_POST['loca'];
if(isset($_POST['ethn'])){
$ethn = $_POST['ethn'];
}
else{
	$ethn = "Not given";
}
	

if(isset($_POST['risk'])){
	
    foreach($_POST['risk'] as $v ){
	if($v != "other"){
	$risk[] = $v;
	}
	else{
		$other_risk = $_POST["other_risk"];
		$risk[] = $other_risk;
	}
	
}
	$riskk = implode(", ", $risk);
	}		
	
	
$comorbidity = $_POST['comorb'];
if(isset($comorbidity)){
	
    foreach($comorbidity as $v ){
	if($v != "other"){
	$comorb[] = $v;
	}
	else{
		$other_com = $_POST["other_com"];
		$comorb[] = $other_com;
	}
	
}
	$como = implode(", ", $comorb);
	}			

$typcan = $_POST['typ_can'];
if(isset($typcan)){
	
    foreach($typcan as $v ){
	if($v != "other"){
	$typ[] = $v;
	}
	else{
		$other_typcan = $_POST["other_typcan"];
		$typ[] = $other_typcan;
	}
	
}
	$typ_can = implode(", ", $typ);
	}			

$niche = $_POST['niche'];
if(isset($niche)){
	
    foreach($niche as $v ){
	if($v != "other"){
	$nich[] = $v;
	}
	else{
		$other_nic = $_POST["other_nic"];
		$nich[] = $other_nic;
	}
	
}
	$nic = implode(", ", $nich);
	}	
	
$symp = $_POST['symp'];
if(isset($symp)){
	
    foreach($symp as $v ){
	if($v != "other"){
	$sympt[] = $v;
	}
	else{
		$other_symp = $_POST["other_symp"];
		$symp[] = $other_symp;
	}
	
}
	$symptoms = implode(", ", $symp);
	}		
	
$anti = $_POST['anti'];
if($anti == "yes"){
	$drug = $_POST['drugDtl'];
	$route = $_POST['route'];
	$dose = $_POST['dose'];
	
	for($p=0; $p<count($drug); $p++){
		
		$drgArr[] = $drug[$p].'('.$route[$p]."):".$dose[$p];
	}
	
	$drugDet = implode(', ', $drgArr);

}
else{
	$drugDet = "Not given";
}

$age = $_POST['age'];
	

if(isset($_POST['male'])){
	$male = $_POST['male'];
	if($male != ''){
	$gender = "Male:".$male;
	}
}

if(isset($_POST['female'])){
	$female = $_POST['female'];
	if($female != ""){
	$gender .= "Female:".$female;
	}
}
if(isset($_POST['otherGen'])){
	$other = $_POST['otherGen'];
	if($other != ""){
    $gender .= "Other:".$other;
	}
}

if(!isset($gender)){
	$gender = 'Not given';
}
	
$no_pat = $_POST['no_pat'];
$no_sam = $_POST['no_sam'];
$no_can = $_POST['no_can'];
$inf_pre = $_POST['inf_pre'];
if(isset($_POST['col_pre']))
{
$col_pre = $_POST['col_pre'];
}
else{
	$col_pre = "Not given";
}

$mort = $_POST['mortal'];
	
	
$sps_pre = $_POST['sps_pre'];
	
$ident = $_POST['ident'];
if(isset($ident)){
	
    foreach($ident as $v ){
		
	if($v == 'Culture'){
			$cul = $_POST['cul'];
		    $iden[] = $v."-".$cul;
		}
	else if($v == 'Automated VITEK system'){
			$vit = $_POST['vit'];
		    $iden[] = $v.'-'.$vit;
	}
	else if($v != "other"){
	$iden[] = $v;
	} 
	else{
		$other_ide = $_POST["other_IdeMet"];
		$iden[] = $other_ide;
	}
	
}
	$sps_id = implode(", ", $iden);
	}	
	else{
	$sps_id = "Not given";
	
}

	$input = $_POST['prevInput'];
	
	$sps = $_POST['spsName'];
	
	for($p=0; $p<count($input); $p++){
		
		$sps_prev[] = $sps[$p].'-'.$input[$p];
	}
	$sps_pre = implode(', ', $sps_prev);

	
	
if(isset($_POST['asp']))
{
$asp = $_POST['asp'];
$drug = $_POST['drug'];
$act = $_POST['act'];
for($p=0; $p<count($asp); $p++){
		
		$aspArr[] = $asp[$p].'_'.$drug[$p].":".$act[$p];
	}
	
	$aspDtl = implode(', ', $aspArr);	
	
	
}
else{
	$aspDtl = "Not given";
	
}

$asp = "Not given";
	
	
	
$ast = $_POST['ast'];
if(isset($ast)){
	
    foreach($ast as $v ){
		
    if($v == 'autovitekt'){
		$vitt = $_POST['vitt'];
		$asts[] = $v."-".$vitt;
		
	}
	else if($v == 'ddm'){
		$ddm = $_POST['ddm'];
		$asts[] = $v."-".$ddm;
		
	}else if($v == 'bmm'){
			$bmm = $_POST['bmm'];
		    $asts[] = $v."-".$bmm;
		}
	else
	if($v != "other"){
	$asts[] = $v;
	}
	else{
		$other_ast = $_POST["other_astTest"];
		$asts[] = $other_ast;
	}
	
}
	$astTest = implode(", ", $asts);
	}
	else{
		$astTest = "Not given";
	}




	$sql = "INSERT INTO user_data  VALUES ('$aff',
            '$name','$title','$aim','$pmid', '$jrn', '$durtn', '$stdes', '$setup', '$loc', '$ethn', '$riskk', '$como', '$typ_can', '$nic', '$symptoms', '$drugDet', '$age', '$gender', '$no_pat', '$no_sam', '$no_can', '$inf_pre', '$col_pre', '$mort', '$sps_pre', '$sps_id', '$aspDtl', '$astTest')";
     
		  
		  
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully.</h3>";
 
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
		
		// Close connection
        mysqli_close($conn);

		
		
		
		
		
		
		
		
		// redirect to process.php
   //header("Location: user_data.php");
   //exit();
		
		
			// Redirect to same page to clear form data
		//header('Location: ' . $_SERVER['PHP_SELF']);
		//exit;
	}


?>
</main>
<?php
include("footer.php");	
?>
</body>
</html>