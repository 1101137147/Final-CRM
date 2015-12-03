<?php
include './db.php';
$num1 = $_GET['text1'];
$num2 = $_GET['text2'];
$stmt=$conn->query("select name,gender,cellphone,count(a.mem_id) as actcount,
ROUND(COUNT(a.mem_id)/(SELECT COUNT(act_id) FROM activity)*100,2) AS percent 
From act_record as a,member as m 
Where a.mem_id=m.mem_id 
and join_date between '".$num1."' and '".$num2."'
Group by name,gender,cellphone");
//$stmt = $conn->query("select act_name,name,start_date,end_date 
//          from member,activity,act_record 
//          where activity.act_id=act_record.act_id and act_record.mem_id=member.mem_id and start_date between '".$d1."' and '".$d2."' and act_name='".$active."'");
$msg = "";
$msg.='<thead><tr><th>會員姓名</th><th>性別</th><th>手機</th><th>參與活動數</th><th>活躍率</th></tr></thead><tbody>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $msg.="<tr><td>" . $row['name'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['cellphone'] . "</td><td>" . $row['actcount'] . "</td><td>" . $row['percent'] . "</td></tr>";
    $count = $count + 1;
}
$msg.="</tbody>";
echo  $msg;
?>
