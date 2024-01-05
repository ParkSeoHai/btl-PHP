
const toastElement = document.querySelector('.toast-main');
const btnClose = toastElement.querySelector('.btn-close');

// Click tắt toast
btnClose.addEventListener('click', () => {
    toastElement.querySelector('.toast').classList.remove('d-block');
});

// Sau 3s tắt toast đang hiện
setInterval(() => {
    toastElement.querySelector('.toast').classList.remove('d-block');
}, 5000);