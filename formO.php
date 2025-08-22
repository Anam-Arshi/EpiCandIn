<?php 
session_start();

//session_start();
include("connect.php");

// Initialize variables
$error = '';
$code = '';
$reset = '';
$submit = '';
$verified = '';
$success = '';
$showVerification = false;



	// Retrieve user's CAPTCHA code input
    if(isset($_POST['code'])){
	$code = $_POST['code'];
	
	// Check if input matches CAPTCHA code
	if ($code != $_SESSION['captcha']) {
		$error = 'CAPTCHA code is incorrect.';
		//echo 1;
		
	} else
	       {
		
		 // CAPTCHA code is correct, set verification message flag
        $showVerification = true;
		
		
		// CAPTCHA code is correct, process form data
		// ...
		 //include("user_data.php");
		
		
		
		
			// Redirect to same page to clear form data
		//header('Location: ' . $_SERVER['PHP_SELF']);
		//exit;
	}
	}
if (isset($_POST['reset'])) {
	// Reset CAPTCHA code
	$_SESSION['captcha'] = '';
	$_SESSION['captcha'] = rand(1000, 9999);
    //echo $_SESSION['captcha'];
	// Redirect to same page to clear form data
	//header('Location: ' . $_SERVER['PHP_SELF']);
	//exit;
	
}  else {
	// Generate new CAPTCHA code
	$_SESSION['captcha'] = rand(1000, 9999);
	
	
}
	

	
// Display the verification message if the flag is set
if ($showVerification) {
    $verified = "CAPTCHA code is verified.";
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	

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

	$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
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
	
	/* dropdownCheckbox */
.multiselect {
  width: 70%;
  margin-bottom: 5px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.mySelectOptions {
  display: none;
  border: 0.5px #7c7c7c solid;
  background-color: #ffffff;
  max-height: 150px;
  overflow-y: scroll;
}

.mySelectOptions label {
  display: block;
  font-weight: normal;
  
  white-space: nowrap;
  min-height: 1.2em;
  background-color: #ffffff;
  padding: 0 2.25rem 0 .75rem;
  /* padding: .375rem 2.25rem .375rem .75rem; */
}

.mySelectOptions label:hover {
  background-color: #1e90ff;
}
	.mySelectOptions input{
		width: 20px;
	}
/* ------- */
	.input-container {
    margin-top: 10px;
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
<h3 align="center">Patient's data</h3>
<p><h5>*</h5> - Mandatory</p>

<form method ="POST"  action="user_data.php" name="form1" id="form1" onSubmit="return validate(this);">
<table width="1200px" border="0" cellspacing="2" cellpadding="7">

<tr>

<td width="47%">
<strong>Full name<h5>*</h5></strong>
</td>

<td>
<input type="text" name="nm"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Date of birth<h5>*</h5></strong>
</td>

<td>
<input type="text" id="birth_date" name="birth_date"/>
</td>

</tr>


<tr>

<td width="45%">
<strong>Age<h5>*</h5></strong>
</td>

<td>
	<script>
	function calculateAge(date) 
{
  const now = new Date();
  const diff = Math.abs(now - date );
  const age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365)); 
  return age
}

var picker = new Pikaday({ 
  field: document.getElementById('birth_date') ,
  yearRange:[1900,2022],
  onSelect: function(date) {
  let age = calculateAge(date);
  document.getElementById('age').innerHTML = age ;
  }                        
});
	
	
	</script>
<input type="text" name="age" size="45" id="age"></input>
</td>

</tr>


<br/>
<tr>

<td width="47%">
<strong>Gender <h5>*</h5></strong>
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
  <label for="1">Male</label>
  
  <input type="checkbox" id="2" name="set[]" value="Clinic"   <?php if (in_array("Clinic", $set))
  {
  echo "checked";
  }?>>
  <label for="2">Female</label>
  
  
  
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
 


</td>


</tr>
<tr>

<td width="47%">
<strong>Hospital name <h5>*</h5></strong>

</td>
<td>
<input type="text" name="loca"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Address</strong>
</td>

<td>
<input type="text" name="ethn"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Phone number <h5>*</h5></strong>
</td>

<td>
<input type="text" name="risk"></input>
</td>

</tr>
<tr><td></td></tr>
<tr><td colspan="2" align="center" style="padding: 10px; background-color:#17809E; color:white; font-weight:bold; margin:20px;">Medical history</td></tr>
<tr><td></td></tr>
<tr>

<td width="47%">
<strong>Date of first presentation <h5>*</h5></strong>
</td>

<td>
<input type="date" id="date" name="trip-start" value="2018-07-22" min="2015-01-01" max="2018-12-31" />
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
<strong>Sample (Biological specimen) collected<h5>*</h5></strong>
</td>

<td>
<input type="text" name="sample"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Diagnostic method <h5>*</h5></strong>
</td>

<td>
<input type="text" name="age"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Species identified <h5>*</h5></strong>
</td>

<td>
<select id="dropdown">
  <option value="" disabled selected>Select</option>
  <?php
	$getsps = mysqli_query($conn, "select distinct species from sps_prevalence order by species ASC");

while($row=mysqli_fetch_array($getsps))
{
	$sp = $row["species"];	
	
	echo "<option value='$sp'>$sp</option>";
}
	?>
</select>

<div id="input-container"></div>
<script>
document.getElementById("dropdown").addEventListener("change", function() {
  var selectedOption = this.value;
  
  if (selectedOption) {
    var inputContainer = document.getElementById("input-container");
    
    var inputField = document.createElement("div");
    inputField.className = "input-container";
	  inputField.style.padding = "5px";
    
    var label = document.createElement("label");
    label.textContent = selectedOption;
    label.style.padding = "5px";
    var input = document.createElement("input");
    input.type = "text";
    
    var closeButton = document.createElement("i");
      closeButton.className = "fas fa-times-circle close-btn";
      closeButton.style.fontSize = "18px";
      closeButton.style.padding = "8px";
      closeButton.style.color = "red";
      closeButton.style.cursor = "pointer";

      closeButton.addEventListener("click", function() {
        inputContainer.removeChild(inputField);
      });

    
    inputField.appendChild(label);
    inputField.appendChild(input);
    inputField.appendChild(closeButton);
    
    inputContainer.appendChild(inputField);
    
    // Reset dropdown to default value
    this.selectedIndex = 0;
  }
});
</script>
</td>

</tr>
<tr>

<td width="47%">
<strong>Treatment regimen<h5>*</h5></strong>
</td>

<td>


      
<!--- <input type="text" name="drug" placeholder="Enter name of drug(s)"></input> --->
<div id="AFDMultiselect" class="multiselect">
      <div id="AFD" class="selectBox" onclick="toggleCheckboxAreaAFD()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="AFDSelectOptions" class="mySelectOptions">
		  <?php
		  $getAFD = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
		  while($rowafd=mysqli_fetch_array($getAFD))
             {
	             $afd = $rowafd["Drug"];
	             echo "<label for='$afd'><input type='checkbox' id='$afd' onchange='checkboxStatusChangeAFD()' value='$afd' />$afd</label>";
	
            }
		  ?>
        <label for='other' ><input type='checkbox' id='otherAFD' value='other' onClick="showHideAFD()"/>Other</label>
      </div>
   
 
	
	<div id="hidden-field_afd" style="display: none;">
      
<input type="text" name="other_afd" placeholder="Enter drug name" ></input>

</div>

<script type="text/javascript">
  function showHideAFD() {
    let afd = document.getElementById('otherAFD');
	
    if (afd.checked == true){
      document.getElementById('hidden-field_afd').style.display = 'block';
    } else {
      document.getElementById('hidden-field_afd').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#AFDMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#AFDSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeAFD() {
  var multiselect = document.getElementById("AFD");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("AFDSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaAFD(onlyHide = false) {
  var checkboxes = document.getElementById("AFDSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>

</div>


	
<?php
#(isset($_POST["company"])) ? $company = $_POST["company"] : $company=1;

?>
</td>

</tr>


</table>
<br>
<div id="hidd-div"></div>
<div align="center">
<button type="button" id="addButton">Add detail</button>
	
	
<script>
 var addbtn = document.getElementById("addButton");
  
    var elementContainer = document.getElementById("hidd-div");
    
	// Counter for element IDs
    let elementCount = 0;
    
// Function to create and append a new element
    function appendElement() {
      const newElement = document.createElement('div');
      newElement.classList.add('appended-element');

      const elementText = document.createElement('p');
      elementText.textContent = `Element ${elementCount}`;

      const removeButton = document.createElement('button');
      removeButton.textContent = 'Remove';
      removeButton.addEventListener('click', () => {
        elementContainer.removeChild(newElement);
      });

      newElement.appendChild(elementText);
      newElement.appendChild(removeButton);

      elementContainer.appendChild(newElement);
      elementCount++;
    }

    // Attach the function to the button's click event
    addbtn.addEventListener('click', appendElement);
</script>
</div>

<br/>
<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <div>
	<p>Type the CAPTCHA code below:</p>
	<p class="c-para"><img src="https://dummyimage.com/150x50/000/fff&text=<?php echo $_SESSION['captcha']; ?>" alt="CAPTCHA Image">&nbsp;&nbsp;
		<button type="submit" name="reset" value="Reset" class="reset">
			<i class="fas fa-undo-alt" style="font-size: 20px; color:darkslateblue;"></i>
		</button>
		
			</p>
	<p><input type="text" name="code"></p>
	
	<?php if ($error) { echo '<p style="color:red">' . $error . '</p>'; }?>
	<?php if ($verified) { echo '<p style="color:green">' . $verified . '</p>'; } ?>
	<?php if ($success) { echo '<p style="color:green">' . $success . '</p>'; } ?>

 
<p align="center">
<button type="submit" name="submit" value="Submit" class="square_btn">Submit</button>
<button  type="reset" name="Reset_f" value="Reset_f" class="square_btn">Reset</button>
</p>
</div>
    </tr>
  </table>
</form>




</main>





<?php
include("footer.php");	
?>
</body>
</html>