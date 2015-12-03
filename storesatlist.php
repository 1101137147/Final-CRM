<?php
include './db.php';
 $d1=$_GET['date1'];
 $d2=$_GET['date2'];

$a=0;
$b=0;
$c=0;
$d=0;


$stmt= $conn->query("select  answer FROM qstnirdetail where qst_date between '".$d1."' and '".$d2."'");
  $msg="";
  //$msg.="<thead><tr><th>答案</th></tr></thead><tbody>";

  $msg.='<thead><tr><th>名稱</th><th>次數</th></tr></thead><tbody>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

	if($row['answer']=="非常滿意"){
		$a=$a+1;
	}elseif ($row['answer']=="滿意") {
		$b=$b+1;
	}elseif ($row['answer']=="不滿意") {
		$c=$c+1;
	}else{
		$d=$d+1;
	}
   
   //$msg.="<tr><td>" . $row['answer'] . "</td><td>" . $row['date'] . "</td></tr>";
	//$msg.="<tr><td>" . $row['answer']. "</td></tr>";
//	echo $row['answer'];
}
$msg.="<tr><td>非常滿意</td><td>".$a."</td></tr>";
$msg.="<tr><td>滿意</td><td>".$b."</td></tr>";
$msg.="<tr><td>不滿意</td><td>".$c."</td></tr>";
$msg.="<tr><td>非常不滿意</td><td>".$d."</td></tr>";
$msg.="</tbody>";
echo  $msg;

?>
