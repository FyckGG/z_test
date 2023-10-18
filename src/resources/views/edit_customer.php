<style>
    <?php include __DIR__ . '/../css/view_styles/customer_form_page.css'?>
</style>
<div class="customer_form_page">
    <h1>Edit a customer</h1>
    <div class="customer_form">
    <form id="editCustomerForm" action=<?php echo "/customers/{$customer['id']}"?> method="post">
    <input name='_method' type='hidden' value='put'/>
    <span style="color:red">*</span>
    <label for="edit_customer_fname">First name:</label>
    <input type="text" id="edit_customer_fname" name="edit_customer_fname" maxlength="30" value=<?php echo $customer['first_name'];?>><br>
    <p id="edit_customer_fname_error" class="form_error"></p>
    <span style="color:red">*</span>
    <label for="edit_customer_lname">Last name:</label>
    <input type="text" id="edit_customer_lname" name="edit_customer_lname" maxlength="30" value=<?php echo $customer['last_name'];?>><br>
    <p id="edit_customer_lname_error" class="form_error"></p>
    <span style="color:red">*</span>
    <label for="edit_customer_e_mail">Email:</label>
    <input type="text" id="edit_customer_e_mail" name="edit_customer_e_mail" maxlength="100" value=<?php echo $customer['email'];?>><br>
    <p id="edit_customer_email_error" class="form_error"></p>
    <label for="edit_customer_company_name">Company name:</label>
    <input type="text" id="edit_customer_company_name" name="edit_customer_company_name" maxlength="100" value=<?php if (isset($customer['company_name']))
     echo $customer['company_name']; else echo ''?>><br>
    <p id="edit_customer_company_name_error" class="form_error"></p>
    <label for="edit_customer_position">Position:</label>
    <input type="text" id="edit_customer_position" name="edit_customer_position" maxlength="100" value=<?php if (isset($customer['position']))
    echo $customer['position']; else echo ''?>><br>
    <p id="edit_customer_position_error" class="form_error"></p>
    <label for="edit_customer_fist_three_numbers">Phone number:</label>
    <input type="tel" id="edit_customer_fist_three_numbers" name="edit_customer_fist_three_numbers" 
    maxlength="3" size="3" value=<?php if (isset($customer['phone_number']))
    echo substr($customer['phone_number'], 0, 3); else echo ''?>>
    <span>-</span>
    <input type="tel" id="edit_customer_second_three_numbers" name="edit_customer_second_three_numbers" 
    maxlength="3" size="3" value=<?php if (isset($customer['phone_number']))
    echo substr($customer['phone_number'], 3, 3); else echo ''?>>
    <span>-</span>
    <input type="tel" id="edit_customer_last_four_numbers" name="edit_customer_last_four_numbers" 
    maxlength="4" size="4" value=<?php if (isset ($customer['phone_number']))
    echo substr($customer['phone_number'], 6, 4); else echo ''?>><br>
    <p id="edit_customer_phone_number_error" class="form_error"></p>
    <input type="submit" value="Edit customer">
    </form>
    </div>
</div>

<script type="module">
    <?php require_once(__DIR__ . "/../js/validation/validateEditCustomerForm.js");?>
</script>

