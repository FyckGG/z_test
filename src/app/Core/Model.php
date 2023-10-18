<?php

namespace Core;
use mysqli;

abstract class Model // работа с данными таблиц бд
{
    protected string $tableName;
    protected string $primaryKeyName;
    private mysqli $connection;
    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->connection = DataBaseConnection::getConnection();
        $this->queryBuilder = new QueryBuilder();
    }

    public function add(array $values) :bool
    {
        $columns = array_keys($values);

        $query = $this->queryBuilder->insert($this->tableName, $columns)->values($values)->get();

        return mysqli_query($this->connection, $query);
    }

    public function delete(int $id) :bool
    {
        $query = $this->queryBuilder->delete($this->tableName)->where($this->primaryKeyName, '=', $id)->get();

        return mysqli_query($this->connection, $query);
    }

    public function find(int $id) :array|bool
    {
        $query = $this->queryBuilder->select($this->tableName, ['*'])->where($this->primaryKeyName, '=', $id)->get();

        $queryResult = mysqli_query($this->connection, $query);

        $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

        return $result[0];
    }

    public function getAll() :array|bool
    {
        $query = $this->queryBuilder->select($this->tableName, ['*'])->get();

        $queryResult = mysqli_query($this->connection, $query);

        $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

        return $result;
    }

    public function paginate(int $perPage, int $page = 1, string $orderType = 'ASC') :array|bool
    {
        $offset = ($page - 1) * $perPage;

        $resultCountQuery = $this->queryBuilder->selectCount($this->tableName, ['*'], "{$this->tableName}_count")->get();
        $resultCount = mysqli_query($this->connection, $resultCountQuery);

        $totalRecords = mysqli_fetch_array($resultCount);
        $totalRecords = $totalRecords["{$this->tableName}_count"];

        $pageCount = ceil($totalRecords/$perPage);

        if ($orderType === 'DESC')
        $paginateQuery = $this->queryBuilder->select($this->tableName, ['*'])->orderBy($this->primaryKeyName, 'DESC')
        ->limit($perPage)->offset($offset)->get();
        else
        $paginateQuery = $this->queryBuilder->select($this->tableName, ['*'])->limit($perPage)->offset($offset)->get();

        $queryResult = mysqli_query($this->connection, $paginateQuery);
    
        $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

        return ["$this->tableName" => $result, "currentPage"=>$page, "pageCount" => $pageCount];
    }

    public function update(int $id, array $values) :bool
    {
        $query = $this->queryBuilder->update($this->tableName)->set($values)->where($this->primaryKeyName, '=', $id)->get();

        return mysqli_query($this->connection, $query);
    }
}