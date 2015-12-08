<?php
include './db.php';  
session_start() ;
$store_id=$_SESSION['store_id'];

$d1=$_GET['date1'];                  //開始日期     1
$d2=$_GET['date2'];                  //結束日期
$gender=$_GET['gender'];             //性別         2 
$buyquantity=$_GET['buyquantity'];   //購買次數     3
$qdquantity=$_GET['qdquantity'];     //填寫問卷次數 4
$totalpoint=$_GET['totalpoint'];     //總點數       5

if(empty($d1)){
    if(empty($gender)){
          if(empty($buyquantity)){
              if(empty($qdquantity)){
                     $stmt=$conn->query("sELECT member.name,member.gender,
                      (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                          FROM member,shopdetail,question_detail,point
                          WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                          And point.total_pt >= '".$totalpoint."'
                          group by member.mem_id ");

                      $msg="";
                      $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                              $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                      }
                      $msg.="</tbody>";
              }elseif(empty($totalpoint)){
                        $stmt=$conn->query("sELECT member.name,member.gender,
                          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                            FROM member,shopdetail,question_detail,point
                            WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                            group by member.mem_id
                            having qdquantity >= '".$qdquantity."' ");
                        $msg="";
                        $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                        }
                        $msg.="</tbody>";
              }else{

                $stmt=$conn->query("sELECT member.name,member.gender,
                  (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                    FROM member,shopdetail,question_detail,point
                    WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                    And point.total_pt >= '".$totalpoint."'
                    group by member.mem_id
                    having qdquantity >= '".$qdquantity."' ");

                $msg="";
                $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                }
                $msg.="</tbody>";
              }
          }elseif (empty($qdquantity)) {
                  if(empty($totalpoint)){
                            $stmt=$conn->query("sELECT member.name,member.gender,
                              (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                                FROM member,shopdetail,question_detail,point
                                WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                                group by member.mem_id
                                having buyquantity >= '".$buyquantity."' ");

                            $msg="";
                            $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                    $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                            }
                            $msg.="</tbody>";
                  }else{
                      $stmt=$conn->query("sELECT member.name,member.gender,
                        (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                          FROM member,shopdetail,question_detail,point
                          WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                          And point.total_pt >= '".$totalpoint."'
                          group by member.mem_id
                          having buyquantity >= '".$buyquantity."' ");

                      $msg="";
                      $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                              $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                      }
                      $msg.="</tbody>";
            }
          }elseif (empty($totalpoint)) {
                             $stmt=$conn->query("sELECT member.name,member.gender,
                              (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                                  FROM member,shopdetail,question_detail,point
                                  WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                                  group by member.mem_id
                                  having buyquantity >= '".$buyquantity."' 
                                  and qdquantity >= '".$qdquantity."' ");

                              $msg="";
                              $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                              foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                      $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                              }
                              $msg.="</tbody>";
            
          }else{
                  $stmt=$conn->query("sELECT member.name,member.gender,
                    (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                      FROM member,shopdetail,question_detail,point
                      WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                      And point.total_pt >= '".$totalpoint."'
                      group by member.mem_id
                      having buyquantity >= '".$buyquantity."' 
                      and qdquantity >= '".$qdquantity."' ");

                  $msg="";
                  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                          $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                  }
                  $msg.="</tbody>";
              }
    }elseif (empty($buyquantity)) {
            if(empty($qdquantity)){
                  if (empty($totalpoint)) {
                         $stmt=$conn->query("sELECT member.name,member.gender,
                          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                              FROM member,shopdetail,question_detail,point
                              WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                              And member.gender = '".$gender."'
                              group by member.mem_id ");

                          $msg="";
                          $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                          foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                  $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                          }
                          $msg.="</tbody>";
                  }else{
                        $stmt=$conn->query("sELECT member.name,member.gender,
                          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                            FROM member,shopdetail,question_detail,point
                            WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                            And member.gender = '".$gender."'
                            And point.total_pt >= '".$totalpoint."'
                            group by member.mem_id ");

                        $msg="";
                        $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                        }
                        $msg.="</tbody>";
                  }

            }elseif (empty($totalpoint)) {
                  $stmt=$conn->query("sELECT member.name,member.gender,
                    (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                      FROM member,shopdetail,question_detail,point
                      WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                      And member.gender = '".$gender."'
                      group by member.mem_id
                      having qdquantity >= '".$qdquantity."' ");

                  $msg="";
                  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                          $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                  }
                  $msg.="</tbody>";
              
            }else{
                $stmt=$conn->query("sELECT member.name,member.gender,
                  (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                    FROM member,shopdetail,question_detail,point
                    WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                    And member.gender = '".$gender."'
                    And point.total_pt >= '".$totalpoint."'
                    group by member.mem_id
                    having  qdquantity >= '".$qdquantity."' ");

                $msg="";
                $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                }
                $msg.="</tbody>";
            }
      
    }elseif (empty($qdquantity)) {
        if(empty($totalpoint)){
                $stmt=$conn->query("sELECT member.name,member.gender,count(shopdetail.mem_id)as buyquantity, count(question_detail.mem_id) as qdquantity,total_pt
                    FROM member,shopdetail,question_detail,point
                    WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                    And member.gender = '".$gender."'
                    group by member.mem_id
                    having buyquantity >= '".$buyquantity."' ");

                $msg="";
                $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                }
                $msg.="</tbody>";
        }else{
                  $stmt=$conn->query("sELECT member.name,member.gender,count(shopdetail.mem_id)as buyquantity, count(question_detail.mem_id) as qdquantity,total_pt
                      FROM member,shopdetail,question_detail,point
                      WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                      And member.gender = '".$gender."'
                      And point.total_pt >= '".$totalpoint."'
                      group by member.mem_id
                      having buyquantity >= '".$buyquantity."' ");

                  $msg="";
                  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                          $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                  }
                  $msg.="</tbody>";
        }
      
    }elseif (empty($totalpoint)) {
                $stmt=$conn->query("sELECT member.name,member.gender,count(shopdetail.mem_id)as buyquantity, count(question_detail.mem_id) as qdquantity,total_pt
                    FROM member,shopdetail,question_detail,point
                    WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                    And member.gender = '".$gender."'
                    group by member.mem_id
                    having buyquantity >= '".$buyquantity."' 
                    and qdquantity >= '".$qdquantity."' ");

                $msg="";
                $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                }
                $msg.="</tbody>";
    }else{
        $stmt=$conn->query("sELECT member.name,member.gender,
          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
            FROM member,shopdetail,question_detail,point
            WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
            And member.gender = '".$gender."'
            And point.total_pt >= '".$totalpoint."'
            group by member.mem_id
            having buyquantity >= '".$buyquantity."' 
            and qdquantity >= '".$qdquantity."' ");

        $msg="";
        $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
        }
        $msg.="</tbody>";
    }

}elseif (empty($gender)) {
        if(empty($buyquantity)){
                if(empty($qdquantity)){
                        $stmt=$conn->query("sELECT member.name,member.gender,
                          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                              FROM member,shopdetail,question_detail,point
                              WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                              And point.total_pt >= '".$totalpoint."'
                              group by member.mem_id ");

                          $msg="";
                          $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                          foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                                }
                                $msg.="</tbody>";

                }elseif (empty($totalpoint)) {
                          $stmt=$conn->query("sELECT member.name,member.gender,
                            (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                              FROM member,shopdetail,question_detail,point
                              WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                              AND question_detail.qd_date between  '".$d1."' and '".$d2."'
                              group by member.mem_id
                              having qdquantity >= '".$qdquantity."' ");

                          $msg="";
                          $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                          foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                                }
                                $msg.="</tbody>";
                  
                }else{
                      $stmt=$conn->query("sELECT member.name,member.gender,
                        (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                          FROM member,shopdetail,question_detail,point
                          WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                          And point.total_pt >= '".$totalpoint."'
                          AND question_detail.qd_date between  '".$d1."' and '".$d2."' 
                          group by member.mem_id
                          having  qdquantity >= '".$qdquantity."' ");

                      $msg="";
                      $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                            $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                            }
                            $msg.="</tbody>";
                }


        }elseif(empty($qdquantity)){
                if (empty($totalpoint)) {
                        $stmt=$conn->query("sELECT member.name,member.gender,
                          (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                            FROM member,shopdetail,question_detail,point
                            WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                            AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                            group by member.mem_id
                            having buyquantity >= '".$buyquantity."' ");

                        $msg="";
                        $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                              $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                              }
                              $msg.="</tbody>";
                  
                }else  {
                    $stmt=$conn->query("sELECT member.name,member.gender,
                      (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                        FROM member,shopdetail,question_detail,point
                        WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                        And point.total_pt >= '".$totalpoint."'
                        AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                        group by member.mem_id
                        having buyquantity >= '".$buyquantity."' ");

                    $msg="";
                    $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                          $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                          }
                          $msg.="</tbody>";
                
                }

        }elseif (empty($totalpoint)) {
                  $stmt=$conn->query("sELECT member.name,member.gender,
                    (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                      FROM member,shopdetail,question_detail,point
                      WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                      AND question_detail.qd_date between  '".$d1."' and '".$d2."'
                      AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                      group by member.mem_id
                      having buyquantity >= '".$buyquantity."' 
                      and qdquantity >= '".$qdquantity."' ");

                  $msg="";
                  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                        }
                        $msg.="</tbody>";
          
        }else{
              $stmt=$conn->query("sELECT member.name,member.gender,
                (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                  FROM member,shopdetail,question_detail,point
                  WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                  And point.total_pt >= '".$totalpoint."'
                  AND question_detail.qd_date between  '".$d1."' and '".$d2."'
                  AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                  group by member.mem_id
                  having buyquantity >= '".$buyquantity."' 
                  and qdquantity >= '".$qdquantity."' ");

              $msg="";
              $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
              foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                    $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                    }
                    $msg.="</tbody>";

        }

}elseif (empty($buyquantity)) {
        if(empty($qdquantity)){
              if (empty($totalpoint)) {
                      $stmt=$conn->query("sELECT member.name,member.gender,
                        (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                          FROM member,shopdetail,question_detail,point
                          WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                          And member.gender = '".$gender."'
                          group by member.mem_id ");

                      $msg="";
                      $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                            $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                            }
                            $msg.="</tbody>";
              }else{
                  $stmt=$conn->query("sELECT member.name,member.gender,
                    (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                      FROM member,shopdetail,question_detail,point
                      WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                      And member.gender = '".$gender."'
                      And point.total_pt >= '".$totalpoint."'
                      group by member.mem_id ");

                  $msg="";
                  $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                        $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                        }
                        $msg.="</tbody>";
              }

        }elseif (empty($totalpoint)) {
                $stmt=$conn->query("sELECT member.name,member.gender,
                  (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                    FROM member,shopdetail,question_detail,point
                    WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                    And member.gender = '".$gender."'
                    AND question_detail.qd_date between  '".$d1."' and '".$d2."'
                    group by member.mem_id
                    having qdquantity >= '".$qdquantity."' ");

                $msg="";
                $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                      $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                      }
                      $msg.="</tbody>";
          
        }else{
              $stmt=$conn->query("sELECT member.name,member.gender,
                (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                  FROM member,shopdetail,question_detail,point
                  WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                  And member.gender = '".$gender."'
                  And point.total_pt >= '".$totalpoint."'
                  AND question_detail.qd_date between  '".$d1."' and '".$d2."'
                  group by member.mem_id
                  having  qdquantity >= '".$qdquantity."' ");

              $msg="";
              $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
              foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                    $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                    }
                    $msg.="</tbody>";
        }

}elseif (empty($qdquantity)) {
        if(empty($totalpoint)){
              $stmt=$conn->query("sELECT member.name,member.gender,
                (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                  FROM member,shopdetail,question_detail,point
                  WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                  And member.gender = '".$gender."'
                  AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                  group by member.mem_id
                  having buyquantity >= '".$buyquantity."' ");

              $msg="";
              $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
              foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                    $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                    }
                    $msg.="</tbody>";

        }else{
            $stmt=$conn->query("sELECT member.name,member.gender,
              (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
                FROM member,shopdetail,question_detail,point
                WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
                And member.gender = '".$gender."'
                And point.total_pt >= '".$totalpoint."'
                AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
                group by member.mem_id
                having buyquantity >= '".$buyquantity."' ");

            $msg="";
            $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                  $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                  }
                  $msg.="</tbody>";
        }

}elseif (empty($totalpoint)) {
          $stmt=$conn->query("sELECT member.name,member.gender,
            (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
              FROM member,shopdetail,question_detail,point
              WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
              And member.gender = '".$gender."'
              AND question_detail.qd_date between  '".$d1."' and '".$d2."'
              AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
              group by member.mem_id
              having buyquantity >= '".$buyquantity."' 
              and qdquantity >= '".$qdquantity."' ");

          $msg="";
          $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
          foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
                }
                $msg.="</tbody>";
}else{
      $stmt=$conn->query("sELECT member.name,member.gender,
        (Select count(question_detail.mem_id) from question_detail where member.mem_id=question_detail.mem_id  group by mem_id )as qdquantity ,
        (SELECT count(shopdetail.mem_id) FROM shopdetail where member.mem_id=shopdetail.mem_id group by mem_id ) as buyquantity , total_pt
          FROM member,shopdetail,question_detail,point
          WHERE member.mem_id=shopdetail.mem_id AND member.mem_id=question_detail.mem_id AND member.mem_id=point.mem_id
          And member.gender = '".$gender."'
          And point.total_pt >= '".$totalpoint."'
          AND question_detail.qd_date between  '".$d1."' and '".$d2."'
          AND shopdetail.buy_date between  '".$d1."' and '".$d2."'
          group by member.mem_id
          having buyquantity >= '".$buyquantity."' 
          and qdquantity >= '".$qdquantity."' ");

      $msg="";
      $msg.='<thead><tr><th>姓名</th><th>性別</th><th>購買次數</th><th>填寫問卷次數</th><th>總點數</th></tr></thead><tbody>';
      foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
            $msg.="<tr><td>".$row['name']."</td><td>".$row['gender']."</td><td>".$row['buyquantity']."</td><td>".$row['qdquantity']."</td><td>".$row['total_pt']."</td></tr>";
            }
            $msg.="</tbody>";

}
echo  $msg;
?>
