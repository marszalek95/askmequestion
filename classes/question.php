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
    
    public static function find_questions_by_status($user_id, $status)
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE (add_by={$user_id} OR add_to={$user_id}) AND {$status}");
    }
    
    public function update_status($status)
    {
        global $database;
        
        $sql = "UPDATE " . static::$db_table . " SET status={$status} WHERE id={$this->id}";
        
        $database->query($sql); 
    }
    
    
}