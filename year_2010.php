<!doctype html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="year_2010" style="width:100%;max-width:1200px"></canvas>
<?php 
include "connect.php";
	
$ai=0;	
$ni = mysqli_query($conn, "SELECT distinct niche from niche_infected where niche !='-'");
while($ni_res = mysqli_fetch_array($ni))
{
	$val=trim($ni_res["niche"]);
	//echo "SELECT Year_of_Publication, count(DISTINCT Study_ids) as cont FROM data where Niche_Infected LIKE '%$val%' and Year_of_Publication < 2001 GROUP BY Year_of_Publication";
$res=mysqli_query($conn, "SELECT count(DISTINCT Study_ids) as cont FROM data where Niche_Infected LIKE '%$val%' and Year_of_Publication Between 2001 AND 2011");
$count = mysqli_num_rows($res);
	
if($count > 0)
{

while($row = mysqli_fetch_array($res))
{
	$cnt=$row["cont"];
	if($cnt>0)
	{
	if($ai==0)
	{
	$yval=$cnt;
	$xval="'$val'";
	}
	else
	{
		$yval=$yval.", ".$cnt;
		$xval="$xval, '$val'";
	}
	$ai++;
	}
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

new Chart("year_2010", {
   type: "horizontalBar",
	tooltip: { enable: false
	},
  data: {
    labels: xValues, 
    datasets: [{
	label: "Year 2001-2010",
      backgroundColor: "#0E73C5",
		hoverBackgroundColor: "#66A2EB",
      data: yValues,
		
		
    }]
  },
	options: {
        scales: {
            xAxes: [{
                ticks: {
            		beginAtZero: true
                }
            }],
            yAxes: [{
            	stacked: true
            }]
        },
		legend: {
        position: 'right'
      }
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