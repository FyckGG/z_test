<?php

namespace Core;

class QueryBuilder  // конструктор sql запросов
{
    private \stdClass $query;

    public function __construct()
    {
        $this->query = new \stdClass();
    }

    public function delete(string $table) :QueryBuilder
    {
        $this->query->delete = "DELETE FROM $table";
        return $this;
    }

    public function insert(string $table, array|null $columns = null) :QueryBuilder
    {
        $this->query->insert = "INSERT INTO $table";

        if (is_array($columns) && count($columns) > 0)
        {
            $colunmsString = implode(", ", $columns);

            $this->query->insert .= " ($colunmsString)";
        }

        return $this;
    }

    public function limit(int $count) :QueryBuilder
    {
        $this->query->limit = " LIMIT $count";
        return $this;
    }

    public function offset(int $number) :QueryBuilder
    {
        $this->query->offset = " OFFSET $number";
        return $this;
    }

    public function orderBy(string $orderColumn, string $orderType)
    {
        $this->query->orderBy = " ORDER BY $orderColumn $orderType";
        return $this;
    }

    public function select(string $table, array $columns) :QueryBuilder
    {
        $this->query->select = "SELECT " . implode(", ", $columns) . " FROM " . $table;
        return $this;
    }

    public function selectCount(string $table, array $columns, string $countName) :QueryBuilder
    {
        $colunmsString = implode(", ", $columns);
        $this->query->selectCount = "SELECT COUNT($colunmsString) as $countName FROM $table";
        return $this;
    }

    public function set(array $values) :QueryBuilder
    {
        $this->query->set = " SET";
        
        foreach ($values as $key => $value)
        {
            $this->query->set .= " $key = '$value',";
        }

        $this->query->set = substr_replace($this->query->set, '', -1);

        return $this;
    }

    public function update(string $table) :QueryBuilder
    {
        $this->query->update = "UPDATE $table";
        return $this;
    }

    public function values(array $values) :QueryBuilder
    {
        $modifyValues = array_map(function($val) { return "'$val'"; }, $values);

        $valuesString = implode(", ", $modifyValues);
        $this->query->values = " VALUES ($valuesString)";

        return $this;
    }

    public function where(string $column, string $operator, $value) :QueryBuilder
    {
        if (!isset($this->query->where)) {
            $this->query->where = " WHERE ";
        } else {
            $this->query->where .= " AND ";
        }

        $this->query->where .= $column . " " . $operator . " '" . $value . "'";
        return $this;
    }

    public function get() :string
    {
        $query = "";

        if (isset($this->query->insert))
        {
            $query .= $this->query->insert;
        }

        if (isset($this->query->values))
        {
            $query .= $this->query->values;
        }

        if (isset($this->query->select))
        {
            $query .= $this->query->select;
        }

        if (isset($this->query->selectCount))
        {
            $query .= $this->query->selectCount;
        }

        if (isset($this->query->update))
        {
            $query .= $this->query->update;
        }

        if (isset($this->query->set))
        {
            $query .= $this->query->set;
        }

        if (isset($this->query->delete))
        {
            $query .= $this->query->delete;
        }

        if (isset($this->query->where))
        {
            $query .= $this->query->where;
        }

        if (isset($this->query->orderBy))
        {
            $query .= $this->query->orderBy;
        }

        if (isset($this->query->limit))
        {
            $query .= $this->query->limit;
        }

        if (isset($this->query->offset))
        {
            $query .= $this->query->offset;
        }

        $this->query = new \stdClass();

        return $query;

    }
    
}