<?php

class model_users extends Model {
    public function __construct() {
        
    }
    
    public function GetUsersList() {
        $result = Pagination::SetPagination("SELECT id,login FROM users", 
                                            "SELECT id FROM users", 15);
        return $result;
    }

}
