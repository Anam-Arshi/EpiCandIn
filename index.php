<?php
error_reporting(0); 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EpiCandIn</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
	
	
	</style>
</head>
	
	<body>
      <?php  
			include("header2.php");
		?>
	<main class="main">
    <article>
      <h3>About EpiCandIn</h3>
      <p>Infections caused by <em>Candida</em> species are associated with high morbidity and mortality. EpiCandIn has been created to track the epidemiology of candidiasis in India. It is a collection of manually curated publications that report the data on candidiasis such as <em>Candida</em> species, geographical location, niche affected, disease characteristics and drug therapy details. This resource is integrated with visualization tools and will be useful for public health researchers and policy makers to gain insights on the emerging trends and management of <em>Candida</em> infections in India.</p>
    </article>
	<br/>

	<aside>
		<div id="site_map">
		<?php
		include("site_of_study.php");
		?>
		</div>
	</aside>
		
	
	<br/>
		
    


<table width="680px" border="0" class="indextable" cellspacing="3" cellpadding="3">
  
    
	<!---<tr height="600px">
	<td colspan="4" bgcolor="white">
	</td>
	</tr>-->
	<tr>
      <th scope="col"><a href="species.php"><img  src="images/candida mixed species_chromagar_licensable.jpg" align="middle"/></a></th>
		<th scope="col"><a href="niche.php"><img src="images/humanicon.jpg" align="middle"/></a></th>
      <!--<th scope="col"><img src="images/drug.jpg"/></th>-->
      <th scope="col"><a href="drugs.php"><img src="images/drug.jpg"/></a></th>
		
		<!--<th scope="col"><a href="registration.php"><img src="images/registry.png" width="100px" height="100px"/></a></th>-->
    </tr>
	<tr>
		<td>
			<h3><a href="species.php"><em>Candida</em> species</a></h3>
		</td>
      <td><h3><a href="niche.php">Niche infected</a></h3>
	  </td>
	  <!--<td><h3><a href="drugs_ddonut_chart.php">Drugs</a></h3>
	  </td>-->
      <td><h3><a href="drugs.php">Antifungal drugs</a></h3>
	  </td>
		<!--<td><h3><a href="registration.php">Registry</a></h3>
	  </td>-->
	  <!--<tr>
	
 
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		
		
	  </tr>
	  <tr>
	  
      
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p></td>
    </tr> -->
  
</table>
<br>
  <p style="padding:20px;text-align:justify;"><strong>Citation:</strong><br><br>Kshitija Rahate, Anam Arshi, Ram Shankar Barai, Shuvechha Chakraborty, Susan Idicula-Thomas. EpiCandIn: An open online resource for epidemiology of <em>Candida</em> infections in India. <em>Indian Journal of Medical Research (IJMR)</em>. ​
  <br> DOI: <a href="http://dx.doi.org/10.25259/ijmr_886_23">http://dx.doi.org/10.25259/ijmr_886_23</a></p>
	</main>

<section>
<?php include("footer.php") ?>
</section>
	
</body>
</html>
