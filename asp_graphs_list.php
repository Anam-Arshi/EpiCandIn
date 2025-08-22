<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">
<title>Antifungal susceptibility profile</title>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script src="https://d3js.org/d3-array.v2.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<div id="groupedbar" align="center"></div>	

<style>
	h3{
		text-align: center;
		padding-top: 10px;
	}
	p{
		font-size: 20px;
	}
	main{
		padding: 2px;
	}
	
</style>
</head>
<body>
<?php
	include("header2.php")
?>
<?php
$st_id= $_REQUEST["std"];
#122, 125, 107
#$st_id= 115;
#echo $st_id."\n";
unset($_SESSION["col1"]);
include("connect.php");     
$get = mysqli_query($conn, "select distinct Species from asp where study_ids='$st_id' and Species !='';");
$cnt = mysqli_num_rows($get);
#echo $cnt;
foreach($get as $val){
	$sp[] = $val["Species"]; 
}
if($cnt != 0){
	
$cntt=0;
	if(isset($_POST['col'])){
	
    
		$col = $_POST['col'];
}
	
	
		else{
		
		$col= $sp[0];
	}
	#$coln=str_replace(" ", "", $col);
	$col1= explode(",", $col);
	$_SESSION["col1"] = $col1;
    #var_dump($col1);
$cat = mysqli_query($conn, "select Category from asp where Category !='' and study_ids = '$st_id'");
$cnt_cat = mysqli_num_rows($cat);
#echo $cnt_cat;	

?>		

<div id="mySidebar" class="sidebar" align="center">
  <p>Select species</p>
  <form method="post" action="" name="getval" >
	 <select name="col" onChange="this.form.submit()">
<?php
	
if($cnt_cat > 0){
?>

<option value="Overall" <?php if (in_array("Overall", $col1))
  {
  echo "selected";
}?>>Overall</option>
  
  <?php
}
foreach($sp as $sps){
?>	
  <option value="<?php echo $sps; ?>" <?php if (in_array("$sps", $col1))
  {
  echo "selected";
}?>><?php echo $sps; ?></option>
  <?php
}
?>
	</select>
  </form>



	</div>




	<div id="main-sidebar" align="center">
    
		
<?php
if(isset($_SESSION['col1']))
{

$qry = mysqli_query($conn, "select PMID_DOI from data where study_ids = '$st_id' LIMIT 1");
while($pid = mysqli_fetch_array($qry)){
	unset($pmid);
	$pmid = $pid["PMID_DOI"];
}

foreach($col1 as $spp){	
?>	
<p><b>Antifungal susceptibility profile</b><br/><br/>
<?php
if(is_numeric($pmid[0])){
echo"<a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank'>$pmid</a>";
}
else{
	echo "<a href='$pmid' target='_blank'>$pmid</a>";
}
?>
<br/>
<br/>
<em><b><?php echo $spp; ?></b></em>
		</p>
	<?php
	$cat = ['R', 'S', 'I'];
	$get_dc = mysqli_query($conn, "select distinct Disease_Category from asp where Study_ids = '$st_id'");
	unset($dc);
	
	$rowcount=mysqli_num_rows($get_dc);
	#echo "number of rows ".$rowcount;
	
	while($row=mysqli_fetch_array($get_dc)){
	
		$dc[] = $row["Disease_Category"];
	
	}
	
	
	
	foreach($cat as $i){
		
		if(($rowcount == 0)||($rowcount == 1)) 
   {
		
   if($spp !='Overall'){
   
	  
	   
	$res = mysqli_query($conn, "select Drug, $i from asp where study_ids='$st_id' and Species ='$spp' and $i !='0'");
	$cnt_res = 0;
	   $cnt_res = mysqli_num_rows($res);
	   
	#echo $cnt_res;
	   
  if($cnt_res > 0)
  {
	unset($dr);
	unset($per);
	  
	foreach($res as $val){
	
    $dr[] = $val["Drug"];
		$per[] = $val[$i];	
		
	}
  }
   }
  else{
	  $res = mysqli_query($conn, "select Drug, $i from asp where study_ids='$st_id' and Category !='' and $i !='0'");
	$cnt_res = 0;
	   $cnt_res = mysqli_num_rows($res);
	   
	#echo $cnt_res;
	   
  if($cnt_res > 0)
  {
	unset($dr);
	unset($per);
	  
	foreach($res as $val){
	
    $dr[] = $val["Drug"];
		$per[] = $val[$i];	
		
	}
  }
  }
?>

	<!-- <svg width="900" height="900" id="svg4"></svg> -->

<script>
	// JavaScript Document

 
// The new data variable.
var dr = <?php echo '["' . implode('", "', $dr) . '"];' ?>;
var pr = <?php echo '["' . implode('", "', $per) . '"];' ?>;
var grp = "<?php echo $i;?>";
var sp = "<?php echo $spp;?>";


//console.log(s);
var data = [];
var v = {};
for(var i = 0; i < dr.length; i++){
	v.Drugs = dr[i];
	v.Percentage = Math.round(pr[i]);
data.push({...v});
}
console.log(data);
	


      var svg = d3.select("#main-sidebar")
			             
                         .append("svg")
                         //.attr("id", "#bar1")
                             .attr("width", 550)
                             .attr("height", 600)
                             .attr("align", "center")
               //.attr("transform",`translate(${margin.left},${margin.top})`);

             
       var margin = 300,
        width = svg.attr("width") - margin,
        height = svg.attr("height") - margin; 
          /* 

.attr("margin-top", margin.top+"px")
               .attr("margin-right", margin.right+"px")
                .attr("margin-left", margin.left+"px")
               .attr("margin-bottom", margin.bottom+"px")
			   
			   */
    /* svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 10)
       .attr("y", 50)
       .attr("font-size", "18px")
       .text("Species prevalence in study id:"+s); 
	  
    svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 70)
       .attr("y", 70)
       .attr("font-size", "15px")
	   .text(function(d){
		if(grp == 'R'){
		return "Resistivity of "+sp;
		}else if(grp == 'S'){
			return "Sensitivity of "+sp;
		}else if(grp == 'I'){
			return "Intermediate  of "+sp;
		}
		
	}); */
	
var xScale = d3.scaleBand().range([0, width]).padding(0.2),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g")
            .attr("transform", "translate(" + 150 + "," + 100 + ")");

var data1 = d3.groupSort(data, ([d]) => -d.Percentage, d => d.Drugs)
//console.log(data1);
        xScale.domain(data1);
        yScale.domain([0, d3.max(data, function(d) { return d.Percentage; })]);
		
		g.append("g")
         .attr("transform", "translate(0," + height + ")")
         .call(d3.axisBottom(xScale))
		  .selectAll("text")  
		  .attr("transform", "rotate(-40)")
		  .style("text-anchor", "end")
        .attr("dx", "-0.5em")
        .attr("dy", "0.5em")
		.style("font-size", "13px");
		
         
		 
		 svg.append("text")      // text label for the x axis
			.attr("x", width + 30 )
			.attr("y", height + 210 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.attr("font-weight", "bold")
	        .attr("fill", "#000")
			.text("Drugs");

		 
		  g.append("g")
         .call(d3.axisLeft(yScale).tickFormat(function(d){return d;}).ticks(10))
		 .selectAll("text")
		 .style("font-size", "13px")
	 g.append("text")
	 .attr("transform", "rotate(-90)")
	 .attr("y", 10)
	 .attr('dy', '-3.8em')
	 .attr("x", -90)
	 .attr('text-anchor', 'end')
	 .attr("font-weight", "bold")
	 .attr("fill", "#000")
	.style("font-size", "15px")
	 .text(function(d){
			  if(grp == 'R'){
		return "Resistance (%)";
		}else if(grp == 'S'){
			return "Sensitivity (%)";
		}else if(grp == 'I'){
			return "Intermediate (%)";
		}
		  });
		
	var tooltip = d3.select("#groupedbar")
	//svg.select("tooltip1")
	.append("div")
    .style("opacity", 0)
    .attr("class", "tooltip")
    .style("background-color", "white")
    .style("border", "solid black")
    .style("border-width", "2px")
    .style("border-radius", "5px")
    .style("padding", "5px")
	.style("position", "absolute" )
	.style("width", "50px")
	
	// Three function that change the tooltip when user hover / move / leave a cell
  var mouseover = function(d) {
    tooltip
      .style("opacity", 1)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 2)
      .style("opacity", 1)
  }
  var mousemove = function(d) {
    tooltip
      .html(d.Percentage+" %")
      .style("left", d3.event.pageX - 50 + "px")
      //.style("top", d3.event.pageY - 70 + "px")
	  .style("top", d3.event.pageY - 150 +"px")
  }
  var mouseleave = function(d) {
    tooltip
      .style("opacity", 0)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 0)
      .style("opacity", 1)
  }

	
	

	
		g.selectAll(".bar")
         .data(data)
         .enter().append("rect")
         .attr("class", "bar")
         .attr("x", function(d) { return xScale(d.Drugs); })
         .attr("y", function(d) { return yScale(d.Percentage); })
	     .on("mouseover", mouseover)
	     .on("mousemove", mousemove)
	     .on("mouseleave", mouseleave)
         .attr("width", xScale.bandwidth())
	 .transition()
	 .ease(d3.easeLinear)
	 .duration(300)
	 .delay(function(d,i){ return i * 50})
         .attr("height", function(d) { return height - yScale(d.Percentage); });	

</script>

		<?php
  
   }
     
         else 
			if(($rowcount == 2)||($rowcount == 3) ) 
			{
		      include("asp_grpchart_filter.php");
			}
   }
	   }

	?>
	</div>
	<br/>
	
	
	<?php
}
	?>
