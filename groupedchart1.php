<!doctype html>
<?php
error_reporting(0); 
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<!-- Load d3.js -->
<script src="https://d3js.org/d3.v6.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css"> 
<!-- Create a div where the graph will take place -->
<div id="groupedbar" align="center"></div>	
	
<style>
	.legend {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 60%;
}

rect {
    stroke-width: 2;
}

text {
  font: 10px Verdana, "sans-serif";
}
	
	</style>

</head>

<body>
<?php
	

include("connect.php");     #$get_co = mysqli_query($conn, "select distinct comorbidities from sps_prevalence where study_ids = '$st_id';");
$get_sp = mysqli_query($conn, "select distinct species from sps_prevalence where study_ids = '$st_id';");	

	while($sps=mysqli_fetch_array($get_sp)){
		$sp[] = $sps["species"];
	}
	/* while($row=mysqli_fetch_array($get_co)){
	
		$co[] = $row["comorbidities"]; 
	}
	$cnt = count($co);*/
	unset($val_csv);
	if(($rowcount == 2)){
	 $co1 = $co[0];
	$co2 = $co[1];
	
	
	$val_csv = "species,$co1,$co2".'\n';
	
	foreach($sp as $val){
		
			$res1 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and comorbidities='$co1' and species='$val' and study_ids = '$st_id'");
		    $res2 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and comorbidities='$co2' and species='$val' and study_ids = '$st_id'");
		    

		    unset($pr1);
			while($row1= mysqli_fetch_array($res1)){
				
				$pr1 = $row1["prevalence"];
				
			}
		    unset($pr2);
		    while($row2= mysqli_fetch_array($res2)){
				
				$pr2 = $row2["prevalence"];
			}
		    
		    #unset($val_csv);
			
		
		$val_csv = "$val_csv$val,$pr1,$pr2".'\n';
			
		
	}
	

	}
	else if($rowcount == 3){
		
	 $co1 = $co[0];
	$co2 = $co[1];
	
	$co3 = $co[2];
	
	$val_csv = "species,$co1,$co2,$co3".'\n';
	
	foreach($sp as $val){
		
			$res1 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and comorbidities='$co1' and species='$val' and study_ids = '$st_id'");
		    $res2 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and comorbidities='$co2' and species='$val' and study_ids = '$st_id'");
		    $res3 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and comorbidities='$co3' and species='$val' and study_ids = '$st_id'");

		    unset($pr1);
			while($row1= mysqli_fetch_array($res1)){
				
				$pr1 = $row1["prevalence"];
				
			}
		    unset($pr2);
		    while($row2= mysqli_fetch_array($res2)){
				
				$pr2 = $row2["prevalence"];
			}
		    unset($pr3);
		    while($row3= mysqli_fetch_array($res3)){
				
				$pr3 = $row3["prevalence"];
			}
		    #unset($val_csv);
			
		
		$val_csv = "$val_csv$val,$pr1,$pr2,$pr3".'\n';
			
		
	}

	}
	else{
		
		$get_oc = mysqli_query($conn, "select distinct other_categories from sps_prevalence where study_ids = '$st_id';");
		while($row=mysqli_fetch_array($get_oc)){
	
		$oc[] = $row["other_categories"]; 
	}
		$cnt_oc = count($oc);
		if($cnt_oc == 2){
		$oc1 = $oc[0];
	   $oc2 = $oc[1];
			
			$val_csv = "species,$oc1,$oc2".'\n';
		foreach($sp as $val){
		
			$res1 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and other_categories='$oc1' and species='$val' and study_ids = '$st_id'");
		    $res2 = mysqli_query($conn, "select prevalence from sps_prevalence where niche='$ni' and other_categories='$oc2' and species='$val' and study_ids = '$st_id'");

		    unset($pr1);
			while($row1= mysqli_fetch_array($res1)){
				
				$pr1 = $row1["prevalence"];
			}
		    unset($pr2);
		    while($row2= mysqli_fetch_array($res2)){
				
				$pr2 = $row2["prevalence"];
			}
			$val_csv = "$val_csv$val,$pr1,$pr2".'\n';
			
		
	}
		
	}}
	 #echo $val_csv; 
