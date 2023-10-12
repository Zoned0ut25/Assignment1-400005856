<?php

class AuthenticationModel extends Model implements Reader {
    public function find(string $tablename, array $ids): array
    {

        $query_str = 'SELECT username, email, role, password FROM '.$tablename.' WHERE email="'.$ids["email"].'"';

        if($result = $this->sqli->query($query_str)){
            if($result->num_rows <> 1)
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
}