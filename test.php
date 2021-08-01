<?php
require_once 'vendor/autoload.php';

$key='ac8cc7dbb0cc3c20b3df4627208646f5';
$orderby='desc';
$mailerliteClient = new \MailerLiteApi\MailerLite($key);

// $subscribersApiData = $mailerliteClient->subscribers()->where(['email'=>"zx@zx.com"])->get();; 
// $subscribersApiData = $mailerliteClient->subscribers();


//where is not working ! so we will get all the subcribers no matter their activity type !!!

// 

// $subscriber = [
//   'email' => 'johndosssswse@maisslessssssrsslite.com',
//   'name' => 'Johsssssswssssn',
//   'fields' => [
//     'surname' => 'Doe',
//     'company' => 'MailerLssite'
//   ]
//   ];

// $addedSubscriber = $subscribersApiData->create($subscriber); // returns added subscriber

$subscribersApiData = $mailerliteClient->subscribers()->where(['email'=>"zx@zx.com"])->get();; 

print_r($subscribersApiData);





?>