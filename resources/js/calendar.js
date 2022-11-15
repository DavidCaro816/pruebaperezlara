class Calendar {
    #year;
    #month;
    #day;

    constructor(year = date.getFullYear (), month = date.getMonth (), day){
        this.#year = year;
        this.#month = month;
        this.#day = day;
    }

    get(element){
        const span = document.getElementById ('title-' + element.parentElement.id);
        element.innerHTML = null;
        element.insertRow ();
        span.innerHTML = months[this.#month] + ' ' + this.#year;
        this.previous (element);
        const row = this.days (new Date (this.#year, this.#month + 1, 0).getDate (), element);
        this.days (42 - element.getElementsByTagName ('td').length, element, row, true);
        document.querySelectorAll ('.select ~ .modal .day').forEach (e => {
            e.addEventListener ('click', close_modal)
        });
    }

    previous(element){
        const weekday = new Date (this.#year, this.#month, 1).getDay ();
        if (weekday !== 0){
            const last_day_month = new Date (this.#year, this.#month, 0).getDate () + 1;
            for (let i = weekday; i > 0; i--) {
                const td = element.rows[0].insertCell ();
                td.classList.add ('day', 'not-belonging');
                td.appendChild (document.createTextNode ((last_day_month - i).toString ()))
            }
        }
    }

    days(tam, element, row = 0, next = false){
        const date = new Date ();
        for (let i = 0; i < tam; i++) {
            if (element.rows[row].childElementCount === 7){
                element.insertRow ();
                row++;
            }
            const td = element.rows[row].insertCell ();
            td.classList.add ('day');
            if (next === true || new Date (this.#year, this.#month, i + 1).getTime () >
                new Date (date.getFullYear (), date.getMonth (), date.getDate ()).getTime ())
            {
                td.classList.add ('not-belonging');
            } else if (date.getFullYear () === this.#year && date.getMonth () === this.#month && date.getDate () === i +
                1)
            {
                td.classList.add ('is-selected', 'today');
            }
            td.addEventListener ('click', (e) => {
                new Calendar (year, month + 1, Number (e.target.innerHTML)).choose_date (e);
            });
            td.appendChild (document.createTextNode ((i + 1).toString ()))
        }
        return row;
    }

    years(span, id){
        const date = new Date (), list_year = document.getElementById ('years-' + id);
        info = 'year';
        span.innerHTML = year + ' - ' + (year + 15);
        document.getElementById ('months-' + id).classList.remove ('is-list-active');
        list_year.classList.add ('is-list-active');
        list_year.innerHTML = null;
        for (let i = 0; i < 16; i++) {
            const li = document.createElement ('li');
            li.classList.add ('item');
            if ((year + i) > date.getFullYear ()){
                li.classList.add ('not-belonging')
            }
            li.appendChild (document.createTextNode ((year + i).toString ()));
            li.addEventListener ('click', this.show)
            list_year.appendChild (li);
        }
    }

    select_date(e){
        const span = document.getElementById (e.target.id),
            id = e.target.closest ('.container-calendar').dataset.calendar;
        if (info === 'day'){
            span.innerHTML = span.innerHTML.replace (new RegExp ('[A-Za-z\\s]+'), '');
            document.getElementById ('months-' + id).classList.add ('is-list-active');
            document.getElementById ('calendar-' + id).classList.add ('is-calendar-inactive');
            info = 'month';
        } else if (info === 'month'){
            Calendar.prototype.years (span, id);
        }
    }

    back(e){
        const id = e.target.closest ('.container-calendar').dataset.calendar,
            span = document.getElementById ('title-calendar-' + id);
        switch (info) {
            case 'day':
                month -= 1;
                if (month < 0){
                    month = 11;
                    year -= 1;
                }
                new Calendar (year, month).get (document.querySelector ('#calendar-' + id + ' tbody'));
                break;
            case 'month':
                year -= 1;
                if (year >= 1){
                    span.innerHTML = year.toString ();
                }
                break;
            case 'year':
                year -= 16;
                if (year >= 1){
                    Calendar.prototype.years (span, id);
                }
        }
    }

    next(e){
        const id = e.target.closest ('.container-calendar').dataset.calendar,
            span = document.getElementById ('title-calendar-' + id);
        switch (info) {
            case 'day':
                month += 1
                if (month > 11){
                    month = 0;
                    year += 1;
                }
                new Calendar (year, month).get (document.querySelector ('#calendar-' + id + ' tbody'));
                break;
            case 'month':
                year += 1;
                span.innerHTML = year.toString ();
                break;
            case 'year':
                year += 16;
                Calendar.prototype.years (span, id);
        }
    }

    show(e){
        const id = e.target.closest ('.container-calendar').dataset.calendar,
            span = document.getElementById ('title-calendar-' + id),
            list_months = document.getElementById ('months-' + id);
        if (info === 'month'){
            for (let i = 0; i < list_months.childElementCount; i++) {
                if (list_months.children[i] === e.target){
                    month = i;
                    info = 'day';
                    new Calendar (year, month).get (document.querySelector ('#calendar-' + id + ' tbody'));
                    list_months.classList.remove ('is-list-active');
                    document.getElementById ('calendar-' + id).classList.remove ('is-calendar-inactive');
                    break;
                }
            }
        } else {
            span.innerHTML = e.target.innerHTML;
            year = Number (e.target.innerHTML);
            info = 'month';
            document.getElementById ('years-' + id).classList.remove ('is-list-active');
            list_months.classList.add ('is-list-active');
        }
    }

    before_zero(num){
        return Number (num) < 10 ? '0' + num : num;
    }

    choose_date(e){
        const id = e.target.closest ('.container-calendar').dataset.calendar,
            element = document.querySelector ('#calendar-' + id + ' tbody .is-selected');
        if (element){
            element.classList.remove ('is-selected');
        }
        document.getElementById ('selected-' + id + '-select').innerHTML = this.#year + '-' +
            Calendar.prototype.before_zero ((this.#month)) + '-' + Calendar.prototype.before_zero (this.#day);
        document.getElementById ('selected-' + id + '-select').classList.add('is-label-selected-active');
        document.getElementById ('label-' + id + '-select').classList.add ('is-label-active');
        e.target.classList.add ('is-selected');
    }
}

const date = new Date (),
    months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    title_calendar = document.getElementsByClassName ('title-calendar'),
    icon_back = document.getElementsByClassName ('icon-back'),
    icon_next = document.getElementsByClassName ('icon-next'),
    tbody_calendar = document.querySelectorAll ('.container-calendar table tbody');

let info = 'day', year = date.getFullYear (), month = date.getMonth ();

tbody_calendar.forEach (e => {
    new Calendar ().get (e)
});
Array.from (title_calendar).forEach (e => {
    e.addEventListener ('click', new Calendar ().select_date)
});
Array.from (icon_back).forEach (e => {
    e.addEventListener ('click', new Calendar ().back)
});
Array.from (icon_next).forEach (e => {
    e.addEventListener ('click', new Calendar ().next)
});
Array.from (document.getElementsByClassName ('item')).forEach (e => {
    e.addEventListener ('click', new Calendar ().show)
});