?>

<?php
if($rowcount==3){
?>
<script>

// set the dimensions and margins of the graph
var margin = {top: 30, right: 200, bottom: 150, left: 60},
    width = 1100 - margin.left - margin.right,
    height = 800 - margin.top - margin.bottom;

var data = d3.csvParse("<?php echo $val_csv;?>", function(d) { 
		return d;
	});
	console.log(data);
 var hval1 = data.map(d => +Object.values(d)[1]);
 var hval2 = data.map(d => +Object.values(d)[2]);
 var hval3 = data.map(d => +Object.values(d)[3]);
 var hv = hval1.concat(hval2).concat(hval3);
 console.log(hv);

</script>
<?php
}
else
{
?>
<script>
// set the dimensions and margins of the graph
var margin = {top: 30, right: 200, bottom: 150, left: 60},
    width = 700 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;
	
	var data = d3.csvParse("<?php echo $val_csv;?>", function(d) { 
		return d;
	});
	console.log(data);
 var hvall = data.map(d => +Object.values(d)[1]);
 var hval = data.map(d => +Object.values(d)[2]);
 var hv = hvall.concat(hval);
 console.log(hv);
	
</script>

<?php
}
?>

<script>
// append the svg object to the body of the page
var svg = d3.select("main")
  .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",`translate(${margin.left},${margin.top})`);

// Parse the Data 
	
