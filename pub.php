<!doctype html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>
<p  align="center" style="margin: 0px;"><b>Year-wise publications</b></p>
<canvas id="pub" style="width:100%;max-width:1200px; padding: 30px;"></canvas>
<?php 
include "connect.php";
	
$ai=0;	

$res=mysqli_query($conn, "Select Year_of_Publication, count(DISTINCT Study_ids) as cont FROM data  GROUP BY Year_of_Publication;");
$count = mysqli_num_rows($res);
	
if($count > 0)
{

while($row = mysqli_fetch_array($res))
{
	$cnt=$row["cont"];
	$yr = $row["Year_of_Publication"];
	if($cnt>0)
	{
	if($ai==0)
	{
	$yval=$cnt;
	$xval="'$yr'";
	}
	else
	{
		$yval=$yval.", ".$cnt;
		$xval="$xval, '$yr'";
	}
	$ai++;
	}
}
}

//echo $xval;
//echo $yval;
//print_r($xval);
?> 
<script>
var xValues = [<?php echo $xval; ?>];
var yValues = [<?php echo $yval; ?>];
//var barColors = ["#8ecafb"];

var max = Math.max(...yValues)+2;
console.log(max);
new Chart("pub", {
   type: "horizontalBar",
  data: {
    labels: xValues, 
    datasets: [{
	//label: "Upto year 2000",
      backgroundColor: "#16AEDB",
		hoverBackgroundColor: "#0C8EB2",
      data: yValues,
		
		
    }]
  },
	options: {
        scales: {
            xAxes: [{
                ticks: {
				fontSize: 13,
				beginAtZero: true,
				steps: 10,
				stepSize: 2,
				max: max
		
                },
				scaleLabel: {
        display: true,
        labelString: 'No. of publications',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 100
      },
            
			}],
            yAxes: [{
            	stacked: true,
				scaleLabel: {
        display: true,
        labelString: 'Year',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 100,
	    //fontStyle: "italic"
      },
				ticks: {
				fontSize: 13,
				}
				
            }]
        },
		legend: {
        position: 'right',
		display: false
      },
		title: {
      display: true,
      //text: "Year-wise publications",
	  text : "1972-2022",
	  fontSize: 13,
        fontColor: "black",
		fontWeight: 100,
    },
  /*options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Upto year 2000"
    },
	 yAxes: [{
		 ticks: {
			 beginAtZero: true
		 }
	 }]*/
  }
});
</script>

</body>
</html>