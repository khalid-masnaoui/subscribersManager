<?php
namespace App;

//sigleton_pattern (getInstance);

class DB 
{
    private static $_instance=null;
    private $_pdo, $_query, $_error=false,$_results,$_count=0;


    
    /**
     * __construct initiate the pdo connection (private)
     *
     * @return void
     */
    private function __construct()
    {   
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        try {
            $this->_pdo = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
            // $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // $this->_pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            exit($e->getMessage());
            die();

        }


    }
        
    /**
     * getInstance : the method called at the class initiation
     *
     * @return void
     */
    public static function getInstance()
    { 
        if (!isset(self::$_instance)) {
            self::$_instance=new DB();
        }
        return self::$_instance;
    }
    
    
    /**
     * query
     *
     * @param  string $sql
     * @param  array $params
     * @return DB
     */
    public function query($sql, $params=[])
    {
         
        $this->_error=false;
        $this->_query=$this->_pdo->prepare($sql);
        if ($this->_query) {
            $x=1;
            if (count($params)>0) {

                foreach ($params as $param) {
                    //  ;
                    $this->_query->bindValue($x++,$param);
                }
            }

           
            if ($this->_query->execute()) {
                $this->_results=$this->_query->fetchALL(\PDO::FETCH_ASSOC);
                $this->_count=$this->_query->rowCount();
         
            } else {
                // $this->_error=$this->_query->errorInfo();
                $this->_error=true;
            }
        }
        return $this; //chainning
    }

    


    
    /**
     * action
     *
     * @param  string $action
     * @param  string $table
     * @param  array $where
     * @param  string $orderby
     * @return mixed
     */
    private function action($action , $table, $where=[],$orderby='')
    {
        if (count($where)>=1) { //also the case where no conditions are there and u can generalize it by for each array (multiple conditions)
            $operators=array("=","+","<",">","=>","=<","<>");
            $txt_where='';
            $array_values=[];
            $i=0;
            foreach ($where as $key => $element) {
                # code...
                $field=$element[0];
                $operator=$element[1];
                if(in_array($operator,$operators)){

                    $array_values[]=$element[2];

                    ($i==0) ? ($txt_where=$txt_where."{$field} {$operator} ?") : ($txt_where=$txt_where."and {$field} {$operator} ?") ;
                    $i=1;

                } elseif ($operator=='IN') {
                    $id_list="(";
                    $length=count($element[2]);
                    for ($j=0; $j < $length ; $j++) { 
                        $array_values[]=$element[2][$j];

                        if ($j==0) {
                            $id_list=$id_list."?";
                        } else {
                            $id_list=$id_list.","."?";

                        }
                    }
                    $id_list=$id_list.")";

                  
                    ($i==0) ? ($txt_where=$txt_where."{$field} {$operator} {$id_list}") : ($txt_where=$txt_where."and {$field} {$operator} {$id_list}") ;
                    $i=1;
                }
                

            }
            $sql="{$action} FROM {$table} WHERE $txt_where $orderby";
            if (!$this->query($sql,$array_values)->error()) {
                return $this;
            }
          
               
        } elseif($where==[] ){ //to get all the data without where 
            $sql="{$action} FROM {$table} $orderby";
                    if (!$this->query($sql)->error()) {
                        return $this;
                    }
        }
        return false;///////////////// 
    }

    /**
     * get    //get data    
     *
     * @param  string $fields
     * @param  string $table
     * @param  array $where
     * @param  string $orderby
     * @return mixed
     */
    public function get($fields,$table,$where=[],$orderby='')
    {  
        
         return $this->action("SELECT $fields",$table, $where,$orderby); //u can pass * in param
        //  if ($return==false) {
        //      return [];
        //  } else {
        //      return $return;
        //  }
    }

      
    /**
     * delete //delete data  
     *
     * @param  string $table
     * @param  array $where
     * @return mixed
     */
    public function delete($table,$where=[]) 
    {
        return $this->action("DELETE ",$table, $where); //u can pass * in param
    }

       
    /**
     * insert //insert data 
     *
     * @param  string $table
     * @param  string $fields
     * @return mixed
     */
    public function insert($table,$fields=[])
    {
        if (count($fields)) {
            $keys=array_keys($fields);
            $values = "";
            $x=0;
            foreach ($fields as $field=>$value) {
                ++$x;
                if ($x==count($fields)) {
                    $values.="?";

                } else{
                    $values.="? ";
                }                

            }
            $sql="INSERT INTO {$table} (".implode(',',$keys).") values (".implode(', ',explode(' ',$values)).")";
            
            if (!$this->query($sql,array_values($fields))->error()) {
                return true; /////////////////
            } 
        }
        return false;/////////////////
    }

           //update data    
    /**
     * update
     *
     * @param  string $table
     * @param  array $where
     * @param  string $fields
     * @return mixed
     */
    public function update($table,$where=[],$fields=[])
    { 
                    $set="";
                    $x=0;
                    $array_values=[];

                    foreach ($fields as $field=>$value) {

                    ++$x;
                        if ($x==count($fields)) {
                            $set.=$field."=?";;

                        } else {  $set.=$field."=?,";
                        }
                    }
                    if (count($where)>=1) {
                        $operators=array("=","+","<",">","=>","=<","<>");

                        $txt_where='';
                   
                        $i=0;
                        foreach ($where as $key => $element) {
                            # code...
                            $field=$element[0];
                            $operator=$element[1];
                            if (in_array($operator,$operators)) {
            
                                $array_values[]=$element[2];
            
                                ($i==0) ? ($txt_where=$txt_where."{$field} {$operator} ?") : ($txt_where=$txt_where."and {$field} {$operator} ?") ;
                                $i=1;
            
                            } elseif ($operator=='IN') {
                                $id_list="(";
                                $length=count($element[2]);
                                for ($j=0; $j < $length ; $j++) { 
                                    $array_values[]=$element[2][$j];
            
                                    if ($j==0) {
                                        $id_list=$id_list."?";
                                    } else {
                                        $id_list=$id_list.","."?";
            
                                    }
                                }
                                $id_list=$id_list.")";
            
                              
                                ($i==0) ? ($txt_where=$txt_where."{$field} {$operator} {$id_list}") : ($txt_where=$txt_where."and {$field} {$operator} {$id_list}") ;
                                $i=1;
                            }
                            
            
                        }
                       
                    }
                    $sql="UPDATE {$table} SET ".$set." WHERE $txt_where";
                
                    $values=array_merge(array_values($fields),$array_values);

                    if (!$this->query($sql,$values)->error()) {
                        return true; ///////////////
                    } 
                
                return false; ///////////////
    }
    


    
    /**
     * results /the resutlts as an assoc array   
     *
     * @return array
     */
    public function results()
    {
        //by default data get as array/stdclasses

        // to trunit to arrays of arrays
        // return json_decode(json_encode($this->_results), true);
        return $this->_results;
        // gives array data with column name and itsvalue not index array
    }

        
    /**
     * first //return only the first result
     *
     * @return array
     */
    public function first()
    {
        // return $this->_results[0];
        return $this->results()[0];
    }
    
    /**
     * error
     *
     * @return bool
     */
    public function error()
    {
        return $this->_error;
    }

     
    /**
     * count  // the result count  
     *
     * @return int
     */
    public function count()
    {
        return $this->_count;
    }




}





?>