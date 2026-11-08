<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
    $secret_key = '6Lcd2hYuAAAAAPmBH4aEmAhvyBaAW50SUOwO2I87'; 
    
    if (empty($recaptcha_response)) {
        echo "Fout: Vink alstublieft de reCAPTCHA aan.";
        exit;
    }
    
    
    $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}";
    $response = file_get_contents($verify_url);
    $result = json_decode($response);
    
    if ($result && $result->success == true) {

        $bericht = htmlspecialchars($_POST['bericht']);
        
        echo "Bericht succesvol verzonden: " . $bericht;
    } else {
        echo "Fout: reCAPTCHA-verificatie mislukt. Probeer het opnieuw.";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
