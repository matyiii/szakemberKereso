$(document.location.href == "http://127.0.0.1:8000/").ready(function () {
    let tradeSelect = document.querySelector('#tradeSelect');
    let citySelect = document.querySelector('#citySelect');

    dselect(tradeSelect, {
        search: true,
        creatable: false,
        clearable: false,
    });

    dselect(citySelect, {
        search: true,
        creatable: false,
        clearable: false,
    });
})