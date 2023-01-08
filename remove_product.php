<?php
    session_start();
    require_once "connect.php";
?>

<?php
    $conn = @new mysqli($dbHost, $dbUserWin, $dbPassWin, $database);

    if($conn -> connect_errno != 0)
    {
        echo "Connection failed: ".$conn -> connect_errno;
    }
    else
    {
        if($_SESSION['logged'] == true)
        {
            if(isset($_POST['submit']))
            {
                $product_name = $_POST['remove'];
                
                $sql = "DELETE FROM products WHERE product_nazwa = '$product_name'";
                if(mysqli_query($conn, $sql))
                {
                    echo "Produkt usuniety";
                }
                else
                {
                    echo "Błąd podczas usuwania".mysqli_error($conn);
                }
                header('Location: index.php');
            }    
            mysqli_close($conn);
        }
        elseif($_SESSION['logged'] == false)
        {
            mysqli_close($conn);
            echo "Nie jestes zalogowany";
            
        }
    }
?>