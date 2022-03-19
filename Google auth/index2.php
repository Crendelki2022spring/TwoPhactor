<?
require_once 'GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();


if ($_GET['enter']) {
    // exit('ok');
    
    echo "<p>Secret is: . $secret . </p>";

    $qrCodeUrl = $ga->getQRCodeGoogleUrl('test123', $secret);
    echo '<img src="' . $qrCodeUrl . '">';
}

if ($_GET['confirm']) {
    // require_once 'GoogleAuthenticator.php';
    // $ga = new GoogleAuthenticator();
    // $ga1 = new GoogleAuthenticator();
    // $secret = $ga->createSecret();
    $checkResult = $ga->verifyCode($secret, $_GET['code'], 1);
    if ($checkResult) {
        exit('OK');
    } else {
        exit('FAILED');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reg</title>
</head>

<body>
    <form>
        <p>Get code</p>
        <p><input type="submit" name="enter"></p>
        <p>Confirm code</p>
        <p><input type="text" name="code"></p>
        <p><input type="submit" name="confirm"></p>
    </form>
</body>

</html>