<?php
namespace App;


class SubscriberController
{ 

    
    private \MailerLiteApi\MailerLite $mailerliteClient;    /**  @var string **/

    
    /**
     * __construct
     * *
     * @param  string $key
     * @return void
     */
    public function __construct(string $key)
    {
        $this->mailerliteClient = new \MailerLiteApi\MailerLite($key);
    }

    
      
     
    /**
     * createNewSubscriber
     *
     * @param  array $subscriberData
     * @return string
     */
    public function createNewSubscriber(array $subscriberData)
    { 


        $subscribersApi = $this->mailerliteClient->subscribers();
    
        $addedSubscriber = $subscribersApi->create($subscriberData);
    
        if (isset($addedSubscriber->error)) {
            return $addedSubscriber->error->message;
        } else {
            return "created";
        }
    }
    
    /**
     * updateExistingSubscriber
     *
     * @param  array $subscriberData
     * @param  string $email
     * @return string
     */
    public function updateExistingSubscriber(array $subscriberData, string $email)
    { 


        $subscribersApi = $this->mailerliteClient->subscribers();
    
        $editedSubscriber = $subscribersApi->update($email,$subscriberData);
    
        if (isset($editedSubscriber->error)) {
            return $editedSubscriber->error->message;
        } else {
            return "updated";
        }
    }

        
    /**
     * deleteSubscriber
     *
     * @param  string $email
     * @return string
     */
    public function deleteSubscriber(string $email){ 


        $subscribersApi = $this->mailerliteClient->subscribers();
    
        $deletedSubscriber = $subscribersApi->delete($email);
    
        if (isset($deletedSubscriber->error)) {
            return $deletedSubscriber->error->message;
        } else {
            return "deleted";
        }
    }
    
 
}





?>

