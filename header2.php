<!doctype html>

<link rel="stylesheet" href="css/style_1.css" type="text/css">
<link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">

<header>
	<nav>
	<div class="logo">
	<p><a href="index.php">EpiCandIn</a></p>
	<h3><a href="index.php">Epidemiology of Candida Infections in India</a></h3>
	</div>
	
<div class="nav">
	
	<form method="post" action="search.php" onSubmit="return checkform(this)">
	<input name="term" type="search" placeholder="Search.." size="25">
	<button type="submit" id="search-button" name="Submit"><i class="fa fa-search" style="padding: 2px; color: white; font-weight: bold;"></i></button>
	</form>
	<div class="social">
		
<a href="index.php" title="Home"><i class="fa fa-home" style="padding:8px; font-size: 18px;"></i></a><br/>
<a href="contact.php" title="Contact Us"><i class="fa fa-address-book" style="padding:8px; font-size: 18px;"></i></a>
<br/>
<!--<a href="#" title="twiiter"><i class="fa-brands fa-twitter" style="padding:8px; font-size: 18px;"></i></a> <br/>-->

<a href="help.php" title="Help"><i class="fa-solid fa-circle-question" style="padding:8px; font-size: 18px;"></i></a>
</div>
	<br/>
    <a href="advsearch.php" id="adv" >Advanced Search</a>&nbsp;
	<br/>
	
	<a href="dataset.php" ><b>Browse&nbsp;</b>|</a>
	<a href="summary.php" ><b>Summary&nbsp;</b>|</a>
	<a href="submitn.php" ><b>Submit</b></a>



</div>

    
  </nav>
</header>
<script language="JavaScript" type="text/javascript">
<!--
function checkform ( form )
{
  
   if(form.term.value == "") {
    alert( "Please enter value." );
    return false ;
  }
   
}
//-->
</script>
