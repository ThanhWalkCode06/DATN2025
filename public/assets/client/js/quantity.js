/**=====================
     Quantity js
==========================**/
$('.qty-right-plus').off().on('click', function () {
    var $qty = $(this).prev();
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
    }
});

$('.qty-left-minus').off().on('click', function () {
    var $qty = $(this).next();
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal) && currentVal > 1) {
        $qty.val(currentVal - 1);
    }
});
