<?php

if(!isset($_SESSION['coordinator_id']) && !isset($_SESSION['verify'])){
    header('location: signin.php');
}

?>

<h1>Verify OTP</h1>
<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="number" name="otp" placeholder="Enter OTP">
    <button type="submit" name="verify">Verify</button>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $otp = $_POST['otp'];
    if($otp == $_SESSION['otp']){
        $_SESSION['verify'] = true;
        header('location: index.php');
    }else{
        echo "Invalid OTP";
    }
}

?>
