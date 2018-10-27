<?php
session_start();
$_SESSION["times"] = 0;      //玩家猜的次數計數器
$_SESSION["rec"] = Array();  //紀錄玩家猜測的數字及系統回應的資料
$_SESSION["rand"] = Array(); //定義取四個數字為陣列, 並給其他頁面使用
for ($i = 0; $i < 4; $i++) {  //共產生幾筆, 4筆
    $Rand = rand(0,9); //取得範圍為0~9亂數
     if (in_array($Rand, $_SESSION["rand"])) { //比較陣列中的數是否已存在
        $i--;                                   //如果已產生過,變數減一,讓迴圈重跑
    }else{
        $_SESSION["rand"][$i] = $Rand; //若無重復則 將亂數塞入陣列
    }
}
// debug用, 顯示取出的四個數
//foreach ($_SESSION["rand"] as $n) {
//    echo $n;
//}
?>

這是我用PHP寫的猜數字遊戲, 按開始來玩猜數字遊戲.
猜數字規則:
1. 系統會隨機選出四個不重複的號碼. 由玩家輸入四個號碼來給系統判斷. 
2. 若第一個數字與第一個數字相同則回應A. 若與其他位置相同則回應B. (依此類推至第四個數字)
3. 達到4A則與系統四位數完全相同.
<form method="POST" action="guess.php"><input type="submit" value="開始">
</form>