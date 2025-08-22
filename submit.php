<?php 
session_start();

if(isset($_POST['Submit'])){
	// code for check server side validation
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
	}else{// Captcha verification is Correct. Final Code Execute here!		
		$msg="<span style='color:green'>The Validation code has been matched.</span>";		
	}
}	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<script>
function validate(form) {

var e = form.elements, m = '';

var alphaExp = /^[0-9a-zA-Z\s]+$/;
var sps = /^[\s]+$/;

   if(!e['nm'].value) {m += '- Name is required \n';}
	else if(e['nm'].value.match(sps)) {m += '- Name is required.\n';}
	if(!e['nm'].value.match(alphaExp)){ m += '- Name only alphabets allowed.\n';}
  if(!e['aff'].value) {m += '- Affiliation is required.\n';}
  if(!e['title'].value) {m += '- Title is required.\n';}
    if(!e['aim'].value) {m += '- Aim is required.\n';}
	
  if(!e['pub'].value) {m += '- Select if the data is published.\n';}
	else if(e['pub'].value == "yes"){  if(!e['pmid'].value) {m += '- Enter PMID/DOI.\n';} }
	if(!e['jrn_yp'].value) {m += '- Journal and year is required.\n';}  
	if(!e['duratn'].value) {m += '- Duration is required.\n';}  
	//if(!e['st_des'].value) {m += '- Study design is required.\n';} 
	//if(!e['set'].value) {m += '- Setup is required.\n';} 
	
	if(!e['loca'].value) {m += '- Location is required.\n';} 
	
	if(!e['risk'].value) {m += '- Risk factor is required.\n';}
	if(!e['comorb'].value) {m += '- Comorbidities is required.\n';}
	if(!e['typ_can'].value) {m += '- Type of candidiasis is required.\n';}
	if(!e['niche'].value) {m += '- Niche infected is required.\n';}
	 if(!e['symp'].value) {m += '- symptoms is required.\n';}
	if(!e['anti'].value) {m += '- Select if the drug is prescribed.\n';}
	else if(e['anti'].value == "yes"){  if(!e['drug'].value) {m += '- Enter Drugs.\n';} }
	if(!e['age'].value) {m += '- Age is required.\n';}
	if(!e['sex'].value) {m += '- Sex is required.\n';}
	if(!e['no_pat'].value) {m += '- Number of patients is required.\n';}
	if(!e['no_sam'].value) {m += '- Number of samples is required.\n';}
	if(!e['no_can'].value) {m += '- Number of candida isolates is required.\n';}
	if(!e['inf_pre'].value) {m += '- Infection prevalence is required.\n';}
	if(!e['mortal'].value) {m += '- Mortality is required.\n';}
	if(!e['sps_pre'].value) {m += '- Species prevalence is required.\n';}
	if(!e['sps_id'].value) {m += '- Species identification method is required.\n';}
	
 /* if(!e['email'].value) {m += '- Email ID is required.\n';}
  else if(e['email'].value.match(sps)) {m += '- Email ID is required.\n';}
  else if (echeck(e['email'].value)==false){  m += '- Invalid Email ID.\n'; 
  }*/
    	
   
  if(m) {
    alert('The following error(s) occurred:\n\n' + m);
    return false;
  }
  return true;
}

	</script>

<style>
	main{
		padding: 10px 50px;
	}	
	.submit input{
		box-sizing: border-box;
		border: 2px solid black;
		font-size: medium;
		padding: 5px;
	    	
		width: 400px;
	}
	select{
		background-color: #175161;
        color: white;
        padding: 8px;
        width: 250px;
        border: none;
        font-size: medium;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.2);
       -webkit-appearance: button;
        appearance: button;
        outline: none;
	}
	textarea{
		box-sizing: border-box;
		border: 2px solid black;
		font-size: medium;
		padding: 5px;
		width: 300px;
		height: 100px;
	}
	.square_btn{
    display: inline-block;
    padding: 0.5em 1em;
    text-decoration: none;
    background: #175161;/*Button Color*/
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
	cursor: pointer;
}
.square_btn:active {/*on Click*/
    -ms-transform: translateY(4px);
    -webkit-transform: translateY(4px);
    transform: translateY(4px);/*Move down*/
    border-bottom: none;/*disappears*/
}
.chkbx input{
	width: auto;
	margin: 5px;
}
	h5{
		color: red;
		display: inline;
	}
</style>
	
<link href="phptextcaptcha/css/stylecap.css" rel="stylesheet">
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
	</script>
</head>

<body>
<?php
include("header2.php");	
?>
	
<main class="submit">
<h3 align="center">Submit data</h3>
<p><h5>*</h5> - Mandatory</p>

<form method ="POST" action="user_data.php" name="form1" id="form1" onSubmit="return validate(this);">
<table width="1100px" border="0" cellspacing="2" cellpadding="7">

<tr>

<td width="47%">
<strong>Name of submitter <h5>*</h5></strong>
</td>

<td>
<input type="text" name="nm"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Affiliation of submitter <h5>*</h5></strong>
</td>

