<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
    $secret_key = '6Lcd2hYuAAAAAPmBH4aEmAhvyBaAW50SUOwO2I87'; 
    
    if (empty($recaptcha_response)) {
        echo "Fout: Je bent de reCAPTCHA vergeten aan te vinken. <a href='index.html'>Ga terug</a>";
        exit;
    }
    
    
    $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}";
    $response = file_get_contents($verify_url);
    $result = json_decode($response);
    
    if ($result && $result->success == true) {
        
        header("Location: home");
        exit;
    } else {
        echo "Verificatie mislukt. <a href='index.html'>Probeer het opnieuw</a>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
