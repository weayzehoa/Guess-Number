<form method="POST">
<input type="number" name="guess" maxlength="4" placeholder="請輸入四個數字" autoforcus autocomplete="off" required><input type="submit" value="送出"><br>
</form>
訊息:

<?php
session_start();
$guess["num"]= Array(); //宣告 $guess["num"] 為陣列

if (empty($_POST["guess"])) { //如果未輸入任何字 或 輸入其他字元, is_numeric用來判斷是否為數字, !為相反
//if (empty($_POST["guess"]) || !is_numeric($_POST["guess"])) { //如果未輸入任何字 或 輸入其他字元, is_numeric用來判斷是否為數字, !為相反
echo "請勿空白或輸入其他字元<br>";               //顯示警告訊息
}
else{
    $guess["num"] = preg_split('//', $_POST["guess"], -1, 1); //將得到的數字字串拆成單個並放入$guess["num"]陣列中
    $c=0;
    if ($guess["num"][0]==$guess["num"][1]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($guess["num"][0]==$guess["num"][2]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($guess["num"][0]==$guess["num"][3]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($guess["num"][1]==$guess["num"][2]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($guess["num"][1]==$guess["num"][3]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($guess["num"][2]==$guess["num"][3]) {$c=$c+1; }       //如果陣列內數字比對相同則 $c+1
    if ($c>=1) {                                              //如果c>=1代表有數字相同
        echo "請勿輸入重複數字<br>";                           //顯示警告訊息
    }

    else {
        $a=0;$b=0;                          //宣告 $a, $b變數從0開始
        for ($i=0; $i < 4; $i++) {              //比對兩個陣列的迴圈
            for ($j=0; $j < 4; $j++) { 
                if ($_SESSION["rand"][$i]==$guess["num"][$j]) {$b=$b+1; }       //如果陣列內數字比對相同則 $b+1
                if (($i==$j) && ($_SESSION["rand"][$i]==$guess["num"][$j])) {   //如果同位置陣列比對相同則 $b-1, $a+1
                $a=$a+1; $b=$b-1;           //累計 $a, $b
                }
            }
        }
        
            $_SESSION["times"] = $_SESSION["times"]+1;              //利用session陣列來存放猜的次數
            //$times=$_SESSION["times"];                              //轉換變數 以利操作
            $_SESSION["rec"][($_SESSION["times"] - 1)]="第 ".$_SESSION["times"]." 次 ".$_POST["guess"]." == ".$a."A ".$b."B<br>"; //儲存記錄陣列
        
        if ($a==4) {        //如果答案4A則顯示全部猜對, 並清除session 或 跳出別的頁面.
            if ($_SESSION["times"]==1) {
            echo "你太厲害了, 猜 ".$_SESSION["times"]." 次就中";
            }
            else{
            echo "恭喜, 你全部猜對了!!, 總共猜了 ".$_SESSION["times"]." 次";
            }
            //session_destroy();
            echo '<form method="POST" action="rand.php"><input type="submit" value="重玩"></form>';
            echo '<form method="POST" action="index.php"><input type="submit" value="回首頁"></form>';
        }
        
    }
}

?>




<?php echo "<hr>紀錄：<br>";
foreach ($_SESSION["rec"] as $rec) {echo $rec; }?>