<td>
<input type="text" name="aff" ></input>
</td>

</tr>


<tr>

<td width="45%">
<strong>Title of study <h5>*</h5></strong>
</td>

<td>
<input type="text" name="title" size="45" ></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Aim of study <h5>*</h5></strong>
</td>

<td>
<input type="text" name="aim" ></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Is this data published? <h5>*</h5></strong>
</td>

<td>

<?php
(isset($_POST["pub"])) ? $pub = $_POST["pub"] : $pub = ""; 
?>

<select name="pub" id="pub" onchange="showHide()" >
<option value="">Select</option>
<option value="yes" <?php if($pub == "yes"){echo "selected";} ?>>Yes</option>
<option value="no" <?php if($pub == "no"){echo "selected";} ?>> No</option>
</select>

<div id="hidden-field" style="display: none;">
      
<input type="text" name="pmid" placeholder="Enter PMID/DOI"></input>
</div>

<script type="text/javascript">
  function showHide() {
    let pub = document.getElementById('pub');
    if (pub.value == "yes") {
      document.getElementById('hidden-field').style.display = 'block';
    } else {
      document.getElementById('hidden-field').style.display = 'none';
    }
  }
</script>
		
		

</td>

</tr>
<tr>

<td width="47%">
<strong>Journal and Year <h5>*</h5></strong>
</td>

<td>
<input type="text" name="jrn_yp"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Duration <h5>*</h5></strong>
</td>

<td>
<input type="text" name="duratn"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Select study design <h5>*</h5></strong>
</td>

<td class="chkbx">
<?php
$stdsn = [];
$stdes = "";

	
	$cntt=0;
	if(isset($_POST['st_des'])){
	
    foreach($_POST['st_des'] as $val ){
	if($cntt==0){
		$stdes = $val;
	}
	else{
	$stdes = $stdes.", ".$val;
	}
	$cntt++;

   

	}
		
}
	
	
	
	
	$_SESSION["stdes"] = $stdes;
	$abc=str_replace(" ", "", $stdes);
	$stdsn= explode(",", $abc);
	
	
	
?>


