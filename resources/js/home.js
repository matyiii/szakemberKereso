$(document.location.href == "http://127.0.0.1:8000/").ready(function () {
    var tradeSelect = document.querySelector('#tradeSelect');

    dselect(tradeSelect, {
        search: true,
        creatable: false,
        clearable: false,
    });
})