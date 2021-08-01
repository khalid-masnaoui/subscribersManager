
<?php
    require_once '../bootstrap.php';
    use \App\DB;
    use \App\MailerLiteApiRequests;
    use \App\SSP;

    //get of dtatable with server side processing
    if (isset($_GET["draw"])) {
        
    

    $db=DB::getInstance();

    $data=$db->get('ApiKey','valid_api_key')->first();

    $key=$data["ApiKey"];

  
 
    echo json_encode(
        SSP::simple( $_GET,$key)
    );
    }





?>