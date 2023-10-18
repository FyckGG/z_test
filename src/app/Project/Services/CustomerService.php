<?php

namespace Project\Services; 

use Core\DataBaseConnection;
use Project\Models\Customer;

class CustomerService
{
    private Customer $model;
    
    public function __construct()
    {
        $this->model = new Customer();
    }

    public function addCustomer(array $values) :bool
    {
       $result = $this->model->add($values);
       return $result;
    }

    public function getCustomer(int $id) :array|bool
    {
        $customer = $this->model->find($id);
        return $customer;
    }
    
    public function paginateCustomers(int $perPage, int $page = 1, string $orderType = 'ASC') :array|bool
    {
        $customersList = $this->model->paginate($perPage, $page, $orderType);
        return $customersList;

    }

    public function deleteCustomer(int $customerId) :bool
    {
        $result = $this->model->delete($customerId);
        return $result;

    }

    public function updateCustomer(int $customerId, array $values) :bool
    {
        $result = $this->model->update($customerId, $values);
        return $result;
    }
}