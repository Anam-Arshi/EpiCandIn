<html>
<head>
<meta charset="utf-8">
<title>Summary</title>

<style>
main{
	padding: 2px;
}
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #31859C;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  width: 25%;
color: white;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #89D4EB;
  color: black;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #fff;
	color: black;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  
}
	.btn-group button {
  background-color: #31859C; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  float: left;
	width: 25%;
 font-weight: bold;
}

.btn-group .button:hover {
  background-color: #89D4EB;
color: black;
}
	
tabcontent {
  display: none;
  padding: 6px 12px;
 border: 1px solid #ccc;
  border-top: none; 
}
</style>
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
<?php
include("header2.php");	
?>
<main align="center">
	

<h3 id="heading">Epidemiology trends of candidiasis in India</h3>



	<div class="tab">
 <button class="tablink" value="pub" name="pub" onclick="openCity(event, 'publications')" <?php if(isset($_POST["yop_s"]) or isset($_POST["yop"] )){} else{ ?> id="defaultOpen" <?php } ?>>Publications</button>
  <button class="tablink" value="sps" name="sps" onclick="openCity(event, 'species')" <?php if(isset($_POST["yop_s"])){ ?> id="defaultOpen" <?php } ?>>Species</button>
  <button class="tablink" onclick="openCity(event, 'niche')" <?php if(isset($_POST["yop"])){ ?> id="defaultOpen" <?php } ?>>Niche</button>
  <button class="tablink" onclick="openCity(event, 'drugs')" >Drugs</button>
  <input type="hidden"></input>
</div>


<br/>
<div id="publications" class="tabcontent">

<?php  include("pub.php"); ?>

</div>

<div id="species" class="tabcontent">

<?php include("year_sps.php"); ?>

</div>
	
<div id="niche" class="tabcontent">
<?php include("year_2000.php"); ?>

</div>
<div id="drugs" class="tabcontent">
<?php include("drg.php"); ?>

</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  //console.log(cityName);
  /* if(cityName == "niche"){
	  document.getElementById("heading").innerHTML = "Epidemiology trends of candidiasis in India: Niche associated with infections";

  }else
	  if(cityName == "species"){
		document.getElementById("heading").innerHTML = "Epidemiology trends of candidiasis in India: <em>Candida</em> species associated with infections";
 
	  }
   else
	  if(cityName == "drugs"){
		document.getElementById("heading").innerHTML = "Epidemiology trends of candidiasis in India: Drugs prescribed for infections";
 
	  }else
	  {
	    document.getElementById("heading").innerHTML = "Epidemiology trends of candidiasis in India: Year-wise publications";
  
	  } */
}
	
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>


</main>

<?php
include("footer.php"); 
?>
</body>
</html>