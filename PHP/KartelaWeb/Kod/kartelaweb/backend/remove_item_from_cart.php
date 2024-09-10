<?php 
    session_start();
    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["Bar"])
    ){
        $bar = test_input($_POST["Bar"]);

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['Bar'] == $bar) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);

        $_SESSION["result"] = "1";
        $_SESSION["message"] = "Ürün Başarıyla Sepetten Kaldırıldı";
        header("Location: /kartelaweb/view/show_alert_view.php");
    }
?>