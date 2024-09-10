<?php 
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['barcode']) && isset($_POST['companyName']) && isset($_POST['topNo']) && isset($_POST['salesM']) && isset($_POST['price'])
    ){

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }else{
            $cart = $_SESSION['cart'];
        }

        $barcode = test_input($_POST['barcode']);
        $companyName = test_input($_POST['companyName']);
        $topNo = test_input($_POST['topNo']);
        $salesM = test_input($_POST['salesM']);
        $price = test_input($_POST['price']);

        $cartItem = array(
            'barcode' => $barcode,
            'companyName' => $companyName,
            'topNo' => $topNo,
            'salesM' => $salesM,
            'price' => $price,
        );
        
        
        $_SESSION['cart'][] = $cartItem;
        

        $_SESSION["result"] = "1";
        $_SESSION["message"] = "Sepete Başarıyla Eklendi";
        header("Location: /stokweb/view/show_alert_view.php");
    }
?>