<style>
    <?php include __DIR__ . '/../css/view_styles/customer_form_page.css'?>
</style>

<div class="customer_form_page">
    <h1>Adding a new customer</h1>
    <div class="customer_form">
    <form id="createCustomerForm" action="/customers" method="post">
    <span style="color:red">*</span>
    <label for="create_customer_fname">First name:</label>
    <input type="text" id="create_customer_fname" name="create_customer_fname" maxlength="30"><br>
    <p id="create_customer_fname_error" class="form_error"></p>
    <span style="color:red">*</span>
    <label for="create_customer_lname">Last name:</label>
    <input type="text" id="create_customer_lname" name="create_customer_lname" maxlength="30"><br>
    <p id="create_customer_lname_error" class="form_error"></p>
    <span style="color:red">*</span>
    <label for="create_customer_e_mail">Email:</label>
    <input type="text" id="create_customer_e_mail" name="create_customer_e_mail" maxlength="100"><br>
    <p id="create_customer_email_error" class="form_error"></p>
    <label for="create_customer_company_name">Company name:</label>
    <input type="text" id="create_customer_company_name" name="create_customer_company_name" maxlength="100"><br>
    <p id="create_customer_company_name_error" class="form_error"></p>
    <label for="create_customer_position">Position:</label>
    <input type="text" id="create_customer_position" name="create_customer_position" maxlength="100"><br>
    <p id="create_customer_position_error" class="form_error"></p>
    <label for="create_customer_fist_three_numbers">Phone number:</label>
    <input type="tel" id="create_customer_fist_three_numbers" name="create_customer_fist_three_numbers" maxlength="3" size="3">
    <span>-</span>
    <input type="tel" id="create_customer_second_three_numbers" name="create_customer_second_three_numbers" maxlength="3" size="3">
    <span>-</span>
    <input type="tel" id="create_customer_last_four_numbers" name="create_customer_last_four_numbers" maxlength="4" size="4"><br>
    <p id="create_customer_phone_number_error" class="form_error"></p>
    <input type="submit" value="Add customer">
    </form>
    </div>
</div>

<script type="module">
    <?php require_once(__DIR__ . "/../js/validation/validateCreateCustomerForm.js");?>
</script>

