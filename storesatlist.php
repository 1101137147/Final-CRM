<?php

include './db.php';\
session_start() ;
$store_id=$_SESSION['store_id'];
$d1 = $_GET['date1'];
$d2 = $_GET['date2'];
$active = $_GET['active'];
$a = 0;
$b = 0;
$c = 0;
$d = 0;
$numa = 0; //算非常滿意百分比的變數
$numb = 0; //算滿意百分比的變數
$numc = 0; //算不滿意百分比的變數
$numd = 0; //算非常不滿意百分比的變數
$sum=0;
$temp_name = "";

$stmt = $conn->query("select  qb.qst_name,answer 
        From qstnirdetail as qd,questionnaire as qi,question_bank as qb
       where qi.qst_id=qb.qst_id
       and qb.qstb_id = qd.qstb_id  
       and qst_type='store'
       and qi.qst_name='".$active."'
        and start_date between '" . $d1 . "' and '" . $d2 . "'
         and qi.store_id='".$store_id."'
         order by  qb.qst_name
        ");
$msg = '<table id="info1" data-role="table"  class="ui-responsive" border="1">';
$msg.='<thead><tr><th>問卷題目</th><th>非常滿意</th><th>百分比</th><th>滿意</th><th>百分比</th><th>不滿意</th><th>百分比</th><th>非常不滿意</th><th>百分比</th></tr></thead><tbody>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    if ($temp_name == "")
        $temp_name = $row['qst_name'];
        
    if ($temp_name != $row['qst_name']) {
        $numa = round(($a / ($a + $b + $c + $d)), 4) * 100;    //計算非常滿意的百分比
        $numb = round(($b / ($a + $b + $c + $d)), 4) * 100;  //計算滿意的百分比
        $numc = round(($c / ($a + $b + $c + $d)), 4) * 100; //計算不滿意的百分比
        $numd = round(($d / ($a + $b + $c + $d)), 4) * 100; //計算非常不滿意的百分比
        $msg.="<tr><td>" . $temp_name . "</td>";
        $msg.="<td>" . $a . "</td>";
        $msg.="<td>" . $numa ."%"."</td>";
        $msg.="<td>" . $b . "</td>";
        $msg.="<td>" . $numb . "%"."</td>";
        $msg.="<td>" . $c . "</td>";
        $msg.="<td>" . $numc . "%"."</td>";
        $msg.="<td>" . $d . "</td>";
        $msg.="<td>" . $numd . "%"."</td></tr>";
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $numa = 0;
        $numb = 0;
        $numc = 0;
        $numd = 0;
        $temp_name = $row['qst_name'];
    }
    if ($row['answer'] == "非常滿意") {
        $a = $a + 1;
    } elseif ($row['answer'] == "滿意") {
        $b = $b + 1;
    } elseif ($row['answer'] == "不滿意") {
        $c = $c + 1;
    } else {
        $d = $d + 1;
    }
}

$numa = round(($a / ($a + $b + $c + $d)), 4) * 100;    //計算非常滿意的百分比
$numb = round(($b / ($a + $b + $c + $d)), 4) * 100;  //計算滿意的百分比
$numc = round(($c / ($a + $b + $c + $d)), 4) * 100; //計算不滿意的百分比
$numd = round(($d / ($a + $b + $c + $d)), 4) * 100;
$msg.="<tr><td>" . $temp_name . "</td>";
$msg.="<td>" . $a . "</td>";
$msg.="<td>" . $numa ."%"."</td>";
$msg.="<td>" . $b . "</td>";
$msg.="<td>" . $numb ."%". "</td>";
$msg.="<td>" . $c . "</td>";
$msg.="<td>" . $numc ."%". "</td>";
$msg.="<td>" . $d . "</td>";
$msg.="<td>" . $numd . "%"."</td></tr>";
$msg.="</tbody></table>";
$sum=$a+$b+$c+$d;
echo $msg;
echo "目前有".$sum."人填過此問卷";
?>
