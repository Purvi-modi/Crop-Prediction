
<html>
<html>
<head>

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
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
  //$temp=26;
$file = fopen("Temperature.csv","r");
$A=fgetcsv($file);
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] ==$state && $A[1]==$district){
		$temp=$A[14];
		


	}
	
}



//print("python3 predict.py $ph $EC $N $P $K $CaCo3 $Fe $Mg $Zn $Cu $temp ");
$output = shell_exec("python3 predict.py $ph $EC $N $P $K $CaCo3 $Fe $Mg $Zn $Cu $temp ");
$seed=$output;
$M1=str_replace("\n"," ",$output);
$message="THE PREDICTED SEED TYPE: $M1 YOU CAN LOOK IN THE FOLLOWING SEED TYPES FOR BETTER YEILD: ";
echo "<h1>THE PREDICTED SEED TYPE:<pre>$output</pre></h1>";
echo "<h3> YOU CAN LOOK IN THE FOLLOWING SEED TYPES FOR BETTER YEILD:</h3>";
$file = fopen("seed.csv","r");
$A=fgetcsv($file);
$i=0;
while(! feof($file))
{   //echo "hello";
    $A=fgetcsv($file);
    //echo $A[0];
    //echo $seed;
	if (strpos($seed,$A[0]) !== false) {
    $i=$i+1;
	echo "<h4><pre>$i.$A[1]</pre></h4>";
	$M1=$A[1];
	$M1=str_replace("("," ",$M1);
$M1=str_replace(")"," ",$M1);
$M1=str_replace("-"," ",$M1);
   $message=$message." $i.$M1 .";

}
}
$email_id="seedproject2019@gmail.com";
 $mail_ee='python mail.py '.$email_id.' '.$message;
 //print($mail_ee);
 $command = escapeshellcmd($mail_ee);
 $output = shell_exec($mail_ee);
 //print($output);
}


?>