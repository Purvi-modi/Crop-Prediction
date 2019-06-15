
<?php
if(isset($_POST['submit'])){//to run PHP script on submit
  //$email_id=$_POST['email'];
  $area=$_POST['area'];
  $name=$_POST['name'];
  $state=$_POST['source'];
  $district=$_POST['status'];
  $K=$_POST['K'];
  $N=$_POST['N'];
  $P=$_POST['P'];
  $ph=(float)$_POST['ph'];
  $EC=$_POST['EC'];
  $CaCo3=$_POST['CaCo3'];
  $Fe=$_POST['Fe'];
  $Mg=$_POST['Mg'];
  $Zn=$_POST['Zn'];
  $Cu=$_POST['Cu'];
  if($K == 0)
  {
	$K=300;  
  }
    if($N == 0)
  {
	$N=300;  
  }
    if($P == 0)
  {
	$P=300;  
  }
    if($ph == 0)
  {
	$ph=300;  
  }
    if($EC == 0)
  {
	$EC=300;  
  }
    if($CaCo3 == 0)
  {
	$CaCo3=300;  
  }
    if($Fe == 0)
  {
	$Fe=300;  
  }
    if($Mg == 0)
  {
	$Mg=300;  
  }
    if($Zn == 0)
  {
	$Zn=300;  
  }
    if($Cu == 0)
  {
	$Cu=300;  
  }
  
$file = fopen("seed.csv","r");
$A=fgetcsv($file);
$output=array();
$output_temp=array();
$output_yield=array();
$rainfall=array();
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] !=""){
	//print_r($A);
	//print($ph);
	
	if((float)$A[2]<= $ph && (float)$A[3]<=$EC && (float)$A[4]<=$N && (float)$A[5]<=$P && (float)$A[6]<=$K && (float)$A[7]<=$CaCo3 && (float)$A[8]<=$Fe && (float)$A[9]<=$Mg && (float)$A[10]<=$Zn && (float)$A[11]<=$Cu)
	{
	 $output[$A[1]]=$A[0];
	 $output_temp[$A[1]]=$A[12];
	 $output_yield[$A[1]]=$A[13];
	 $rainfall[$A[1]]=$A[14];
	}	
	}
	
}
$file = fopen("Temperature.csv","r");
$A=fgetcsv($file);
$temp_month=array();
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] ==$state && $A[1]==$district){
	//print_r($A);
	//print($ph);
	$i=1;
	while($i!=13)
	{ 
		$temp_month[$i]=$A[1+$i];
		$i+=1;
	}

	}
	
}

function mon($x)
{
	if($x==1){return "January";}
	if($x==2){return "February";}
	if($x==3){return "March";}
	if($x==4){return "April";}
	if($x==5){return "May";}
	if($x==6){return "June";}
	if($x==7){return "July";}
	if($x==8){return "August";}
	if($x==9){return "September";}
	if($x==10){return "October";}
	if($x==11){return "November";}
	if($x==12){return "December";}
}
//print_r($output);
//print_r($temp_month);
$month_output=array();
foreach($output_temp as $x => $x_value) {
	$month=array();
	for($j=1;$j<=12;$j++)
	{
		if($temp_month[$j]>= ($x_value-2.0) && $temp_month[$j]<= ($x_value+2.0))
		{
			array_push($month,mon($j));
		}
	
	}
	$month_output[$x]=$month;
}
//print_r($month_output);
function month_echo($a)
{  $str ="";
	foreach($a as $x => $x_value)
	{
		$str.=$x_value.",";
	}
	return $str;
}
}
?>

<html>
<head>

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>

body {
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  font-size: 25px;
   background-image: url("https://ak1.picdn.net/shutterstock/videos/9632771/thumb/2.jpg");
   background-repeat: no-repeat;
background-position: right top;

margin: 100px;
background-attachment: fixed;
color: white;
background-size:cover
}
</style>

</head>
<body>
<b>Please Select Language:
  <div id="google_translate_element"></div>

<br/><br/>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<b>Hello <?php echo $name; ?>,<br><br>
Thank you for connecting to us from <?php echo $district;?> , <?php echo $state;?>.<br><br><br>
You can Look into following seeds to maximise your Yield<br>
<table>
<tr>
<td>SEED</td><td>TYPE</td><td>MONTHS</td><td>EXPECTED YIELD(Tonnes)</td><td>RAINFALL(mm)</td>
</tr>
<?php
foreach($month_output as $x =>$x_value)
{   if (count($x_value)!=0){
	echo "<tr>";
	echo "<td>".$output[$x]."</td> "."<td>".$x."</td> "."<td>".month_echo($x_value)."</td> "."<td>".($output_yield[$x]*$area)."</td> "."<td>".$rainfall[$x]."</td> ";
	echo "</tr>";
}
}
?>
</table>
</body>
</html>


  
  