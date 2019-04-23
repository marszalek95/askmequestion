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
    
}