<?php
/*
 * Question class
 */


class Question extends Dbclass
{
    
    protected static $db_table = "question";
    protected static $db_table_fields = ['question', 'answer', 'add_by', 'add_to', 'state'];
    public $errors = array();
    public $id;
    public $question;
    public $useremail;
    public $answer;
    public $add_by;
    public $add_to;
    public $state;
    
    
    
    
}