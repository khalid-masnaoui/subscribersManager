<?php 
namespace App;



class ProcessResponeData
{
  

    
    /**
     * __construct
     * *
     * @param  array $key
     * @return void
     */
    public function __construct()
    {

    }

    
      
    
    
    /**
     * process
     *
     * @param  Object $response
     * @return array
     */
    public function process(Object $response)
    { 

   

        $data=[];
        if (isset($response[0]->error)) {
            return ["error"=>$response[0]->error->message];
        } else {
            foreach ($response as $key => $value) { 
                //we have a subscriber object $value
            
                //get the country from the fields
    
                
                
    
                    $countryField = array_filter($value->fields, function($e) {
                        return $e->key == "country"; 
                    });
                    $country=$countryField[4]->key;
        
                    $created_date=$value->date_created; 
                    // $created_date=$value->date_subscribe;
                    //we will use the subcribe date the same as date_created field (because when we add a new subcriber , only the date created column is added , "date_subscribe" field has a null value) [my understanding can be wrong, and in this case we can easily change the field used to date_subscribe ]
                    if ($created_date!='' && $created_date!=null) { 
                        //i added this if statement mainly because we can switch to use "date_subscribe" field which can have empty or null value
                        strtotime($created_date);
                        $subscribe_date=date("d/m/Y", strtotime($created_date));
                        $subscribe_time=date("H:i:s", strtotime($created_date));
                    } else {
                        $subscribe_date="0/0/0 00:00:00";
                        $subscribe_time="0/0/0 00:00:00";
                    }
    
                    $deleteButton="<span data-email=$value->email ><img src='/assets/images/delete.png' class='pointer'></img></span>";
                    $data[]=[$value->email,$value->name,$country,$subscribe_date,$subscribe_time,$deleteButton];
    
        
    
             
    
    
    
    
                // i did not insert values in assoc array with filed name because in future we can change the fileds name;
            }
        }
        
        
        return $data;




    }
    
 
}





?>









