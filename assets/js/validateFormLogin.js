
const email = document.getElementById('email');
const password = document.getElementById('password');
const btnLogin = document.querySelector('.btn-login-action');

btnLogin.addEventListener('click', function (e) {
    e.preventDefault();

    // Validate email
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(email.value.trim() === '') {
        email.focus();
        email.classList.add('required');

        email.closest('.user-name').querySelector('.message').innerHTML = 'Vui lòng nhập email';
    } else if(!regex.test(email.value)) {
        email.closest('.user-name').querySelector('.message').innerHTML = 'Email không hợp lệ';
    } else {
        email.classList.remove('required');
        email.closest('.user-name').querySelector('.message').innerHTML = '';
    }
    // Validate password
    if(password.value.trim() === '') {
        password.classList.add('required');

        password.closest('.password').querySelector('.message').innerHTML = 'Vui lòng nhập mật khẩu';
    } else {
        password.classList.remove('required');
        password.closest('.password').querySelector('.message').innerHTML = '';
    }
    // Submit form
    if(password.value.trim() !== '' && email.value.trim() !== ''){
        const form = document.getElementById('form-login');
        form.submit();
    }
})