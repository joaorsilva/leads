var date_ranges = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
};

var date_locale = {
    format: 'MM-DD-YYYY',
    cancelLabel: 'Cancel',
    applyLabel: 'Ok',
    customRangeLabel: 'Custom interval',
    fromLabel: "From",
    toLabel: "To",
    daysOfWeek: [
        "Sun",
        "Mon",
        "Tue",
        "Wed",
        "Thu",
        "Fri",
        "Sat"
    ],
    monthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "Setember",
        "Outober",
        "November",
        "December"
    ]};



