<?php
    session_start();

    session_destroy();
    $_SESSION=[];
    //setcookie("usuario", "", time()-36000, "/");
    //setcookie("pass",    "", time()-36000, "/");
    setcookie("usuario","", time()-6000);
    setcookie("pass","",time()-6000);
    header("Location:login.php");
    ?>