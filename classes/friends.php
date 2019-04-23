<?php
/*
 * Question class
 */


class Friends extends Dbclass
{
    
    protected static $db_table = "friends";
    protected static $db_table_fields = ['user_one_id', 'user_two_id', 'status_user_one', 'status_user_two'];
    public $errors = array();
    public $id;
    public $user_one_id;
    public $user_two_id;
    public $status_user_one;
    public $status_user_two;
    
    /*
     * $status variable is for actual request status
     * 0 - pending
     * 1 - accepted
     * 2 - declined 
     * 3 -  blocked
     */

    
    public function friend_request($user_one_id, $user_two_id)
    {
        $this->user_one_id = $user_one_id;
        $this->user_two_id = $user_two_id;
        $this->status = 0;
        $this->action_user = $user_one_id;
        
        $this->create(); 
    }
    
    public function update_status($status_user_one, $status)
    {
        global $database;
        
        $sql = "UPDATE " . static::$db_table . " SET {$status_user_one} = {$status} WHERE user_one_id = {$this->user_one_id} AND user_two_id = {$this->user_two_id}";
        
        $database->query($sql); 
    }
    
    public static function find_all_user_friends($user_id)
    {
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$user_id} OR user_two_id = {$user_id}) AND (status_user_one = 1 OR 4) OR (status_user_two = 1 OR 4) ORDER BY status_user_one = 4 OR status_user_two = 4 DESC";
        
        return static::find_this_query($sql);
    }
    
    
    
}