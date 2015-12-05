<?php
include './db.php';  
session_start() ;
$store_id=$_SESSION['store_id'];

$d1=$_GET['date1'];
$d2=$_GET['date2'];
$gender=$_GET['gender'];
$buyquantity=$_GET['buyquantity'];
$qdquantity=$_GET['qdquantity'];
$totalpoint=$_GET['totalpoint'];

/*
 $stmt= $conn->query("select name,gender,point.total_pt,count(shopdetail.mem_id)as aa
          from member,shopdetail,point 
          where member.mem_id=shopdetail.mem_id and member.mem_id=point.mem_id and buy_date between '".$d1."' and '".$d2."'
           group by member.mem_id
           having aa >=2");
  $msg="";
  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>點數</th><th>購買次數</th></tr></thead><tbody>';
// echo $msg;
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['total_pt']."</td><td>".$row['aa']."</td></tr>";
 //echo $msg;

  	}
        $msg.="</tbody>";
*/
 echo $d1;
 echo ",";
 echo $d2;
 echo ",";
 echo $gender;
 echo ",";
 echo $buyquantity;
 echo ",";
 echo $qdquantity;
echo ",";
echo $totalpoint;


?>
