$(document).ready(function () {

    $('body').on('click','#lang-switcher a',function () {
        var locale = $(this).attr('data-lang');
        var _token = $("form#language>input[name=_token]").val();

        $.ajax({
            url: "/language",
            type: 'POST',
            data:{locale:locale,_token:_token},
            datatype: 'json',
            success: function (data) {
            },
            error:function (data) {
            },
            beforeSend:function (data) {

            },
            complete:function (data) {
                window.location.reload(true);
                console.log(data);
            }
        })
    });

    $('body').on('submit', '#form_sold', function (e) {
        alert('ici');
        e.preventDefault()
        let $product = $('#form_sold #product-search').val();
        let $url = $('#form_sold').attr('action')
        let $token = $('input[name="_token"]').val();
        $.ajax({
            method: 'POST',
            url: $url,
            data: {"_token": $token, "product": $product},
            error: function (data) {
                console.log(data)
            },
            success: function (data) {
                $('#list-purchase').html(data);
            }
        })
    });
    $('body').on('click', '.add-product', function () {
        var $target = $(this).attr('data-target');
        $('.form-bc' + $target).show();
    });
})
