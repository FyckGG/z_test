
const fname = document.getElementById('create_customer_fname');
const fnameError = document.getElementById('create_customer_fname_error');

const lname = document.getElementById('create_customer_lname');
const lnameError = document.getElementById('create_customer_lname_error');

const email = document.getElementById('create_customer_e_mail');
const emailError = document.getElementById('create_customer_email_error');

const companyName = document.getElementById('create_customer_company_name');
const companyNameError = document.getElementById('create_customer_company_name_error');

const position = document.getElementById('create_customer_position');
const positionError = document.getElementById('create_customer_position_error');

const fistThreeNumbers = document.getElementById('create_customer_fist_three_numbers');
const secondThreeNumbers = document.getElementById('create_customer_second_three_numbers');
const lastFourNumbers = document.getElementById('create_customer_last_four_numbers');
const phoneNumberError = document.getElementById('create_customer_phone_number_error');

const form = document.getElementById('createCustomerForm');

form.addEventListener('submit', function(e) {
    let isFormCorrect = true;

    fnameError.innerText = '';
    lnameError.innerText = '';
    emailError.innerText = '';
    companyNameError.innerText = '';
    positionError.innerText = '';
    phoneNumberError.innerText = '';

    if (fname.value === '' || fname.value === null)
    {
        isFormCorrect = false;
        fnameError.innerText = 'First name is required';;
    }

    if (lname.value === '' || lname.value === null)
    {
        isFormCorrect = false;
        lnameError.innerText = 'Last name is required';;
    }

    if (email.value === '' || email.value === null)
    {
        isFormCorrect = false;
        emailError.innerText = 'Email is required';;
    }

    if (!String(email.value)
        .toLowerCase()
        .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    ))
    {
        isFormCorrect = false;
        emailError.innerText = 'Enter the correct email';;
    }

    let phoneNumber = fistThreeNumbers.value + secondThreeNumbers.value + lastFourNumbers.value;

    if (phoneNumber !=0 && !phoneNumber.match(/^\D*(\d\D*){10}$/))
    {
        isFormCorrect = false;
         phoneNumberError.innerText = 'Enter the correct phone number';
    }

    if (!isFormCorrect) e.preventDefault();
})