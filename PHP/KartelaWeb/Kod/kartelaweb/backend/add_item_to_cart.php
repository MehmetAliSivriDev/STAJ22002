<?php 
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["Bar"]) && isset($_POST["Varyant"]) && isset($_POST["Desen"]) && isset($_POST["Com"]) && isset($_POST["DesenKod"])
    && isset($_POST["Kg"]) && isset($_POST["En"]) && isset($_POST["Renk"]) && isset($_POST["Tip"]) && isset($_POST["KEn"]) && isset($_POST["image"])
    && isset($_POST["count"])
    ){

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }else{
            $cart = $_SESSION['cart'];
        }

        $image = test_input($_POST["image"]);
        $bar = test_input($_POST["Bar"]);
        $variant = test_input($_POST["Varyant"]);
        $pattern = test_input($_POST["Desen"]);
        $com = test_input($_POST["Com"]);
        $patternCode = test_input($_POST["DesenKod"]);
        $kg = test_input($_POST["Kg"]);
        $width = test_input($_POST["En"]);
        $color = test_input($_POST["Renk"]);
        $type = test_input($_POST["Tip"]);
        $kWidth = test_input($_POST["KEn"]);
        $count = test_input($_POST["count"]);


        $isAlreadyDefined = false;

        if(isset($cart) && $cart != null && $cart != []){

            for ($i=0; $i < count($cart); $i++) { 
                if($cart[$i]['Bar'] == $bar){
                    $cart[$i]['count'] = strval((int)$cart[$i]['count'] + (int)$count);
                    $isAlreadyDefined = true;
                }
            }

            $_SESSION['cart'] = $cart;
        }

        if($isAlreadyDefined == false){

            $kartelaData = array(
                'Bar' => $bar,
                'Varyant' => $variant,
                'Desen' => $pattern,
                'Com' => $com,
                'DesenKod' => $patternCode,
                'Kg' => $kg,
                'En' =>  $width,
                'Renk' => $color,
                'Tip' => $type,
                'KEn' => $kWidth,
                'Image' => $image,
                'count' => $count
            );
            
            
            $_SESSION['cart'][] = $kartelaData;
        }

        $_SESSION["result"] = "1";
        $_SESSION["message"] = "Ürün sepete başarıyla eklendi";
        header("Location: /kartelaweb/view/show_alert_view.php");
    }
?>