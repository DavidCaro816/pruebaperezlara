<?php

function calendar(string $id): void
{
    echo '<div class="container-calendar" data-calendar="' . $id . '">
    <div class="caption-date">
        <span id="title-calendar-' . $id . '" class="title-calendar" ></span>
        <div class="icons">
            <img id="icon-back" class="icon-back" src="' . icon('buttons/icon_select.svg') . '" alt="">
            <img id="icon-next" class="icon-next" src="' . icon('buttons/icon_select.svg') . '" alt="">
        </div>
    </div>
    <table id="calendar-' . $id . '">
        <thead>
            <tr>
                <th class="weekday">Do</th>
                <th class="weekday">Lu</th>
                <th class="weekday">Ma</th>
                <th class="weekday">Mi</th>
                <th class="weekday">Ju</th>
                <th class="weekday">Vi</th>
                <th class="weekday">Sa</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <ul id="months-' . $id . '" class="list list-month">
        <li class="item">Ene</li>
        <li class="item">Feb</li>
        <li class="item">Mar</li>
        <li class="item">Abr</li>
        <li class="item">May</li>
        <li class="item">Jun</li>
        <li class="item">Jul</li>
        <li class="item">Ago</li>
        <li class="item">Sep</li>
        <li class="item">Oct</li>
        <li class="item">Nov</li>
        <li class="item">Dic</li>
    </ul>
    <ul id="years-' . $id . '" class="list list-year"></ul>
</div>';
}
