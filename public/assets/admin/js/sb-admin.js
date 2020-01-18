$(function() {

    $('#side-menu').metisMenu();

    $('.icon_right').click(function () {
        var $this = $(this);
        $this.parent().next().slideToggle('100', "linear");
    });
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
})


$('#v-pills-tab a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
});

// product admin $('#product_create .wapper_tab #sales_price').removeClass('hide');
// $('#product_create >.wapper_tab > .description >.schedulet').click(function(){
//     //$('#product_create .wapper_tab #sales_price').toggleClass('hide');
//     alert(1);
// });

$('#product_create .wapper_tab .schedule').off('click').on('click', function (e) {
    e.preventDefault();
    var _this = $(this);
    _this.toggleClass('hide');
    $('#product_create .wapper_tab #sales_price').toggleClass('hide');
});

$('#product_create .wapper_tab .cancle').off('click').on('click', function (e) {
    e.preventDefault();
    $('#product_create .wapper_tab #sales_price').toggleClass('hide');
    $('#product_create .wapper_tab .schedule').toggleClass('hide');
});


