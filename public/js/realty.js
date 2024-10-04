'use strict'

document.addEventListener('DOMContentLoaded', () => {
    const capitalize = (string) => string.charAt(0).toUpperCase() + string.slice(1);

    const viewingDates = Array(7).fill({}).map((_, index) => {
        let date = new Date;
        date.setDate(date.getDate() + index);

        let dayName = index === 0 ? 'Сегодня': index === 1 ? 'Завтра' : capitalize(new Intl.DateTimeFormat('ru-RU', {
            weekday: "short"
        }).format(date)) + '.';

        let dateAndMonth = new Intl.DateTimeFormat('ru-RU',{
            month: "short",
            day: "numeric"
        }).format(date);

        return {
            date,
            dayName,
            dateAndMonth
        }
    });

    let viewingTimes = Array(14).fill("").map((_, index) => index + 8);
    viewingTimes = viewingTimes.filter(hour => hour > new Date().getHours() + 1);
    viewingTimes = viewingTimes.map(hour => `${hour}:00 - ${hour + 1}:00`);

    let detailsViewingDate = document.querySelector('.details-left__viewing-date');
    for (let i = 0; i < viewingDates.length; i++) {
        let viewingDateItem = document.createElement('div');
        viewingDateItem.className = "details-left__viewing-date__item p-2 rounded-1 text-center";
        viewingDateItem.setAttribute('data-date', viewingDates[i].date.toLocaleDateString().split('.').reverse().join('-'))
        if (i === 0) viewingDateItem.classList.add('active');

        let viewingDateWeek = document.createElement('p');
        viewingDateWeek.className = "inline-block mb-0";
        viewingDateWeek.textContent = viewingDates[i].dayName;


        let viewingDate = document.createElement('p');
        viewingDate.className = "inline-block mb-0";
        viewingDate.textContent = viewingDates[i].dateAndMonth;

        viewingDateItem.append(viewingDateWeek, viewingDate);
        detailsViewingDate.append(viewingDateItem);
    }

    let detailsViewingTime = document.querySelector('.details-left__viewing-time');
    for (let i = 0; i < viewingTimes.length; i++) {
        let option = document.createElement('option');
        option.value = viewingTimes[i];
        option.textContent = viewingTimes[i];

        detailsViewingTime.append(option);
    }

    let detailDateItems = document.querySelectorAll('.details-left__viewing-date__item');
    detailDateItems?.forEach((item, index, arr) => {
        item.addEventListener('click', () => {
            arr.forEach((x) => x.classList.remove('active'));
            item.classList.add('active');
        });
    });

    let btnViewing = document.querySelector('.btn-viewing');
    btnViewing.addEventListener('click', async (event) => {
        const button = event.target;
        const span = button.querySelector('span');

        const estate_id = window.location.pathname.split('/')[2];
        const date = document.querySelector('.details-left__viewing-date__item.active')?.getAttribute('data-date') ?? '';
        const time = document.querySelector('.details-left__viewing-time');
        const phone = document.getElementById('phoneViewingInput');

        let formData = new FormData();
        formData.append('date', date);
        formData.append('time', time.value);
        formData.append('phone', phone.value);
        formData.append('estate_id', estate_id);

        removeErrorFields([phone]);

        try {
            button.disabled = true;
            span.classList.remove('d-none');

            const response = await fetch('/estate-viewing', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json",
                }
            });

            const data = await response.json();
            if (!response.ok) {
                showErrorFields(data.errors);
                return;
            }

            time.value = "Как можно быстрее";
            phone.value = "";
            detailDateItems.forEach(x => x.classList.remove('active'));
            detailDateItems[0].classList.add('active');

            swal({
                text: data.message,
                icon: 'success'
            });
        } catch (e) {
            console.error(e.message)
        } finally {
            button.disabled = false;
            span.classList.add('d-none');
        }
    });

    document.querySelector('#mapModal')?.addEventListener('shown.bs.modal', (event) => {
        const map = new mapgl.Map('map', {
            center: [86.105262, 55.344986],
            zoom: 17,
            key: 'b0394cab-b1f6-45a8-b6e7-2e205fb132fd',
        });

        const marker = new mapgl.Marker(map, {
            coordinates: [86.105262, 55.344986]
        });
    });
});