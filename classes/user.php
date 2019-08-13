<?php
/*
 * User class
 */


class User extends Dbclass
{
    
    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'useremail', 'password'];
    public $errors = array();
    public $id;
    public $username;
    public $useremail;
    public $password;
    
    
    public function register($username, $useremail, $password, $passwordverify)
    {    
        if($password != $passwordverify)
        {
            $this->errors[] ='Passwords are not the same';
        }
        
        if(strlen($password) < 6)
        {
            $this->errors[] ='Password is too short';
        }
        
        if(!empty(self::find_by_name("username", $username)))
        {
            $this->errors[] ="Username \"{$username}\" already exsist";
        }
        
        if(!empty(self::find_by_name("useremail", $useremail)))
        {
            $this->errors[] ="E-mail \"{$useremail}\" already exsist";
        }
        
        if(empty($this->errors))
        {
            $this->username = $username;
            $this->useremail = $useremail;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            
            $this->create();
            return true;
        }
    }
    
    public static function find_users_by_name($user_name, $items_per_page, $offset)
    {  
        $sql = "SELECT * FROM " . static::$db_table . " WHERE username LIKE '%{$user_name}%' LIMIT {$items_per_page} OFFSET {$offset}";
        
        return static::find_this_query($sql);   
    }
    
    public static function count_users_by_name($user_name)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE username LIKE '%{$user_name}%'";
        $result = $database->query($sql);
        return mysqli_num_rows($result);     
    }
    
}