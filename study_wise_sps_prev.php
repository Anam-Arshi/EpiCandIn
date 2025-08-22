<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Species prevalence</title>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script src="https://d3js.org/d3-array.v2.min.js"></script>
	
<link rel="stylesheet" href="css/style.css" type="text/css"> 

<style>
	p a{
		text-decoration: none;
	}
	
	</style>

</head>

<body>
<div id="groupedbar" align="center"></div>
<?php
	include("header2.php");
?>
<main class= "main-swsp">
	
<?php
	include("connect.php");     $st_id= $_REQUEST["std"];
	#$st_id= 50;
	#echo $st_id."\n" 141, 132;
	$qry = mysqli_query($conn, "select Title, PMID_DOI from data where study_ids = '$st_id' LIMIT 1");
while($pid = mysqli_fetch_array($qry)){
	$title = $pid["Title"];
	$pmid = $pid["PMID_DOI"];
}
	?>
	<h3 style="padding: 0px;margin-bottom: 0px;">Species prevalence</h3>
	<br>
	
	<p align='center' style="padding: 5px;">
<?php
	echo $title;
if(is_numeric($pmid[0])){
echo " (PMID: <a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank' class='title'>  $pmid</a>)";
}
else{
	echo " (DOI: <a href='$pmid' target='_blank' class='title'> $pmid</a>)";
}
?>
</p>
	
	<?php
	
	$get = mysqli_query($conn, "select distinct niche from sps_prevalence where study_ids='$st_id';");
	$get_co = mysqli_query($conn, "select distinct comorbidities from sps_prevalence where study_ids = '$st_id' and comorbidities is not NULL;");
	
	unset($co);
	
	$rowcount=mysqli_num_rows($get_co);
	#echo "number of rows ".$rowcount;
	
	$cnt = mysqli_num_rows($get);
	
	while($row=mysqli_fetch_array($get_co)){
	
		$co[] = $row["comorbidities"];
	
	}
	
	
	
	foreach($get as $i){
		
		unset($ni);
	$ni = $i["niche"];
		
   if(($rowcount == 0)||($rowcount == 1)) 
   {
	   //and other_categories is NULL
	$res = mysqli_query($conn, "select species, prevalence from sps_prevalence where study_ids='$st_id' and niche='$ni' and species !='' and prevalence is NOT NULL");
	$cnt_res = 0;
	$cnt_res = mysqli_num_rows($res);
	   
	#echo $cnt_res;
	   
  if($cnt_res > 0)
  {
	unset($species);
	unset($pr);
	  
	foreach($res as $val){
	
    $species[] = $val["species"];
		$pr[] = $val["prevalence"];	
		
	}
  
	
?>

	<!-- <svg width="900" height="900" id="svg4"></svg> -->
	
<script>
	// JavaScript Document

 
// The new data variable.
var sp = <?php echo '["' . implode('", "', $species) . '"];' ?>;
var pr = <?php echo '["' . implode('", "', $pr) . '"];' ?>;
var s = "<?php echo $st_id;?>";
var ni = "<?php echo $ni;?>";

var cnt = "<?php echo $cnt;?>";
	

//console.log(s);
var data = [];
var v = {};
for(var i = 0; i < sp.length; i++){
	v.Species = sp[i];
	v.Prevalence = Math.round(pr[i]);
data.push({...v});
}
console.log(data);

var svg = d3.select("main")
             .append("svg")
              .attr("width", "570")
              .attr("height", "600");

             
        var margin = 230,
        width = svg.attr("width") - margin,
        height = svg.attr("height") - margin;

    /* svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 10)
       .attr("y", 50)
       .attr("font-size", "18px")
       .text("Species prevalence in study id:"+s);  */
	  if(cnt > 1){
    svg.append("text")
       .attr("transform", "translate(100,0)")
	   .style("margin", "auto")
       .attr("x", 80)
       .attr("y", 70)
       .attr("font-size", "18px")
	   .style("font-weight", "bold")
	   .text(function(d){
		    if(d != "Overall"){
			return "Niche: "+ni;
			}else{
				return "Overall";
			}
	});
	  }
	
var xScale = d3.scaleBand().range([0, width]).padding(0.2),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g")
            .attr("transform", "translate(" + 100 + "," + 100 + ")");

var data1 = d3.groupSort(data, ([d]) => -d.Prevalence, d => d.Species)
//console.log(data1);
        xScale.domain(data1);
        yScale.domain([0, d3.max(data, function(d) { return d.Prevalence; }) + 10]);
		
		g.append("g")
         .attr("transform", "translate(0," + height + ")")
         .call(d3.axisBottom(xScale))
		  .selectAll("text")  
		  .attr("transform", "rotate(-50)")
		  .style("text-anchor", "end")
        .attr("dx", "-0.5em")
        .attr("dy", "0.5em")
		.style("font-size", "13px")
		
         
		 
		 svg.append("text")      // text label for the x axis
			.attr("x", 280 )
			.attr("y", height + 220 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.attr("font-weight", "bold")
	        .attr("fill", "#000")
			.text("Species");

		 
		  g.append("g")
         .call(d3.axisLeft(yScale).tickFormat(function(d){return d;}).ticks(10))
		 .selectAll("text")
		 .style("font-size", "13px")
	 g.append("text")
	 .attr("transform", "rotate(-90)")
	 .attr("y", 10)
	 .attr('dy', '-3.53em')
	 .attr("x", -90)
	 .attr('text-anchor', 'end')
	 .attr("font-weight", "bold")
	 .attr("fill", "#000")
	.style("font-size", "15px")
	 .text('Prevalence (%)')
		
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
	
	// Three function that change the tooltip when user 2 / move / leave a cell
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
      //.html(d.Species+"<br>"+"Prevalence:"+d.Prevalence)
	  .html(d.Prevalence+" %")
      .style("left", d3.event.pageX - 50 + "px")
      .style("top", d3.event.pageY - 150 + "px")
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

         .attr("x", function(d) { return xScale(d.Species); })
         .attr("y", function(d) { return yScale(d.Prevalence); })
	     .on("mouseover", mouseover)
	     .on("mousemove", mousemove)
	     .on("mouseleave", mouseleave)
         .attr("width", xScale.bandwidth())
	 .transition()
	 .ease(d3.easeLinear)
	 .duration(300)
	 .delay(function(d,i){ return i * 50})
         .attr("height", function(d) { return height - yScale(d.Prevalence); });	
	      
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
  .attr('transform', 'translate('+ 500 +', 45)'); // Adjust the position as needed

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
	

</script>

		<?php
  }
	   
	   else{
		   include("groupedchart1.php");
	   }
	}
		else 
			if(($rowcount == 2)||($rowcount == 3) ) {
		include("groupedchart1.php");
		}
		
	}
	   
	   ?>
</main>
<?php
	
	include("footer.php");
?>
</body>
</html>