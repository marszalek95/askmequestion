<?php
/*
 * Question class
 */


class Question extends Dbclass
{
    
    protected static $db_table = "question";
    protected static $db_table_fields = ['question', 'answer', 'my_answer', 'add_by', 'add_to', 'status'];
    public $errors = array();
    public $id;
    public $question;
    public $answer;
    public $my_answer;
    public $add_by;
    public $add_to;
    public $status;
    
    public static function find_new_questions($user_id, $items_per_page, $offset)
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=1) OR (add_to={$user_id} AND status=0) LIMIT {$items_per_page} OFFSET {$offset}");
    }
    
    public static function count_new_questions($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=1) OR (add_to={$user_id} AND status=0)";
        $result = $database->query($sql);
        return mysqli_num_rows($result);
    }
    
    public static function find_sent_questions($user_id, $items_per_page, $offset)
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=0) LIMIT {$items_per_page} OFFSET {$offset}");
    }
    
    public static function count_sent_questions($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=0)";
        $result = $database->query($sql);
        return mysqli_num_rows($result);
    }
    
    public static function find_seen_questions($user_id, $items_per_page, $offset)
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=2) OR (add_to={$user_id} AND status=1) LIMIT {$items_per_page} OFFSET {$offset}");
    }
    
    public static function count_seen_questions($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} AND status=1) OR (add_to={$user_id} AND status=0)";
        $result = $database->query($sql);
        return mysqli_num_rows($result);
    }
    
    public function update_status($status)
    {
        global $database;
        
        $sql = "UPDATE " . static::$db_table . " SET status={$status} WHERE id={$this->id}";   
        $database->query($sql); 
    }
    
    
}