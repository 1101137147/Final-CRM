<?php 
//include './db.php';
//header("Content-Type:text/html; charset=utf-8");
//$stmt = $conn->prepare("SELECT functionname,path FROM `function`");
//$stmt->execute();
//$res = '';
//foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
//    $res.='<li ><a href="' . $row['path'] . '.php" style="font-size:12pt">' . $row['functionname'] . '</a></li>';
//}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
        <script src="script/jquery-1.11.3.min.js"></script>
        <script src="script/jquery.mobile-1.4.5.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jqm-datebox.min.css" />
        <script type="text/javascript" src="script/jqm-datebox.core.min.js"></script>
        <script type="text/javascript" src="script/jqm-datebox.mode.calbox.min.js"></script>
        <script type="text/javascript" src="script/jquery.mobile.datebox.i18n.zh-TW.utf8.js"></script>
        <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>

        <div id="menu">
            <ul>
                <li class="main"><a href="../store/StoreManage/view/home/home.php" accesskey="1" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-btn-icon-left btn" rel="external">後台管理</a></li>
            </ul>
        </div>

        <a href="active.php" rel="external">
            <div id="wrapper2">
                <div id="welcome" class="container">
                    <div class="title">
                        <h2>活動分析</h2>
                        <span class="byline">Activity Analysis</span> 
                    </div>

                </div>
            </div>
        </a>
        <a href="member.php" rel="external">
            <div id="wrapper1">
                <div id="welcome" class="container">
                    <div class="title">
                        <h2>會員分析</h2>
                        <span class="byline">Member Analysis</span> 
                    </div>

                </div>
            </div>
        </a>
        <a href="integrate.php" rel="external">
            <div id="wrapper4">
                <div id="footer" class="container">
                    <div>
                        <header class="title">
                            <h2>整合分析</h2>
                            <span class="byline">Integrate Analysis</span> </header>

                    </div>
                </div>
            </div>
        </a>
    </body>
</html>
