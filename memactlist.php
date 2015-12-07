<?php
include './db.php';
$num1 = $_GET['text1'];
$num2 = $_GET['text2'];
session_start() ;
$store_id=$_SESSION['store_id'];
$stmt=$conn->query("select name,gender,cellphone,sum(s.reward_pt)as point,count(s.mem_id) as buycount,Round((sum(s.reward_pt))/(count(s.mem_id)),2) as avgpoint,Round(COUNT(s.mem_id)/(DATEDIFF('".$num2."','".$num1."'))*100,2) AS percent 
From shopdetail as s,member as m 
Where s.mem_id=m.mem_id 
and buy_date between '".$num1."' and '".$num2."'
and s.store_id='".$store_id."'
Group by name,gender,cellphone");
//$stmt=$conn->query("select m.mem_id,name,gender,count(s.mem_id) as buycount,
//ROUND(COUNT(s.mem_id)/(SELECT COUNT(mem_id) FROM shopdetail)*100,2) AS percent 
//From shopdetail as s,member as m 
//Where s.mem_id=m.mem_id 
//Group by mem_id,name,gender
//having percent between '".$num1."' and '".$num2."'");
//$stmt = $conn->query("select act_name,name,start_date,end_date 
//          from member,activity,act_record 
//          where activity.act_id=act_record.act_id and act_record.mem_id=member.mem_id and start_date between '".$d1."' and '".$d2."' and act_name='".$active."'");
$msg = "";
$msg.='<thead><tr><th>會員姓名</th><th>性別</th><th>手機</th><th>點數</th><th>購買次數</th><th>平均點數</th><th>活躍率</th></tr></thead><tbody>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $msg.="<tr><td>" . $row['name'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['cellphone'] . "</td><td>" . $row['point'] . "</td><td>" . $row['buycount'] . "</td><td>" . $row['avgpoint'] . "</td><td>" . $row['percent'] ."%"."</td></tr>";
    $count = $count + 1;
}
$msg.="</tbody>";
echo  $msg;
?>
