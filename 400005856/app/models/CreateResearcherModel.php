<?php 

class CreateResearcherModel extends Model implements Reader, Writer {
    public function find(string $tablename, array $ids): array
    {
        $query_str = 'SELECT username FROM '.$tablename.' WHERE username="'.$ids["username"].'"';

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

    public function add(string $tablename, array $fields) {
        $password = password_hash($fields['password'],PASSWORD_DEFAULT);
        
        $query_str = 'INSERT INTO '.$tablename.' SET username="'.$fields['username'].'", password="'.$password.'", email="'.$fields['email'].'", role="'.$fields['role'].'"';

        $this->sqli->query($query_str);
        if($this->sqli->errno){
            trigger_error('SQL query error: '. $this->sqli->error, E_USER_ERROR);
        }
    }
}