//d3.csv("<?php #echo $rafln; ?>").then( function(data) {
	
	 //var parsed = "<?php #echo $val_csv;?>";
	
	
 
 
  // List of subgroups = header of the csv files = soil condition here
	
  var subgroups1 = data.columns.slice(1)
  console.log(subgroups1.length);
  var subgroups = subgroups1.map(function(d){
	if(d != undefined){
		return d;
	}  
  })
  console.log(subgroups);

  // List of groups = species here = value of the first column called group -> I show them on the X axis
  var groups = data.map(d => d.species)
    console.log(groups);                                                       

  var tooltip = d3.select("#groupedbar")
    .append("div")
    .style("opacity", 0)
    .attr("class", "tooltip")
    .style("background-color", "white")
    .style("border", "solid")
    .style("border-width", "2px")
    .style("border-radius", "5px")
    .style("padding", "5px")
	.style("position", "absolute")
	.style("width", "150px")
  

  // Add X axis
  var x = d3.scaleBand()
      .domain(groups)
      .range([0, width])
      .padding([0.2])
  svg.append("g")
	
    .attr("transform", `translate(0, ${height})`)
    .call(d3.axisBottom(x).tickSize(2))
	.selectAll("text")  
		  .attr("transform", "rotate(-40)")
		  .style("text-anchor", "end")
	      .attr("font-weight", "bold")
        .attr("dx", "-0.8em")
        .attr("dy", "0.5em")
		.style("font-size", "13px")
	
	  
	  svg.append("text")      // text label for the x axis
			.attr("x", width/2 )
			.attr("y", height + 130 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.style("font-weight", "bold")
	        .attr("fill", "#000")
			.text("Species");

var vall = +d3.max(hv) + 10;
console.log(vall);
  // Add Y axis
  var y = d3.scaleLinear()
    .domain([0, vall])
    .range([ height, 0 ]);
  svg.append("g")
    .call(d3.axisLeft(y))
	.selectAll("text")
	.style("font-size", "13px")
	svg.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 15)
        .attr("dy", "-4em")
	     .attr("x", -130)
	    .attr("fill", "#000")
         .style("font-weight", "bold")
        .style("text-anchor", "end")
	     .style("font-size", "15px")
        .text("Prevalence (%)");


  // Another scale for subgroup position?
  var xSubgroup = d3.scaleBand()
    .domain(subgroups)
    .range([0, x.bandwidth()])
    .padding([0.05])

  // color palette = one color per subgroup
  var color = d3.scaleOrdinal()
    .domain(subgroups)
    .range(['#045469','#5AB4CC', '#0D9BC0']);
  

  // Three function that change the tooltip when user hover / move / leave a cell
  var mouseover = function(event,d) {
    tooltip
      .style("opacity", 1)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 2)
      .style("opacity", 1)
  }
  var mousemove = function(event,d) {
	  
    tooltip
      .html(d.key+"<br>" + Math.round(d.value * 10)/ 10+"%")
      .style("left", (event.x)- 50 + "px")
      .style("top", (event.y)- 150 + "px")
  }
  var mouseleave = function(event,d) {
    tooltip
      .style("opacity", 0)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 0)
      .style("opacity", 1)
  }

  
  
  // Show the bars
  svg.append("g")
    .selectAll("g")
    // Enter in data = loop group per group
    .data(data)
    .join("g")
      .attr("transform", d => `translate(${x(d.species)}, 0)`)
    .selectAll("rect")
    .data(function(d) {  
	  return subgroups.map(function(key) { return {key: key, value: d[key]}; }); })
    .join("rect")
      .attr("x", d => xSubgroup(d.key))
      .attr("y", d => y(d.value))
      .attr("width", xSubgroup.bandwidth())
      .attr("height", d => height - y(d.value))
      .style("fill", function(d){return color(d.key)})
	  .on("mouseover", mouseover)
     .on("mousemove", mousemove)
     .on("mouseleave", mouseleave)
	  
            
	var legend = svg.selectAll(".legend")
	   .data(subgroups)
        .enter().append("g")
        .attr("class", "legend")
        .attr("transform", function(d, i) { return "translate(0," + i * 30 + ")"; });

    legend.append("rect")
        .attr("x", width + 10)
        .attr("width", 18)
        .attr("height", 18)
        .style("fill", color);

    legend.append("text")
        .attr("x", width + 30)
        .attr("y", 9)
        .attr("dy", ".35em")
        .style("text-anchor", "start")
		.style("font-size", 14)
        .text(function(d) { return d; });

	
	// Select the SVG element
var svgElement = d3.select('svg');

// Create a function to convert SVG to PNG
function downloadGraph() {
  // Get the SVG element as a string
  var svgString = new XMLSerializer().serializeToString(svgElement.node());

  // Create a canvas element to convert SVG to an image
  var canvas = document.createElement('canvas');
  var context = canvas.getContext('2d');

  // Create an Image element
  var image = new Image();
  image.onload = function () {
    // Set canvas dimensions to match the SVG element
    canvas.width = svgElement.attr('width');
    canvas.height = svgElement.attr('height');

    // Draw the SVG onto the canvas
    context.drawImage(image, 0, 0);

    // Convert canvas to data URL and create a download link
    var dataURL = canvas.toDataURL('image/png');
    var downloadLink = document.createElement('a');
    downloadLink.href = dataURL;
    downloadLink.download = 'graph.png';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  };

  // Set the source of the Image element to the SVG string
  image.src = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgString);
}



// Add an SVG group (g element) for the download icon
var downloadGroup = svg.append('g')
  .attr('transform', 'translate('+ 600 +', -22)'); // Adjust the position as needed

// Create an icon using the Font Awesome classes
downloadGroup.append('foreignObject')
  .attr('width', 20) // Adjust the size as needed
  .attr('height', 20)
	 .attr('title', 'Download')
   .style('color', "darkgray")
	 .style("cursor", "pointer")
  .html('<i class="fas fa-download"></i>');

// Add a click event listener to trigger the download
downloadGroup.on('click', downloadGraph);

//});
</script>
<?php

?>

</body>
</html>

