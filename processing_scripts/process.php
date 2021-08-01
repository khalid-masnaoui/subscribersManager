<?php
require_once '../bootstrap.php';

use \App\ValidateApiKey;
use \App\DB;
use \App\SubscriberController;


if (isset($_POST["key"])) { //API Key Validation

    $key=$_POST["key"];
    $ValidateApiKey= new ValidateApiKey($key);
    $ValidateApiKey->checkValidation();

}

if (isset($_POST["email"])) { //creating  a new subcriber

    $email=$_POST["email"];
    $name=$_POST["name"];
    $country=$_POST["country"];

    
    $db=DB::getInstance();

    $data=$db->get('ApiKey','valid_api_key')->first();

    $key=$data["ApiKey"];

    $subscriber = [
        'email' => $email,
        'name' => $name,
       'country' => $country,
        ];

    $SubscriberController= new SubscriberController($key);
    $addedSubscriber= $SubscriberController->createNewSubscriber($subscriber);
    echo $addedSubscriber;
  

   

}

if (isset($_POST["email_edit"])) { //creating  a new subcriber

    $email=$_POST["email_edit"];
    $name=$_POST["name"];
    $country=$_POST["country"];

    
    $db=DB::getInstance();

    $data=$db->get('ApiKey','valid_api_key')->first();

    $key=$data["ApiKey"];
       // change fields of subscriber
    $subscriberData = [
        'name'=>$name,
        'country'=>$country,
    ];

    $SubscriberController= new SubscriberController($key);
    $editedSubscriber= $SubscriberController->updateExistingSubscriber($subscriberData,$email);
    echo $editedSubscriber;


}

if (isset($_POST["email_delete"])) { //creating  a new subcriber

    $email=$_POST["email_delete"];
 

    
    $db=DB::getInstance();

    $data=$db->get('ApiKey','valid_api_key')->first();

    $key=$data["ApiKey"];
    $SubscriberController= new SubscriberController($key);
    $deletedSubscriber= $SubscriberController->deleteSubscriber($email);
    echo $deletedSubscriber;

}


if (isset($_POST["change_account"])) { //change the account
    $db=DB::getInstance();

    $db->delete("valid_api_key"); //delete previous key!

    echo "success";
}

?>