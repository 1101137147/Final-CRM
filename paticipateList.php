<?php
include './db.php';
$chose=$_GET['chose'];
$d1 = $_GET['date1'];
$d2 = $_GET['date2'];
$active=$_GET['active'];
session_start() ;
$store_id=$_SESSION['store_id'];
// if判斷是否選擇活動為空值
if(!empty($_GET['active'])){
$stmt = $conn->query("select act_name,CONCAT(start_date, '~', end_date)as date,count(ar.mem_id) as actcount,
ROUND(COUNT(ar.mem_id)/(SELECT COUNT(mem_id) FROM member)*100,2) AS percent
From member as m,act_record as ar ,activity as a 
where m.mem_id = ar.mem_id 
and a.act_id=ar.act_id 
and start_date between '".$d1."' and '".$d2."'
and act_name like '%".$active."%'
group by act_name ");}
else{
  $stmt = $conn->query("select act_name,CONCAT(start_date, '~', end_date)as date,count(ar.mem_id) as actcount,
ROUND(COUNT(ar.mem_id)/(SELECT COUNT(mem_id) FROM member)*100,2) AS percent
From member as m,act_record as ar ,activity as a 
where m.mem_id = ar.mem_id 
and a.act_id=ar.act_id 
and start_date between '".$d1."' and '".$d2."'
and a.store_id='".$store_id."'
group by act_name ");  
}
$msg = "";
$msg.='<thead><tr><th width=15%>活動名稱</th><th width=15%>活動期間</th><th width=10%>活動人數</th><th width=10%>參與率</th></tr></thead><tbody>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
   
    $msg.="<tr><td>" . $row['act_name'] . "</td><td>" . $row['date'] . "</td><td>" . $row['actcount'] . "</td><td>" . $row['percent'] . "</td></tr>";

}
$msg.="</tbody>";
echo  $msg;

?>
