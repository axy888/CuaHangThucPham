<?php

 if(isset($_GET['chon']))
 {
     if($_GET['chon']='xulydangky')
     {
         include("dangkycontroller.php");
     }
     elseif($_GET['chon']='xulydangnhap')
     {
         include("dangkycontroller.php");
     }
 }
?>