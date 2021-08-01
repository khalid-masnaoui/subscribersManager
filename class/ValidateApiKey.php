<?php
namespace App;

use App\DB;
use App\MailerLiteApiRequests;
use App\ProcessResponeData;


class ValidateApiKey
{ 

    private DB $db;    /**  @var DB  **/
    private string $key;    /**  @var string **/


    /**
     * __construct
     *
     * @param string $key
     * @return void
     */

    public function __construct(string $key) 
    {

        $this->key=$key;
        $this->db=DB::getInstance();

        
    }

    
      

      
    /**
     * checkValidation
     *
     * @return void
     */
    public function checkValidation()
    {


        $request =  new MailerLiteApiRequests($this->key); 
        $request = $request->sendRequestToMailerLiteAPISdk();
        $response = new ProcessResponeData();
        $response= $response->process($request);

        // $response=json_decode($response, true);

        if (isset($response["error"])) {
            echo "invalid";
            //we can send different message for each error code

        } else {
            $this->db->delete("valid_api_key"); //delete previous key!
            
            $this->db->insert("valid_api_key",["ApiKey"=>$this->key]);
            
            if ($this->db->error()!=1) {
                echo "valid";

            } else {
                echo "cant process your request!";
            }

            
        }   

    }
 
}





?>