<input type="checkbox" id="1" name="st_des[]" value="Prospective"   <?php if (in_array("Prospective", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="1">Prospective</label>
  
  <input type="checkbox" id="2" name="st_des[]" value="Retrospective"   <?php if (in_array("Retrospective", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="2">Retrospective</label>
  
  <input type="checkbox" id="3" name="st_des[]" value="Cross-sectional"  <?php if (in_array("Cross-sectional", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="3">Cross-sectional</label>
  
  <input type="checkbox" id="4" name="st_des[]" value="Case-control"  <?php if (in_array("Case-control", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="4">Case-control</label>
  
  <input type="checkbox" id="5" name="st_des[]" value="Longitudinal"  <?php if (in_array("Longitudinal", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="5">Longitudinal</label>
  
  <input type="checkbox" id="o_stdes" name="st_des[]" value="other" onClick="showHide1()" <?php if (in_array("other", $stdsn))
  {
  echo "checked";
  }?>>
  <label for="5">Other</label>
  
<div id="hidden-field1" style="display: none;">
  <input type="text" name="other_stdes"></input>	
</div>

<script type="text/javascript">
  function showHide1() {
    let o_stdes = document.getElementById('o_stdes');
	
    if (o_stdes.checked == true){
      document.getElementById('hidden-field1').style.display = 'block';
    } else {
      document.getElementById('hidden-field1').style.display = 'none';
    }
  }
</script>



</td>

</tr>
<br/>
<tr>




<td width="47%">
<strong>Setup <h5>*</h5></strong>
</td>

<td class="chkbx">
<?php
$set = [];
$setup = "";
$cnt=0;
	if(isset($_POST['set'])){
	
    foreach($_POST['set'] as $v ){
	
	if($cnt==0)
	{
		$setup=$v;
	}
		else{
			$setup=$setup.", ".$v;
		}
		
		$cnt++;
		
	
}
	
	}
	$def=str_replace(" ", "", $setup);
	$set= explode(",", $def);
?>
<input type="checkbox" id="1" name="set[]" value="Hospital" <?php if (in_array("Hospital", $set))
  {
  echo "checked";
  }?>>
  <label for="1">Hospital</label>
  
  <input type="checkbox" id="2" name="set[]" value="Clinic"   <?php if (in_array("Clinic", $set))
  {
  echo "checked";
  }?>>
  <label for="2">Clinic</label>
  
  <input type="checkbox" id="3" name="set[]" value="Laboratory"  <?php if (in_array("Laboratory", $set))
  {
  echo "checked";
  }?>>
  <label for="3">Laboratory</label>
  
  <input type="checkbox" id="4" name="set[]" value="Community"  <?php if (in_array("Community", $set))
  {
  echo "checked";
  }?>>
  <label for="4">Community</label>
  
  <input type="checkbox" id="o_set" name="set[]" value="other" onClick="showHide2()"  <?php if (in_array("other", $set))
  {
  echo "checked";
  }?>>
  <label for="5">Other</label>
  
	<div id="hidden-field2" style="display: none;">
  <input type="text" name="other_set"></input>	
</div>

<script type="text/javascript">
  function showHide2() {
    let o_set = document.getElementById('o_set');
	
    if (o_set.checked == true){
      document.getElementById('hidden-field2').style.display = 'block';
    } else {
      document.getElementById('hidden-field2').style.display = 'none';
    }
  }
</script>

	
	
	
  <?php
  if(in_array("other", $set)){
	 
	  if(isset($_POST['o_set'])){
		$o_set = $_POST['o_set'];
		$setup = $setup.", ".$o_set; 
		}
  }
  ?>
 
<script>

</script>


</td>
</form>
</tr>
<tr>

<td width="47%">
<strong>Location <h5>*</h5></strong>

</td>
<td>
<input type="text" name="loca"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Ethnicity of patients</strong>
</td>

<td>
<input type="text" name="ethn"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Risk factors <h5>*</h5></strong>
</td>

<td>
<input type="text" name="risk"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Comorbidities <h5>*</h5></strong>
</td>

<td>
<input type="text" name="comorb"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Type of candidiasis <h5>*</h5></strong>
</td>

<td>
<input type="text" name="typ_can"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Niche infected <h5>*</h5></strong>
</td>

<td>
<input type="text" name="niche"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Signs and symptoms of candidiasis <h5>*</h5></strong>
</td>

<td>
<input type="text" name="symp"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Antifungal drug(s) prescribed  <h5>*</h5></strong>
</td>

<td>

<select name="anti" id="anti" onChange="showHide3()">
<option value="">Select</option>
<option value="yes" >Yes</option>
<option value="no">No</option>
</select>

<div id="hidden-field3" style="display: none;">
      
<input type="text" name="drug" placeholder="Enter name of drug(s)"></input>

</div>

<script type="text/javascript">
  function showHide3() {
    let anti = document.getElementById('anti');
    if (anti.value == "yes") {
      document.getElementById('hidden-field3').style.display = 'block';
    } 
	  else {
      document.getElementById('hidden-field3').style.display = 'none';
    }
  }
</script>
	
	
<?php
#(isset($_POST["company"])) ? $company = $_POST["company"] : $company=1;

?>
</td>

</tr>
<tr>

<td width="47%">
<strong>Age <h5>*</h5></strong>
</td>

<td>
<input type="text" name="age"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Sex <h5>*</h5></strong>
</td>

<td>
<input type="text" name="sex"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Total no. of patients <h5>*</h5></strong>
</td>

<td>
<input type="text" name="no_pat"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Total no. of samples <h5>*</h5></strong>
</td>

<td>
<input type="text" name="no_sam"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>No. of <em>Candida</em> isolates <h5>*</h5></strong>
</td>

<td>
<input type="text" name="no_can"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Infection prevalence <h5>*</h5></strong>
<br/>
(presence of <em>Candida</em> in pathogenic state)
</td>

<td>
<textarea  name="inf_pre"></textarea>
</td>

</tr>
<tr>

<td width="47%">
<strong>Colonization prevalence </strong>
<br/>
(presence of <em>Candida</em> in commensal form)
</td>

<td>
<textarea  name="col_pre"></textarea>
</td>

</tr>
<tr>

<td width="47%">
<strong>Mortality (%) <h5>*</h5></strong>


</td>

<td>
<input type="text" name="mortal"></input></strong>
</td>

</tr>
<tr>

<td width="47%">
<strong>Species prevalence (%) <h5>*</h5></strong>


</td>

<td>
<textarea name="sps_pre"></textarea>
</td>

</tr>
<tr>

<td width="47%">
<strong>Identification method <h5>*</h5></strong>
<br/>
(culture methods, microscopy, molecular techniques (Please give details))
</td>

<td>
<input type="text" name="sps_id"></input></strong>
</td>

</tr>

<tr>

<td width="47%">
<strong>Antifungal susceptibility profile (%) </strong>
<br/>
(Resistance, Sensitivity)
</td>

<td>
<textarea name="asp"></textarea>
</td>

</tr>

<tr>

<td width="47%">
<strong>Antifungal susceptibility test </strong>
<br/>
(disc diffusion, broth microdilution, etc. (Please specify))
</td>

<td>
<input type="text" name="asp_met"></input>
</td>

</tr>
</table>
<br/>
<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <td align="right" valign="top"> Validation code:</td>
      <td><img src="phptextcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
        <label for='message'>Enter the code above here :</label>
        <br>
        <input id="captcha_code" name="captcha_code" type="text">
        <br>
        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
    </tr>
  </table>
<p align="center">
<button type="submit" name="Submit" value="Submit" class="square_btn" onclick="return validate();" >Submit</button>
<button  type="reset" name="Reset" value="Reset" class="square_btn">Reset</button>
</p>
</form>




</main>





<?php
include("footer.php");	
?>
</body>
</html>