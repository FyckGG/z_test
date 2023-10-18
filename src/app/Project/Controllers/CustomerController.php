<?php

namespace Project\Controllers;
use Constants\AlertTypes;
use Core\Controller;
use Core\Page;
use Core\Validator;
use Project\Services\CustomerService;
use Core\Redirector;
use Core\Helper;

class CustomerController extends Controller
{
    private CustomerService $service;
    private Validator $validator;

    public function __construct()
    {
        $this->service = new CustomerService();
        $this->validator = new Validator();
    }

    public function index() :Page //вывод клиентов с пагинацией
    {
        $per_page = 10;

        if (isset($_GET['page']) && is_numeric($_GET['page'])) 
        $customerList = $this->service->paginateCustomers($per_page, (int) $_GET['page'], 'DESC');
        else $customerList = $this->service->paginateCustomers($per_page, 1, 'DESC');
        
        return $this->render('customers_list', ['customerList' => $customerList]);
    }

    public function create() :Page
    {
        return $this->render('create_customer');
    }

    public function store() :void
    {
        $fname = $_REQUEST['create_customer_fname'];
        $lname = $_REQUEST['create_customer_lname'];
        $email = $_REQUEST['create_customer_e_mail'];

        if (!$this->validator->checkUnique($email, 'customers', 'email')) // проверяем, есть ли пользователь с таким email в бд
        {
            Helper::alert('This email is already in use. Please choose a free email.', AlertTypes::DANGER);// если есть - перенаправляем обратно на страницу с формой
            Redirector::redirect('/customers/create');
        }
        
        $companyName = $_REQUEST['create_customer_company_name'];
        $position = $_REQUEST['create_customer_position'];
        $phoneNumber = $_REQUEST['create_customer_fist_three_numbers'] . $_REQUEST['create_customer_second_three_numbers'] 
        . $_REQUEST['create_customer_last_four_numbers'];

        $columns = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'company_name' => $companyName, 
        'position' => $position, 'phone_number' => $phoneNumber];

        $result = $this->service->addCustomer($columns); // добавляем в бд

        if ($result) Helper::alert('The customer has been successfully created.', AlertTypes::SUCCESS); // уведомляем о результате
        else Helper::alert('Error when saving the customer. Please try again.', AlertTypes::DANGER);

        Redirector::redirect('/customers');
    }


    public function edit(string $customer_id) :Page
    {
        if (!$this->validator->checkExistence($customer_id, 'customers', 'id')) return $this->render('resource_not_found_view'); //если пользователя с 
        // запрашиваемым id нет в бд
        $customer = $this->service->getCustomer((int) $customer_id);
        return $this->render('edit_customer', ['customer' => $customer]); // рендер формы с текущими полями пользователя
    }

    public function update(string $customer_id) :void
    {
        $fname = $_REQUEST['edit_customer_fname'];
        $lname = $_REQUEST['edit_customer_lname'];
        $email = $_REQUEST['edit_customer_e_mail'];

        if (!$this->validator->checkExistence($customer_id, 'customers', 'id')) // проверяем, существует ли пользователь с таким id
        {
            Helper::alert('Attempt to update the data of a non-existent customer.', AlertTypes::DANGER);
            Redirector::redirect("/customers");
        }

        if (!$this->validator->checkUniqueForUpdate($email, 'customers', 'email', 'id', $customer_id)) // проверяем уникальность email, исключая email текущего клиента
        {
            Helper::alert('This email is already in use. Please choose a free email.', AlertTypes::DANGER);
            Redirector::redirect("/customers/$customer_id/edit");
        }

        $companyName = $_REQUEST['edit_customer_company_name'];
        $position = $_REQUEST['edit_customer_position'];
        $phoneNumber = $_REQUEST['edit_customer_fist_three_numbers'] . $_REQUEST['edit_customer_second_three_numbers'] 
        . $_REQUEST['edit_customer_last_four_numbers'];

        $values = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'company_name' => $companyName, 
        'position' => $position, 'phone_number' => $phoneNumber];

        $result = $this->service->updateCustomer($customer_id, $values);

        if ($result) Helper::alert('The customer has been successfully updated.', AlertTypes::SUCCESS);
        else Helper::alert('Error when updating the customer. Please try again.', AlertTypes::DANGER);

        Redirector::redirect('/customers');
    }

    public function destroy(string $customer_id) :void
    {
        if (!$this->validator->checkExistence($customer_id, 'customers', 'id'))
        {
            Helper::alert('Attempt to delete the non-existent customer.', AlertTypes::DANGER); // если попытка удалить несуществующего пользователя
            Redirector::redirect("/customers");
        }

        $result = $this->service->deleteCustomer((int) $customer_id);

        if ($result) Helper::alert('The customer has been successfully deleted.', AlertTypes::SUCCESS);
        else Helper::alert('Error when deleting the customer. Please try again.', AlertTypes::DANGER);

        Redirector::redirect('/customers');
    }
}