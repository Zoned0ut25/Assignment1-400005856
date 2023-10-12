<?php 

//create a class that implements the read, write, update and delete interfaces

//see reader, writer no longer red
class Model implements Reader, Writer, Updater, Deleter {
    protected $sqli;

    // construct function that connects to the database
    public function __construct(string $user, string $pass, string $db, string $host)
    {
        // create connection using sqli
        $this->sqli = mysqli_connect($host, $user, $pass, $db);

        //check if database connection is successful
        if(!$this->sqli){
            die('Cannot connect to database');
        }
    }

    //implement functions for querying the database here

    //Find ->  returns one record from the table
    public function find(string $tablename, array $ids) : array
    {
        
    }

    //Findall -> returns all records in a table
    public function findall(string $tablename) : array
    {
       
    }
    
    //Add -> adds a record to a table
    public function add(string $tables, array $fields)
    {

    }

    //Update -> updates database
    public function update(array $tables, array $fields)
    {

    }

    //Delete -> removes a record from a table with a given id
    public function del(array $tablenames, array $ids) {
        
    }
}