<?php
namespace App;


class MailerLiteApiRequests
{ 

    
    private string $key;    /**  @var string **/

    /**
     * __construct
     * *
     * @param  string $key
     * @return void
     */
    public function __construct(string $key)
    {
        $this->key=$key;
    }

    
      
     
    /**
     * sendRequestToMailerLiteAPISdk
     *
     * @param  string $orderby
     * @param  array $limits
     * @param  string $where
     * @param  string $data
     * @return array
     */
    public function sendRequestToMailerLiteAPISdk(string $orderby='asc', array $limits=[], string $where='', string $data='')
    { 

        $mailerliteClient = new \MailerLiteApi\MailerLite($this->key);


       
        if ($where=='') {
            $filters=['type' => 'active'];

        } else {
            $filters=['type' => 'active','email'=>['like'=>$where]]; 

        }
        if ($limits==[]) {
            $subscribersApi = $mailerliteClient->subscribers()->where($filters)->orderBy('email', $orderby)->get(); //orderby with column

        } else {
            $limit=$limits[1];
            $offset=$limits[0];
            $subscribersApi = $mailerliteClient->subscribers()->where($filters)->limit($limit)->offset($offset)->orderBy('email', $orderby)->get(); //where is not working ! so we will get all the subcribers no matter their activity type !!!
        }
 
        return $subscribersApi;
  




    }
    
 
}





?>

