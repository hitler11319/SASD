<?php
  session_start();
  //session_destroy();
  //載入db.php，就可以連資料庫
  require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <!--套用助教給的bootstrap樣板-->
  <head>
    <meta charset="utf-8">
    <title>電影觀賞心得分享平台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://bootswatch.com/cyborg/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
    <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!--連結有上層功能列表的檔案-->
    
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <form class="form-horizontal"  method="post" action="register.php">
            <fieldset>
              <legend>註冊</legend>
              <div class="form-group">
                <label for="inputAccount" class="col-lg-3 control-label">帳號</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="inputAccount" placeholder="Account number" name="MemberAccount">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">密碼</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="MemberPassword">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-3 control-label">信箱帳號</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="inputEmail" placeholder="E-mail" name="MemberEmail">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3">
                  <button type="submit" class="btn btn-primary" name="submit">註冊</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="col-sm-4"></div>
      </div>

    
  </body>
</html>
<?php
  if(isset($_POST['MemberAccount']) && isset($_POST['MemberPassword']) && isset($_POST['MemberEmail'])){
        
    $MemberAccount=$_POST['MemberAccount'];
    $MemberPassword=$_POST['MemberPassword'];
    $MemberEmail=$_POST['MemberEmail'];
      
    
      $sql = "INSERT INTO `member` (`MemberAccount`, `MemberPassword`, `MemberEmail`) VALUES ('{$MemberAccount}', '{$MemberPassword}', '{$MemberEmail}');";
      
      
      //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
      $result = mysqli_query($_SESSION['link'], $sql);
      if(mysqli_affected_rows($_SESSION['link']) > 0)
      {
        echo "<script>alert('註冊成功！');</script>";

      $new_id = mysqli_insert_id($_SESSION['link']);
      echo "<script>location.href = 'login.php' ;</script>";
      //echo "執行成功，新增後的 id 為 {$new_id}";
      }
      elseif(mysqli_affected_rows($_SESSION['link']) == 0)
      {
      echo "<script>alert('註冊失敗');</script>";
      }
      else
      {
      echo  "<br>{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
      }
      
      }
      mysqli_close($_SESSION['link']);
?>