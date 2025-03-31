/**=====================
     Quantity 2 js
==========================**/
$(".addcart-button").off().on("click", function () {
    $(this).next().addClass("open");
    $(".add-to-cart-box .qty-input").val('1');
});

$('.add-to-cart-box').off().on('click', function () {
    var $qty = $(this).siblings(".qty-input");
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
    }
});

$('.qty-left-minus').off().on('click', function () {
    var $qty = $(this).siblings(".qty-input");
    var _val = parseInt($qty.val());
    if (_val == 1) {
        $(this).parents('.cart_qty').removeClass("open");
    }
    if (!isNaN(_val) && _val > 1) {
        $qty.val(_val - 1);
    }
});

$('.qty-right-plus').off().on('click', function () {
    var $qty = $(this).prev();
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
    }
});
