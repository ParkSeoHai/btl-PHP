const formUpdates = document.querySelectorAll('.form-update');
if(formUpdates) {
    formUpdates.forEach(formUpdate => {
        const btnSubmitUpdate = formUpdate.querySelector('.btn-submit-update');

        btnSubmitUpdate.addEventListener('click', (e) => {
            e.preventDefault();
            validateFormAddUser(formUpdate);
        });
    });
}

function validateFormAddUser(form) {
    let isSubmit = true;

    // Xóa các message cũ nếu có
    const clearMessage = () => {
        const messages = form.querySelectorAll('.error-message');
        if(messages) {
            messages.forEach(message => {
                message.remove();
            });
        }
    }
    clearMessage();

    // Thêm message error
    const addError = (input, message) => {
        input.style.border = '1px solid red';
        const messageTag = `<span class='error-message fs-5 ps-1 pt-4 fw-bold text-danger'>${message}</span>`;
        input.insertAdjacentHTML('afterend', messageTag);
    }

    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        // Xử lý khi input có thay đổi
        input.addEventListener('input', () => {
            input.style.border = '1px solid #dee2e6';
            clearMessage();
        });

        // Xử lý input không có giá trị
        if(input.value.trim() === '') {
            addError(input, 'Vui lòng nhập thông tin');
            isSubmit = false;
        } else {
            input.style.border = '1px solid green';
        }
        // Xử lý input phone number
        if(input.id === 'phone-number' && input.value !== '') {
            const regex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
            if(!regex.test(input.value)) {
                addError(input, 'Số điện thoại không hợp lệ');
                isSubmit = false;
            }
        }
        // Xử lý input type email
        if(input.type === 'email' && input.value !== '') {
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(!regex.test(input.value)) {
                addError(input, 'Email không hợp lệ');
                isSubmit = false;
            }
        }
    });

    // Xử lý seclect
    const options = form.querySelectorAll('.form-select option');
    if(form.querySelector('.message-select')) form.querySelector('.message-select').remove();
    options.forEach(option => {
        if(option.selected) {
            // Value option phải lớn hơn 0
            if(option.value <= 0) {
                const messageHtml = "<span class='message-select fs-5 ps-1 pt-4 fw-bold text-danger'>Vui lòng chọn giá trị khác</span> ";
                form.querySelector('.form-select').insertAdjacentHTML('afterend', messageHtml);
                isSubmit = false;
            } else {
                if(form.querySelector('.message-select')) form.querySelector('.message-select').remove();
            }
        }
    });

    if(isSubmit) {
        form.submit();
    }
}

