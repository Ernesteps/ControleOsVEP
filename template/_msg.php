<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($ret)) {
    switch ($ret) {
        case -2:
            echo "<script>toastr.error(RetornarMsg(-2))</script>";
            break;

        case -1:
            echo "<script>toastr.error(RetornarMsg(-1))</script>";
            break;

        case 0:
            echo "<script>toastr.warning(RetornarMsg(0))</script>";
            break;

        case 1:
            echo "<script>toastr.success(RetornarMsg(1))</script>";
            break;

        case 2:
            echo "<script>toastr.warning(RetornarMsg(2))</script>";
            break;

        case 3:
            echo "<script>toastr.warning(RetornarMsg(3))</script>";
            break;

        case 4:
            echo "<script>toastr.info(RetornarMsg(4))</script>";
            break;

        case 5:
            echo "<script>toastr.info(RetornarMsg(5))</script>";
            break;

        case 6:
            echo "<script>toastr.info(RetornarMsg(6))</script>";
            break;

        case 7:
            echo "<script>toastr.info(RetornarMsg(7))</script>";
            break;

        case 8:
            echo "<script>toastr.info(RetornarMsg(8))</script>";
            break;
    }
}
