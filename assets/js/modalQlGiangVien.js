
const btnShows = document.querySelectorAll('.block-course .btn-show-schedule');
if(btnShows) {
    btnShows.forEach(btn => {
        btn.closest('.item-content').querySelector('.item-content-bottom').classList.add('w-100');
        btn.addEventListener('click', () => {
            if(btn.closest('.item-content')) {
                // Ẩn hết modal đang hiện
                btnShows.forEach(element => {
                    element.closest('.item-content').querySelector('.modal-schedule').classList.add('d-none');
                });

                const modal = btn.closest('.item-content').querySelector('.modal-schedule');
                modal.classList.remove('d-none');
            }
        });
    });
}

const btnCloses = document.querySelectorAll('.modal-schedule .btn-close');
if(btnCloses) {
    btnCloses.forEach(btnClose => {
        btnClose.addEventListener('click', () => {
            const modal = btnClose.closest('.modal-schedule');
            if(modal) {
                modal.classList.add('d-none');
            }
        })
    });
}