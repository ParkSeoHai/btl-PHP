const registerForm = document.querySelector('.form-register');
const btnRegister = document.querySelector('.btn-register');

btnRegister.addEventListener('click', (e) => {
    e.preventDefault();

    let isSubmit = true;

    // Xóa các message cũ nếu có
    const messages = registerForm.querySelectorAll('.message');
    messages.forEach(message => {
        message.remove();
    });

    // Hàm add message error input
    const addError = (input, message) => {
        input.classList.add('error');
        const messageTag = `<span class="message">${message}</span>`;
        input.parentElement.insertAdjacentHTML('afterend', messageTag);
        isSubmit = false;
    }

    // Validate các input
    const inputs = registerForm.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        // Xử lý khi input có thay đổi
        input.addEventListener('input', () => {
            input.classList.remove('error');
            const message = input.parentElement.parentElement.querySelector('.message');
            if(message) {
                message.remove();
            }
        });
        // Xử lý khi input bị bỏ trống
        if(input.value === '') {
            addError(input, 'Vui lòng nhập thông tin');
        } else {
            input.classList.remove('error');
        }
        // Xử lý input phone number
        if(input.id === 'phone-number' && input.value !== '') {
            const value = input.value;
            const regex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
            if(!regex.test(value)) {
                addError(input, 'Số điện thoại không hợp lệ');
            }
        }
        // Xử lý input type email
        if(input.type === 'email' && input.value !== '') {
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(!regex.test(input.value)) {
                addError(input, 'Email không hợp lệ');
            }
        }
        // Xử lý input type password
        if(input.type === 'password' && input.value !== '') {
            const password = input.value;
            const passwordConfirm = registerForm.querySelector('#password-confirm');

            // Xử lý input password
            if(password.length < 6 && input.id === 'password') {
                addError(input, 'Mật khẩu phải có ít nhất 6 ký tự');
            }

            // Xử lý input password confirm
            if(password !== passwordConfirm.value && passwordConfirm.value !== '') {
                addError(passwordConfirm, 'Mật khẩu không khớp');
            }
        }
    });

    // Submit form
    if(isSubmit) {
        // Xử lý input checkbox
        const isAgree = registerForm.querySelector('#agree');
        if(!isAgree.checked) {
            alert('Vui lòng đồng ý với điều khoản sử dụng');
        } else {
            registerForm.submit();
        }
    }
});