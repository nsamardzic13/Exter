import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$("#datepicker-start-one").datepicker({
    firstDay: 1,
    showOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd.mm.yy"
});

$(".date").mousedown(function() {
    $(".ui-datepicker").addClass("active");
});

$("#datepicker-end-one").datepicker({
    firstDay: 1,
    showOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd.mm.yy"
});

$("#datepicker-start").datepicker({
    firstDay: 1,
    showOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd.mm.yy"
});
