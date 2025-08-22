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
	
	
	
	main{
		padding: 2px;
	}
	
	.title{
		text-decoration: none;
		font-size: 16px;
		padding: 10px;
		color: #12477F;
		display: inline-block;
		margin: auto;
	}
	
	#main-sidebar{
		overflow-x: hidden;
	}
	
</style>
</head>
<body>
<?php
	include("header2.php")
?>
<?php
$st_id= $_REQUEST["std"];


include("connect.php");     
$get = mysqli_query($conn, "select distinct Species from asp where study_ids='$st_id' and Species is NOT NULL");
$cnt = mysqli_num_rows($get);
#echo $cnt;

unset($sp);

	foreach($get as $val){
	$sp[] = $val["Species"]; 
}


#var_dump($sp);
$get_cat = mysqli_query($conn, "select distinct Category from asp where study_ids = '$st_id' and Species is null");
$cnt_cat = mysqli_num_rows($get_cat);
foreach($get_cat as $catt){
	$cat[] = $catt["Category"]; 
}
#echo $cnt_cat;	



	


unset($drug);
$dis_drg = mysqli_query($conn, "select distinct Drug from asp where Study_ids = '$st_id'");
foreach($dis_drg as $val){
		 $drug[] = $val["Drug"];
}
 
	
 
 

?>		
<main>
<div align="center">
    
		
<?php


$qry = mysqli_query($conn, "select Title, PMID_DOI from data where study_ids = '$st_id' LIMIT 1");
while($pid = mysqli_fetch_array($qry)){
	unset($pmid);
	$title = $pid["Title"];
	$pmid = $pid["PMID_DOI"];

}

?>	

<h3><b>Antifungal susceptibility profile</b></h3>
<p align='center' style="padding: 5px;">
<?php
	echo $title;
if(is_numeric($pmid[0])){
echo "<a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank' class='title'>($pmid)</a>";
}
else{
	echo "<a href='$pmid' target='_blank' class='title'>($pmid)</a>";
}
?>
</p>
		<div id="graphs" align="center">
	<?php
	
	$get_dc = mysqli_query($conn, "select distinct Disease_Category from asp where Study_ids = '$st_id'");
	unset($dc);
	
	$rowcount=mysqli_num_rows($get_dc);
	//echo "number of rows ".$rowcount;
	
	while($row=mysqli_fetch_array($get_dc)){		
	   
		$dc[] = $row["Disease_Category"];
		
	}
	
	 if($rowcount < 2){
		 
	 
		foreach($sp as $spp){
			?>
			<h4 style="padding: 10px; background-color: lightgray;">Organism: <em><?php echo $spp; ?></em></h4>
			<?php
      foreach($drug as $drr){
	 		 #echo $spp;
			 if($spp != ""){
		
			//$qre ="select R, I, S from asp where study_ids='$st_id' and Species ='$spp' and Drug ='$drr' and Disease_Category='$dc'";
			#echo $qre;
				 
				 
		$qre ="select R, I, S from asp where study_ids='$st_id' and Species ='$spp' and Drug = '$drr' and R !='0' OR I !='0' OR S !='0'";
	 }
		else{
				 
		
		$qre ="select R, I, S from asp where study_ids='$st_id' and Drug ='$drr' and R !='0' OR I !='0' OR S !='0'";
        }
	
	 $res = mysqli_query($conn, $qre);
	
	   $cnt_res = mysqli_num_rows($res);
	   
	#echo $cnt_res;
	   
 
	   
  if($cnt_res > 0)
  {
	unset($dr);
	unset($r);
	unset($in);
	unset($s);
	  
	
	foreach($res as $val){
	$r =  $val["R"];
	 $in = $val["I"];
	$s = $val["S"];
    $dr = "'R', 'S', 'I'";
		$per = " '$r', '$s', '$in' ";	
		
	}
  }
	

  #var_dump($per);
?>


<script>
	// JavaScript Document

 
// The new data variable.
var dr = [<?php echo $dr; ?>];
var pr = [<?php echo $per; ?>];
var spp = "<?php echo $spp;?>";      
var drr = "<?php echo $drr;?>";

//console.log(s);
var data = [];
var v = {};
for(var i = 0; i < dr.length; i++){
	v.Drugs = dr[i];
	v.Percentage = Math.round(pr[i]);
data.push({...v});
}
console.log(data);
	


      var svg = d3.select("#graphs")
			             
                         .append("svg")
                         //.attr("id", "#bar1")
                             .attr("width", 400)
                             .attr("height", 500)
                             .attr("align", "left")
               //.attr("transform",`translate(${margin.left},${margin.top})`);

             
       var margin = 200,
        width = svg.attr("width") - margin,
        height = svg.attr("height") - margin; 
	
var xScale = d3.scaleBand().range([0, width]).padding(0.2),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g")
	         .attr("align", "center")
            .attr("transform", "translate(" + 100 + "," + 100 + ")");

var data1 = d3.groupSort(data, ([d]) => -d.Percentage, d => d.Drugs)
//console.log(data1);
        xScale.domain(data1);
        //yScale.domain([0, d3.max(data, function(d) { return d.Percentage; })+10.0]);
	    yScale.domain([0,  100]);
		console.log(d3.max(data, function(d) { return d.Percentage; })+ 10);
		g.append("g")
         .attr("transform", "translate(0," + height + ")")
         .call(d3.axisBottom(xScale))
		  .selectAll("text")  
		  .attr("transform", "rotate(0)")
		  .style("text-anchor", "end")
        .attr("dx", "0.3em")
        .attr("dy", "0.8em")
		.style("font-size", "13px");
		
         
		 
		 svg.append("text")      // text label for the x axis
			.attr("x", width + 30 )
			.attr("y", height + 170 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.attr("font-weight", "bold")
	        .attr("fill", "#000")
			.text("");
			
        svg.append("text")
		.attr("align", "center")
       .attr("transform", "translate(10,0)")
       .attr("x", 0)
       .attr("y", 20)
       .style("font-size", "15px")
	   .style("font-weight", "bold")
	   .style("font-style", "italic")
	   .attr("fill", "#000");
	   //.text("Organism: "+spp);


	   
	   svg.append("text")
		.attr("align", "center")
       .attr("transform", "translate(10,0)")
       .attr("x", 0)
       .attr("y", 40)
       .style("font-size", "15px")
	   .style("font-weight", "bold")
	   .attr("fill", "#000")
	   .text("Drug: "+drr);
		 
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
	.style("font-size", "14px")
	 .text("Percentage");
		
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
}
	 }



?>
</div>
		
		<text style='padding-left: 10px;font-size:13px; font-style:italic; float:left;' align="left">
Legend-
R: Resistance,
I: Intermediate,
S: Sensitive
</text>
<br>
<br>
</div>
</main>

<?php
	include("footer.php");
?>
</body>
</html>