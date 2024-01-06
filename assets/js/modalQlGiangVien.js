
const btnShows = document.querySelectorAll('.block-course .btn-show-schedule');
if(btnShows) {
    btnShows.forEach(btn => {
        const contenBottom = btn.closest('.item-content').querySelector('.item-content-bottom');
        contenBottom.classList.add('w-100');
        contenBottom.style.maxHeight = '80px';
        contenBottom.style.overflowY = 'scroll';

        btn.addEventListener('click', () => {
            if(btn.closest('.item-content')) {
                // Ẩn hết modal đang hiện
                btnShows.forEach(element => {
                    element.closest('.item-content').querySelector('.modal-schedule').classList.add('d-none');
                    element.closest('.item-content').querySelector('.item-content-bottom').style.maxHeight = '80px';
                    element.closest('.item-content').querySelector('.item-content-bottom').style.overflowY = 'scroll';
                });

                const modal = btn.closest('.item-content').querySelector('.modal-schedule');
                modal.classList.remove('d-none');
                contenBottom.style.maxHeight = 'none';
                contenBottom.style.overflowY = 'hidden';
            }
        });
    });
}

// Tắt modal
const btnCloses = document.querySelectorAll('.modal-schedule .btn-close');
if(btnCloses) {
    btnCloses.forEach(btnClose => {
        btnClose.addEventListener('click', () => {
            const modal = btnClose.closest('.modal-schedule');
            if(modal) {
                btnShows.forEach(btn => {
                    const contenBottom = btn.closest('.item-content').querySelector('.item-content-bottom');
                    contenBottom.classList.add('w-100');
                    contenBottom.style.maxHeight = '80px';
                    contenBottom.style.overflowY = 'scroll';
                });
                modal.classList.add('d-none');
            }
        })
    });
}