<?php
session_start();
if (empty($_GET["guess"]) || (int)$_GET["guess"]/1000 <1 ) { //如果未輸入任何字 或 輸入其他字元 或者 整數除以1000小於1
echo "請輸入四個數字<br>";
}
else{
    $guess["num"] = preg_split('//', $_GET["guess"], -1, 1); //將得到的字串拆成單個並放入陣列中

    //  debug用
    //    foreach ($_SESSION["rand"] as $rand) {echo $rand;}
    //    echo "<br>";
    //    echo $_GET["guess"];
    //    echo "<br>";
    //foreach ($guess as $gg) {echo $gg; }
    $a=0;$b=0;                          //宣告 $a, $b變數從0開始
for ($i=0; $i < 4; $i++) {              //比對兩個陣列的迴圈
    for ($j=0; $j < 4; $j++) { 
        if ($_SESSION["rand"][$i]==$guess["num"][$j]) {$b=$b+1; }       //如果陣列內數字比對相同則 $b+1
        if (($i==$j) && ($_SESSION["rand"][$i]==$guess["num"][$j])) {   //如果同位置陣列比對相同則 $b-1, $a+1
            $a=$a+1; $b=$b-1;           //累計 $a, $b
        }
    }

}
$_SESSION["times"] = $_SESSION["times"]+1;
$times=$_SESSION["times"];
$_SESSION["rec"][($times - 1)]="第 ".$_SESSION["times"]." 次 ".$_GET["guess"]." == ".$a."A ".$b."B<br>";

if ($a==4) {        //如果答案4A則顯示全部猜對, 並清除session 或 跳出別的頁面.
        
        if ($_SESSION["times"]==1) {
            echo "你太厲害了, 猜 ".$_SESSION["times"]." 次就中";
        }
        else{
            echo "恭喜, 你全部猜對了!!, 總共猜了 ".$_SESSION["times"]." 次";
        }
        
        //session_destroy();
    }
    else{
        //$_SESSION["rec"][$_SESSION["times"]] = "第 ".$_SESSION["times"]." 次 ".$_GET["guess"]." == ".$a."A ".$b."B";
        //echo "第 ".$_SESSION["times"]." 次 ".$_GET["guess"]." == ".$a."A ".$b."B";
        foreach ($_SESSION["rec"] as $rec) {
            echo $rec;
    }
        
        }
    }
    

//header("location:guess.php");
?>




<form method="get">
<input name="guess" maxlength="4" required><input type="submit" value="送出">
</form>
