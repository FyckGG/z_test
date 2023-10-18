<style>
    <?php include __DIR__ . '/../css/view_styles/customer_list.css'?>
</style>
<div class="customer_list_page">
<h1>Customer list</h1>
<?php if (!isset($customerList['customers']) || count($customerList['customers']) === 0)
echo "<h2>This list page is empty</h2>";
?>
<ul class='customer_list'>
    <?php 
        if (isset($customerList['customers']) && count($customerList['customers']))
        {
            foreach($customerList['customers'] as $customer)
            {
                echo 
                "<li class='customer_list_item'>
                    <div>
                    <span class='customer_list_legend'>
                    Fist name: 
                    </span>
                    {$customer['first_name']}
                    </div>
                    <div>
                    <span class='customer_list_legend'>
                    Last name: 
                    </span>
                    {$customer['last_name']}
                    </div>
                    <div>
                    <span class='customer_list_legend'>
                    Email: 
                    </span>
                    {$customer['email']}
                    </div>";
                    if (isset($customer['company_name']) && $customer['company_name'] !== '')
                    {
                        echo 
                        "<div>
                        <span class='customer_list_legend'>
                        Company name: 
                        </span>
                        {$customer['company_name']}
                        </div>";
                        
                    }
                    if (isset($customer['position']) && $customer['position'] !== '')
                    {
                        echo 
                        "<div>
                        <span class='customer_list_legend'>
                        Position: 
                        </span>
                        {$customer['position']}
                        </div>";
                        
                    }
                    if (isset($customer['phone_number']) && $customer['phone_number'] !== '')
                    {
                        echo 
                        "<div>
                        <span class='customer_list_legend'>
                        Phone number: 
                        </span>
                        {$customer['phone_number']}
                        </div>";
                        
                    }
                echo 
                "<div class='customer_list_item_button_panel'>
                <form action='/customers/{$customer['id']}/edit' method='get'>
                <button type='submit'>Edit</button>
                </form>
                <form action='/customers/{$customer['id']}' method='post'>
                <input name='_method' type='hidden' value='delete'/>
                <button type='submit'>Delete</button>
                </form>
                <div/>";
                echo "</li>";
            }

        }

        if (isset($customerList['pageCount']) && $customerList['pageCount'] > 1)
        {
            echo "<ul class='page_list'>";
            for ($i = 1; $i <= $customerList['pageCount']; $i++)
            {
                if (isset($customerList['currentPage']) && (int)$customerList['currentPage'] === $i)
                echo 
                "<li class='page_list_selected_item'>
                <a href='/customers?page={$i}'>$i</a>
                </li>";
                else echo 
                "<li class='page_list_item'>
                <a href='/customers?page={$i}'>$i</a>
                </li>";
            }
            echo "</ul>";
        }
    ?>
</ul>

<script>
    function deleteCustomer(customerId)
    {
        console.log(customerId)
        fetch('/customers/' + customerId, {
            method: 'DELETE',
        });
    }
</script>
</div>