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
        $this->status_user_one = 1;
        $this->status_user_two = 0;
        
        $this->create(); 
    }
    
    public function update_status($status_user_one, $status)
    {
        global $database;
        
        $sql = "UPDATE " . static::$db_table . " SET {$status_user_one} = {$status} WHERE user_one_id = {$this->user_one_id} AND user_two_id = {$this->user_two_id}";
        
        $database->query($sql); 
    }
    
    public static function find_all_user_friends_pagination($user_id, $items_per_page, $offset)
    {     
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$user_id} AND (status_user_two = 2 OR status_user_two = 3)) OR (user_two_id = {$user_id} AND (status_user_one = 2 OR status_user_one = 3)) ORDER BY status_user_one = 3 OR status_user_two = 3 DESC LIMIT {$items_per_page} OFFSET {$offset}";
        
        return static::find_this_query($sql);
    }
    
    public static function find_all_user_friends($user_id)
    {     
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$user_id} AND (status_user_two = 2 OR status_user_two = 3)) OR (user_two_id = {$user_id} AND (status_user_one = 2 OR status_user_one = 3))";
        
        return static::find_this_query($sql);
    }
    
    public static function count_all_user_friends($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$user_id} AND (status_user_two = 2 OR status_user_two = 3)) OR (user_two_id = {$user_id} AND (status_user_one = 2 OR status_user_one = 3))";
        $result = $database->query($sql);
        return mysqli_num_rows($result);
    }
    
    public static function friends_request_pagination($user_id, $items_per_page, $offset)
    {     
        $sql = "SELECT * FROM " . static::$db_table . " WHERE user_two_id = {$user_id} AND status_user_one = 1 LIMIT {$items_per_page} OFFSET {$offset}";
        
        return static::find_this_query($sql);
    }
    
    public static function count_friends_request($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE user_two_id = {$user_id} AND status_user_one = 1";
        $result = $database->query($sql);
        return mysqli_num_rows($result);
    }
    
    public static function check_friends_realtion($first_id, $second_id, $user_id)
    {
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$first_id} AND user_two_id = {$second_id}) OR (user_one_id = {$second_id} AND user_two_id = {$first_id})";
        
        $result_obj_array = static::find_this_query($sql);
        $result_obj = array_shift($result_obj_array);
        
        if(empty($result_obj))
        {
            return false;
        }
        else
        {    
        if($result_obj->user_one_id == $user_id)
        {
            return $result_obj->status_user_two == 3 ? true : false;
        }
        elseif($result_obj->user_two_id == $user_id)
        {
            return $result_obj->status_user_one == 3 ? true : false;
        }
        }
    }
    
    public static function check_relation_id($first_id, $second_id)
    {
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (user_one_id = {$first_id} AND user_two_id = {$second_id}) OR (user_one_id = {$second_id} AND user_two_id = {$first_id})";
        
        $result_obj_array = static::find_this_query($sql);
        $result_obj = array_shift($result_obj_array);
        
        return $result_obj->id;
    }
    
    
}