</div>

<?php

}else
		if($cnt == 0)
	{
	$get = ['R', 'S', 'I'];
	$get_dc = mysqli_query($conn, "select distinct Disease_Category from asp where Study_ids = '$st_id'");
	
	unset($dc);
	
	$rowcount=mysqli_num_rows($get_dc);
	#echo "number of rows ".$rowcount;
	
	while($row=mysqli_fetch_array($get_dc)){
	
		$dc[] = $row["Disease_Category"];
	
	}
	
	
	
	foreach($get as $i){
		
		
   if(($rowcount == 0)||($rowcount == 1)) 
   {
	   
	$res = mysqli_query($conn, "select Drug, $i from asp where study_ids='$st_id' and $i != '0'");
	$cnt_res = 0;
	   $cnt_res = mysqli_num_rows($res);
	   
	#echo $cnt_res;
	   
  if($cnt_res > 0)
  {
	unset($dr);
	unset($per);
	  
	foreach($res as $val){
	
    $dr[] = $val["Drug"];
		$per[] = $val[$i];	
		
	}
  
	
?>

	<!-- <svg width="900" height="900" id="svg4"></svg> -->
	

<main align="center">
<p><b>Overall Antifungal susceptibility profile</b><br/><br/>
<?php
$qry = mysqli_query($conn, "select PMID_DOI from data where study_ids = '$st_id' LIMIT 1");
while($pid = mysqli_fetch_array($qry)){
	unset($pmid);
	$pmid = $pid["PMID_DOI"];
}
if(is_numeric($pmid[0])){
echo"<a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank'>$pmid</a>";
}
else{
	echo "<a href='$pmid' target='_blank'>$pmid</a>";
}
?>
</p>
</main>
<script>
	// JavaScript Document

 
// The new data variable.
var dr = <?php echo '["' . implode('", "', $dr) . '"];' ?>;
var pr = <?php echo '["' . implode('", "', $per) . '"];' ?>;
var grp = "<?php echo $i;?>";



//console.log(s);
var data = [];
var v = {};
for(var i = 0; i < dr.length; i++){
	v.Drugs = dr[i];
	v.Percentage = Math.round(pr[i]);
data.push({...v});
}
console.log(data);

var svg = d3.select("main")
             .append("svg")
              .attr("width", "550")
              .attr("height", "600")
			  .style("display", "block")
			  .style("margin", "auto");

             
        var margin = 300,
        width = svg.attr("width") - margin,
        height = svg.attr("height") - margin;

    /* svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 10)
       .attr("y", 50)
       .attr("font-size", "18px")
       .text("Species prevalence in study id:"+s); 
	  
    svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 70)
       .attr("y", 70)
       .attr("font-size", "15px")
	   .text(function(d){
		if(grp == 'R'){
		return "Resistance (%)";
		}else if(grp == 'S'){
			return "Sensitive (%)"
		}else if(grp == 'I'){
			return "Intermediate (%)"
		}
		
	}); */
	
var xScale = d3.scaleBand().range([0, width]).padding(0.2),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g")
            .attr("transform", "translate(" + 100 + "," + 100 + ")");

var data1 = d3.groupSort(data, ([d]) => -d.Percentage, d => d.Drugs)
//console.log(data1);
        xScale.domain(data1);
        yScale.domain([0, d3.max(data, function(d) { return d.Percentage; })]);
		
		g.append("g")
         .attr("transform", "translate(0," + height + ")")
         .call(d3.axisBottom(xScale))
		  .selectAll("text")  
		  .style("font-size", "13px")
		  .attr("transform", "rotate(-40)")
		  .style("text-anchor", "end")
        .attr("dx", "-0.5em")
        .attr("dy", "0.5em")
		
		
         
		 
		 g.append("text")      // text label for the x axis
			.attr("x", width/2)
			.attr("y", height + 130 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.style("font-weight", "bold")
	        .attr("fill", "#000")
			.text("Drugs");

		 
		  g.append("g")
         .call(d3.axisLeft(yScale).tickFormat(function(d){return d;}).ticks(10))
		 .selectAll("text")
		 .style("font-size", "13px")
	 g.append("text")
	 .attr("transform", "rotate(-90)")
	 .attr("y", 10)
	 .attr('dy', '-3.5em')
	.attr("x", -90)
	 .attr('text-anchor', 'end')
	 .style("font-weight", "bold")
	 .attr("fill", "#000")
	 .style("font-size", "15px")
	 .text(function(d){
		if(grp == 'R'){
		return "Resistance (%)";
		}else if(grp == 'S'){
			return "Sensitive (%)"
		}else if(grp == 'I'){
			return "Intermediate (%)"
		}
	 });
	var tooltip = d3.select("#groupedbar")
	//svg.select("tooltip1")
	.append("div")
    .style("opacity", 0)
    .attr("class", "tooltip")
    .style("background-color", "white")
    .style("border", "solid black")
    .style("border-width", "2px")
    .style("border-radius", "5px")
    .style("padding", "5px")
	.style("position", "absolute" )
	.style("width", "150px")
	
	// Three function that change the tooltip when user hover / move / leave a cell
  var mouseover = function(d) {
    tooltip
      .style("opacity", 1)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 2)
      .style("opacity", 1)
  }
  var mousemove = function(d) {
    tooltip
      .html(d.Drugs+"<br>"+"Percentage: "+d.Percentage)
      .style("left", d3.event.pageX - 50 + "px")
      .style("top", d3.event.pageY - 70 + "px")
  }
  var mouseleave = function(d) {
    tooltip
      .style("opacity", 0)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 0)
      .style("opacity", 1)
  }

	
	

	
		g.selectAll(".bar")
         .data(data)
         .enter().append("rect")
         .attr("class", "bar")
	     
	     
         .attr("x", function(d) { return xScale(d.Drugs); })
         .attr("y", function(d) { return yScale(d.Percentage); })
	     .on("mouseover", mouseover)
	     .on("mousemove", mousemove)
	     .on("mouseleave", mouseleave)
         .attr("width", xScale.bandwidth())
	 .transition()
	 .ease(d3.easeLinear)
	 .duration(300)
	 .delay(function(d,i){ return i * 50})
         .attr("height", function(d) { return height - yScale(d.Percentage); });	
	      
	

</script>

		<?php
  }
	   
	   else{
		   include("asp_grpchart.php");
	   }
	}
		else 
			if(($rowcount == 2)||($rowcount == 3) ) {
		include("asp_grpchart.php");
		}
		
	}	
		
		
	}
	
	
	   
	   ?>
	
	
		
	
	
<?php



?>






	
	
<?php
   
	include("footer.php");
?>
</body>
</html>