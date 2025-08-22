<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="AMPbar" style="width:100%;max-width:800px"></canvas>
<?php 
include "connect.php";

$res=mysql_query("select distinct tax from camp order by tax");
$ai=0;
while($row = mysql_fetch_array($res))
{
	$ta=$row["tax"];
	

	if($ta=="")
	{
		$res1=mysql_query("select count(dbid) as cnt from camp where tax IS NULL");
while($row1 = mysql_fetch_array($res1))
{
	$cnt=$row1["cnt"];
}
		$tax="Synthetic construct";
	}
	else
	{
		$res1=mysql_query("select count(dbid) as cnt from camp where tax='$ta'");
while($row1 = mysql_fetch_array($res1))
{
	$cnt=$row1["cnt"];
}
		$tax=$ta;
	}
	
	if($ai==0)
	{
	$xval="'$tax'";
	$yval=$cnt;
	}
	else
	{
		$xval="$xval, '$tax'";
		$yval="$yval, $cnt";
	}
	$ai++;
}
//echo $xval;
//echo $yval;
//print_r($xval);
?> 
<script>
var xValues = [<?php echo $xval; ?>];
var yValues = [<?php echo $yval; ?>];
var barColors = [
  "#8392ab",
  "#8ecafb",
  "#990000",
  "#ee957f",
  "#9fdebe",
  "#a98caf",
  "#000000",
  "#f5b57c"
  
];

new Chart("AMPbar", {
   type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "AMP Source"
    }
  }
});
</script>

</body>
</html>