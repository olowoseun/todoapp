<?php
  class UserTodo {
    public $fullname;
    public $count_todos;

    public function __construct($fullname, $count_todos) {
      $this->fullname = $fullname;
      $this->count_todos = $count_todos;
    }
  }
?>