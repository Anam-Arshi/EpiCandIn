<html>
<head>
<title>City table</title>
<meta content="utf-8" http-equiv="encoding"> 
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
	h4{
		text-align: center;
	}
	
	main{
		padding: 10px;
	}
	</style>
	<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="css/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<script src="css/jquery.dataTables.min.js"></script>
<script src="css/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<?php
include("header2.php");
?>

	<?php
	$city_name = $_REQUEST["cit"];
	#$city_name = "Loni";
	

	$cntt=0;
	if(isset($_POST['col'])){
    foreach($_POST['col'] as $cla ){
	if($cntt==0)
	{
		$col=$cla;
	}
		else{
			$col=$col.", ".$cla;
		}
		
		$cntt++;
}
	}
	else{
		$col="PMID_DOI, Year_of_Publication, Risk_Factors_Comorbidities, Type_of_Candidiasis, Niche_Infected, Species_Prevalence, Name_of_Drug, Antifungal_Susceptibility_Profile";

		
	}
	$coln=str_replace(" ", "", $col);
	$col1= explode(",", $coln);
?>		

<div id="mySidebar" class="sidebar">
  <p>Select columns</p>
	<form method="post" action="" name="getval">
  <input type="checkbox" id="col1" name="col[]" value="PMID_DOI" onChange="this.form.submit()"  <?php if (in_array("PMID_DOI", $col1))
  {
  echo "checked";
  }?>>
  <label for="col1">PMID/DOI</label><br/>
  <input type="checkbox" id="col2" name="col[]" value="Year_of_Publication" onChange="this.form.submit()" <?php if (in_array("Year_of_Publication", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col2">Year</label><br/>
  <input type="checkbox" id="col16" name="col[]" value="Duration_of_Study" onChange="this.form.submit()" <?php if (in_array("Duration_of_Study", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col16">Duration</label><br/>
  <input type="checkbox" id="col17" name="col[]" value="Study_Design" onChange="this.form.submit()" <?php if (in_array("Study_Design", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col17">Study design</label><br/>
	  
  <input type="checkbox" id="col18" name="col[]" value="Type_of_Setting" onChange="this.form.submit()" <?php if (in_array("Type_of_Setting", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col18">Setup</label><br/>
	
  <input type="checkbox" id="col19" name="col[]" value="Location" onChange="this.form.submit()" <?php if (in_array("Location", $col1))
  {echo "checked";}?>> 
<label for="col19">Location</label><br/>
  
  <input type="checkbox" id="col7" name="col[]" value="Risk_Factors_Comorbidities" onChange="this.form.submit()" <?php if (in_array("Risk_Factors_Comorbidities", $col1))
  {
  echo "checked";
  }?>>
  <label for="col7">Risk factors</label><br/>
  
  
  <input type="checkbox" id="col3" name="col[]" value="Type_of_Candidiasis" onChange="this.form.submit()" <?php if (in_array("Type_of_Candidiasis", $col1))
  {
  echo "checked";
  }?>>
  
  <label for="col3">Type of candidiasis</label><br/>
  
  
  <input type="checkbox" id="col4" name="col[]" value="Niche_Infected" onChange="this.form.submit()" <?php if (in_array("Niche_Infected", $col1))
  {
  echo "checked";
  }?>>
  <label for="col4">Niche infected</label><br/>
  
  <input type="checkbox" id="col8" name="col[]" value="Symptoms_Clinical_Manifestations_Signs" onChange="this.form.submit()" <?php if (in_array("Symptoms_Clinical_Manifestations_Signs", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col8">Symptoms</label><br/>
  
  <input type="checkbox" id="col11" name="col[]" value="Name_of_Drug" onChange="this.form.submit()" <?php if (in_array("Name_of_Drug", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col11">Antifungal drug prescribed</label><br/>
  
  
  <input type="checkbox" id="col5" name="col[]" value="Demographic_Age" onChange="this.form.submit()" <?php if (in_array("Demographic_Age", $col1))
  {
  echo "checked";
  }?>>
  <label for="col5">Age</label><br/>
  <input type="checkbox" id="col6" name="col[]" value="Demographic_Sex" onChange="this.form.submit()" <?php if (in_array("Demographic_Sex", $col1))
  {
  echo "checked";
  }?>>
  <label for="col6">Sex</label><br/>
  
  <input type="checkbox" id="col21" name="col[]" value="Total_no_of_Patients_Samples" onChange="this.form.submit()" <?php if (in_array("Total_no_of_Patients_Samples", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col21">Sample size</label><br/>
  
            
  
  <input type="checkbox" id="col9" name="col[]" value="Infection_Colonization_Prevalence" onChange="this.form.submit()" <?php if (in_array("Infection_Colonization_Prevalence", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col9">Infection prevalence</label><br/>
  
  <input type="checkbox" id="col13" name="col[]" value="Mortality" onChange="this.form.submit()" <?php if (in_array("Mortality", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col13">Mortality</label><br/>
  

  <input type="checkbox" id="col10" name="col[]" value="Species_Prevalence" onChange="this.form.submit()" <?php if (in_array("Species_Prevalence", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col10">Species prevalence</label><br/>
  
 <input type="checkbox" id="col14" name="col[]" value="Identification_Method" onChange="this.form.submit()" <?php if (in_array("Identification_Method", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col14">Species identification method</label><br/> 
 
  
 <input type="checkbox" id="col12" name="col[]" value="Antifungal_Susceptibility_Profile" onChange="this.form.submit()" <?php if (in_array("Antifungal_Susceptibility_Profile", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col12">Antifungal susceptibility profile</label><br/>

  
 <input type="checkbox" id="col15" name="col[]" value="Method_of_Antifungal_Susceptibility_Testing" onChange="this.form.submit()" <?php if (in_array("Method_of_Antifungal_Susceptibility_Testing", $col1))
  {
  echo "checked";
  }?>> 
  <label for="col15">Antifungal susceptibility test</label><br/>
 
  <br/><br/>	

 	
	</form>
</div>
	<div id="main-sidebar">
  
		

<?php

include("connect.php");     
$res= mysqli_query($conn, "select * from data where Location LIKE '%$city_name%';");
	$cnt=mysqli_num_rows($res);
	
if($cnt > 0)
{
	?>
<h4>Studies from <?php echo($city_name); ?></h4>
        <form action="download.php" method="post" enctype="multipart/form-data">
		
		
		<button type="submit" value="download"title="Download" style="float: right; margin-right: 25px; margin-bottom: 0px;">
			<i class="fa fa-download" style="padding: 2px;"></i>
			</button>
			
			
		<table align="center" class="table table-bordered" id="sortTable" width="98%">
	<thead>
        <tr>
			
	<?php	
	#echo "&nbsp &nbsp $cnt Records";

	$cntl=0;
	$dnld = "";
	$nmt = count($col1);
	$col_w = round(100/$nmt);
	#echo $col_w;
	foreach($col1 as $colnm){
		$cntl++;
		$colnam="";
		$colnam=str_replace('_',' ',$colnm);
		#echo "<th width=''".$col_w."%'>$colnam</th>";
		if($colnm == "PMID_DOI"){
			echo "<th>PMID/DOI</th>";
			if($cntl==1){
			$dnld = "PMID/DOI";
			}
		}else
		if($colnm == "Year_of_Publication"){
			echo "<th>Year</th>";
			if($cntl != 1){
			$dnld = "$dnld\tYear of publication";
			}
		}else
			if($colnm == "Risk_Factors_Comorbidities"){
			echo "<th>Risk factors</th>";
			if($cntl != 1){
			$dnld = "$dnld\tRisk factors";
			}
		}else
		if($colnm == "Type_of_Candidiasis"){
			echo "<th>Type of candidiasis</th>";
			if($cntl != 1){
			$dnld = "$dnld\tType of candidiasis";
			}
		}else
		if($colnm == "Niche_Infected"){
			echo "<th>Niche infected</th>";
			if($cntl != 1){
			$dnld = "$dnld\tNiche infected";
			}
		}else
		if($colnm == "Demographic_Age"){
			echo "<th>Demography age</th>";
			if($cntl != 1){
			$dnld = "$dnld\tDemography age";
			}
		}else
			if($colnm == "Demographic_Sex"){
			echo "<th>Demography sex</th>";
			if($cntl != 1){
			$dnld = "$dnld\t$colnm";
			}
		}else
		
			if($colnm == "Symptoms_Clinical_Manifestations_Signs"){
			echo "<th>Symptoms</th>";
			if($cntl != 1){
			$dnld = "$dnld\tSymptoms";
			}
		}else
		if($colnm == "Infection_Colonization_Prevalence"){
			echo "<th>Infection/Colonization prevalence</th>";
			if($cntl != 1){
			$dnld = "$dnld\tInfection/Colonization prevalence";
			}
		}else 
			if($colnm == "Species_Prevalence"){
			echo "<th>Species prevalence</th>";
			if($cntl != 1){
			$dnld = "$dnld\tSpecies prevalence";
			}
		}else
			if($colnm == "Name_of_Drug"){
			echo "<th>Drug used</th>";
			if($cntl != 1){
			$dnld = "$dnld\tDrug used";
			}
		}else
		if($colnm == "Antifungal_Susceptibility_Profile"){
			echo "<th>Antifungal susceptibility</th>";
			if($cntl != 1){
			$dnld = "$dnld\tAntifungal susceptibility";
			}
		}else
			if($colnm == "Mortality"){
			echo "<th>Mortality</th>";
			if($cntl != 1){
			$dnld = "$dnld\tMortality";
			}
		}else
			if($colnm == "Identification_Method"){
			echo "<th>Species identification method</th>";
			if($cntl != 1){
			$dnld = "$dnld\tSpecies identification method";
			}
		}else
			if($colnm == "Method_of_Antifungal_Susceptibility_Testing"){
			echo "<th>Antifungal susceptibility test</th>";
			if($cntl != 1){
			$dnld = "$dnld\tMethod of antifungal susceptibility testing";
			}
		}else
		if($colnm == "Duration_of_Study"){
			echo "<th>Duration</th>";
			if($cntl != 1){
			$dnld = "$dnld\tStudy duration";
			}
		}else
		if($colnm == "Study_Design"){
			echo "<th>Study design</th>";
			if($cntl != 1){
			$dnld = "$dnld\tStudy design";
			}
		}else
		if($colnm == "Type_of_Setting"){
			echo "<th>Setup</th>";
			if($cntl != 1){
			$dnld = "$dnld\tSetup";
			}
		}else
		if($colnm == "Location"){
			echo "<th>Location</th>";
			if($cntl != 1){
			$dnld = "$dnld\tLocation";
			}
		}else
		if($colnm == "Total_no_of_Patients_Samples"){
			echo "<th>Sample size</th>";
			if($cntl != 1){
			$dnld = "$dnld\tSample size";
			}
		}else
		if($colnm == "No_of_Candida_Isolates"){
			echo "<th>No. of candida isolates</th>";
			if($cntl != 1){
			$dnld = "$dnld\tNo. of candida isolates";
			}
		}
				
		
		
		
	}
?>
</tr>
			</thead>
			<tbody>
			<?php
	        
	       
			while($row=mysqli_fetch_array($res))
	{
				
				?>
			<tr>
				<?php
				
				$pmid = $row["PMID_DOI"];
		        $stid = $row["study_ids"];
				
				foreach($col1 as $cols)
				{
				if($cols == "PMID_DOI"){
					if(is_numeric($pmid[0])){
					echo "<td><a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank'>".$pmid."</a></td>";
					$dnld="$dnld\n$pmid";
					}
					else{
						echo "<td><a href='$pmid' target='_blank'>".$pmid."</a></td>";
						$dnld="$dnld\n$pmid";
					}
				}
				else
				 if($cols == "Demographic_Age")
				{
					$demo1 = $row["Demographic_Age"];
				  #$demo1 = str_replace(";", "<br>", $demo);
					echo"<td>".$demo1."</td>";
					$dnld="$dnld\t$demo1";
				}
				else if($cols == "Demographic_Sex")
				{
					$demo2 = $row["Demographic_Sex"];
				  #$demo1 = str_replace(";", "<br>", $demo);
					echo"<td>".$demo2."</td>";
					$dnld="$dnld\t$demo2";
				}
				else if($cols == "Species_Prevalence"){
					$chk_sp = mysqli_query($conn, "SELECT EXISTS(SELECT 1 FROM sps_prevalence WHERE Study_ids = '$stid' LIMIT 1);");
	                $res_sp = mysqli_fetch_row($chk_sp);
					
					foreach($res_sp as $val_sp){
				?>
				
				<td>
				
				<?php
				if($val_sp == 1){
					
				
				echo "<a href='study_wise_sps_prev.php?std=$stid' target='new'>".'<i class="fa-solid fa-chart-column" style="padding: 2px; font-size: 25px;"></i>'."</a>";
				$dnld="$dnld\t http://epicandin.bicnirrh.res.in/study_wise_sps_prev.php?std=$stid";
			}
			else
			{
				echo "-";
				$dnld="$dnld\t -";
			}
						?>
				</td>
				<?php
			 } 
				}
				else if($cols == "Antifungal_Susceptibility_Profile")
				{
					$chk_asp = mysqli_query($conn, "SELECT EXISTS(SELECT 1 FROM asp WHERE Study_ids = '$stid' LIMIT 1);");
	                $res_asp = mysqli_fetch_row($chk_asp);
					foreach($res_asp as $val_asp){
						?>
				
				<td>
				<?php
				if($val_asp == 1){
				echo "<a href='asp_graphs.php?std=$stid' target='new'>".'<i class="fa-solid fa-chart-column" style="padding: 2px; font-size: 25px;"></i>'."</a>";
				$dnld="$dnld\t http://epicandin.bicnirrh.res.in/asp_graphs.php?std=$stid";
			}
			else
			{
				echo "-";
				$dnld="$dnld\t -";
			}
			 ?>
				</td>
				<?php
			 }
					
				}
		        else 
					if($cols == "Mortality")
					{
					echo "<td>".$row["Mortality"]."</td>";
					$dnld="$dnld\t $row[Mortality]";
					}
					else if($cols == "Risk_Factors_Comorbidities"){
						$riskF = $row["Risk_Factors_Comorbidities"];
						 if($riskF != '-'){
						$expRisk = explode(",", $riskF);
						$expRiskC = array();
						echo "<td>" ;
						foreach ($expRisk as $value) {
                                 $expRiskC = ucfirst(trim($value));
							     echo "<li>".$expRiskC."</li>";
								}
						echo "</td>";
						
						 }
						 else{
							 echo "<td>$riskF</td>";
							 
							 
						 }
						 $dnld="$dnld\t$riskF";
						//var_dump($expRiskC);
						//$impRisk = implode("\n", $expRiskC);
						
						//echo "<td><li>".$impRisk."</li></td>";
						//$dnld="$dnld\t $impRisk";
						
					} 
					 else if($cols == "Symptoms_Clinical_Manifestations_Signs"){
						$symptoms = $row["Symptoms_Clinical_Manifestations_Signs"];
						 if($symptoms != '-'){
						$expSymp = explode(",", $symptoms);
						$expSympC = array();
						echo "<td>" ;
						foreach ($expSymp as $value) {
                                 $expSympC = ucfirst(trim($value));
							     echo "<li>".$expSympC."</li>";
								}
						echo "</td>";
						 }
						 else{
							 echo "<td>$symptoms</td>";
							 
						 }
						
						$dnld="$dnld\t$symptoms";
					} 
					else if($cols == "Type_of_Candidiasis"){
						$typeofcan = $row["Type_of_Candidiasis"];
						 if($typeofcan != '-'){
						$expTyp = explode(",", $typeofcan);
						$expTypC = array();
						echo "<td>" ;
						foreach ($expTyp as $value) {
                                 $expTypC = ucfirst(trim($value));
							     echo "<li>".$expTypC."</li>";
								}
						echo "</td>";
						 }
						 else{
							 echo "<td>$typeofcan</td>";
							 
						 }
						
						$dnld="$dnld\t$typeofcan";
					}
					else if($cols == "Niche_Infected"){
						$niche = $row["Niche_Infected"];
						 if($niche != '-'){
						$expNich = explode(",", $niche);
						
						echo "<td>" ;
						foreach ($expNich as $value) {
                                 
							     echo "<li>".$value."</li>";
								}
						echo "</td>";
						 }
						 else{
							 echo "<td>$niche</td>";
							 
						 }
						
						$dnld="$dnld\t$niche";
					} 
			    else
				{
		        echo "<td>$row[$cols]</td>";
					
			      $dnld="$dnld\t$row[$cols]";
		
				}
				}
					?>

				</tr>
	<?php
			}
		
			

			?>
		</table>
			<script>
$('#sortTable').DataTable();
</script>
		<input type="hidden" value="<?php echo $dnld;?>" name="down_city">
	    </form>
				<?php 
}else{
	echo "No Records!";
}
		?>
		
	
</div>

<?php 
include("footer.php"); 
?>


	

</body>
</html>