<?php

class DashboardModel extends Model implements Reader, Writer, Updater, Deleter {
    public function findall(string $tablename): array
    {

        $query_str = 'SELECT * FROM '.$tablename.'"';

        if($result = $this->sqli->query($query_str)){
            if($result->num_rows < 1)
            {
               return array();  
            }
            else
            { 
                return $result->fetch_assoc();
            }
        } else {
            return array();
        }
    }

    //delete study from dashboard
    public function del(array $tablenames, array $ids) 
    {
        
    }
}