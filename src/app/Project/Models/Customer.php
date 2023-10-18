<?php

namespace Project\Models;

use Core\Model;

class Customer extends Model
{
    public function __construct()
    {
        $this->tableName = 'customers';
        $this->primaryKeyName = 'id';
        parent::__construct();
    }
}