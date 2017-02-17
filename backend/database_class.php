<?php

class Database {
    
    var $host;
    var $user;
    var $pwd;
    var $db;
    
    public function __construct() {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pwd = 'kingston';
        $this->db = 'citations';
        $this->connection = mysqli_connect($this->host, $this->user, $this->pwd, $this->db) or die ("Problème de connexion à la base de données:" . mysqli_connect_error());
        return $this->connection;
    }
    
    public function find($table, $fields, $id = NULL) {
        if (isset($id)) {
            $sql = "SELECT " .$fields. " from " .$table. " WHERE id=" .$id;
        }
        else {
            $sql = "SELECT " .$fields. " from " .$table;
        }
        $this->result = mysqli_query($this->connection, $sql);
        return $this->result;
    }
    
    public function edit($table, $values, $id = NULL) {
        if (isset($id)) {
            $sql = "UPDATE " . $table . " SET " .$values. " WHERE id=" .$id;
        }
        else {
            $sql = "UPDATE " . $table . " SET " .$values;
        }
        if ($this->result = mysqli_query($this->connection, $sql)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    
    public function add($table, $fields, $values) {
        $sql = "INSERT INTO " .$table. "(" .$fields. ") VALUES(" .$values. ")";
        if ($this->result = mysqli_query($this->connection, $sql)) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function delete($table, $id) {
        $sql = "DELETE from " .$table. " WHERE id=" .$id;
        if ($this->result = mysqli_query($this->connection, $sql)) {
            return 1;
        }
        else {
            return 0;
        }

    }
    
    public function getLast($table) {
        $sql = "SELECT * FROM " .$table. " ORDER BY id DESC LIMIT 1";
        if ($this->result = mysqli_query($this->connection, $sql)) {
            return $this->result;
        }
        else {
            return 0;
        }
    }
    
    public function getCategory($id) {
        $sql = "SELECT author_category.author_id, author_category.category_id FROM author_category LEFT JOIN category ON (category.id = author_category.category_id) WHERE (author_category.author_id = $id)";
        if ($result = mysqli_query($this->connection, $sql)) {
            while ($this->category_id = mysqli_fetch_array($result)) {
                $cat_id = $this->category_id['category_id'];
                $sql2 = "SELECT name FROM category WHERE id=$cat_id";
                if ($result2 = mysqli_query($this->connection, $sql2)) {
                    $this->category = mysqli_fetch_array($result2);
                        $category = implode(',', $this->category);
                        $category = str_replace(',',', ', $category);
                        return $category;
                }
            }
        } 
        else {
            return 0;
        }
    }
    
    public function getAllAuthors() {
        $sql = "SELECT first_name, last_name FROM author";
        if ($result = mysqli_query($this->connection, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                return '<option id="select-'.$row["id"].'" value="'.$row["last_name"].'">'.$row["first_name"]. " ".$row["last_name"].'</option>';
            }
            
        }
    }
    
}
  
  
?>