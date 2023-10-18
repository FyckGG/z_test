<?php

namespace Core;

use mysqli;

{
    class Validator
    {

        private mysqli $connection;
        private QueryBuilder $queryBuilder;
    
        public function __construct()
        {
            $this->connection = DataBaseConnection::getConnection();
            $this->queryBuilder = new QueryBuilder();
        }

        public function checkEmail(string $value) :bool
        {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
            return false;
        }

        public function checkPhone(string $value) :bool
        {
            if (preg_match('/^[0-9]+$/', $value) && strlen($value) === 10) return true;
            return false;
        }

        public function checkRequired(string $value) :bool
        {
            if (isset($value) && $value !== '') return true;
            return false;
        } 

        public function checkUnique(string $value, string $table, string $column) :bool
        {
            $query = $this->queryBuilder->selectCount($table, ['*'], 'count')->where($column, '=', $value)->get();
            $resultCount = mysqli_query($this->connection, $query);
            $count = mysqli_fetch_array($resultCount)['count'];

            if ((int) $count === 0) return true;
            return false;
        }

        public function checkUniqueForUpdate(string $value, string $table, string $column, string $primaryKeyColumn, string $primaryKeyValue) :bool
        {
            $query = $this->queryBuilder->selectCount($table, ['*'], 'count')->where($column, '=', $value)
            ->where($primaryKeyColumn, '<>', $primaryKeyValue)->get();
            $resultCount = mysqli_query($this->connection, $query);
            $count = mysqli_fetch_array($resultCount)['count'];

            if ((int) $count === 0) return true;
            return false;
        }

        public function checkExistence(string $value, string $table, string $column) :bool
        {
            $query = $this->queryBuilder->selectCount($table, ['*'], 'count')->where($column, '=', $value)->get();
            $resultCount = mysqli_query($this->connection, $query);
            $count = mysqli_fetch_array($resultCount)['count'];

            if ($count > 0) return true;
            return false;
        }
    }
}