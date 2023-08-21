$(document).ready(function(){
    //slider ============================
    $('.js-slider').slick({
        infinite: true,
        arrows : false,
        speed: 800,
        fade: true,
        cssEase: 'linear',
        autoplay : true
    });

    //Tabs - Tabs Content ===============
    // $('.c-tabs li').click(function(){
    //     var item = $(this);
    //     var showContent = item.data('content');
    //     var activeColor = item.data('color');

    //     item.addClass('active');
    //     item.css({
    //        'background-color' : activeColor,
    //        'border-top-color' : activeColor
    //     });

    //     $(".c-tabs li").not(item).removeClass("active");
    //     $(".c-tabs li").not(item).css("background-color","");

    //     $('#'+showContent).fadeIn();
    //     $('.c-listpost').not('#'+showContent).hide();
    // });
    //Tabs - Tabs Content ===============
    $('.c-tabs li').click(function () {
        var item = $(this);
        var showContent = item.data('content');
        var activeColor = item.data('color');
        var checklink = item.children('a');
        if (checklink.length == 0) {
            $('.c-listpost').removeClass('active');
            $(".c-tabs li").not(item).removeClass("active");
            $(".c-tabs li").not(item).css("background-color", "");
            item.addClass('active');
            item.css({
                'background-color': activeColor,
                'border-top-color': activeColor
            });
            $('.c-listpost').not('#' + showContent).hide();
            $('#' + showContent).fadeIn();
            $('#' + showContent).addClass('active');
        }
    });
    $('.chkbutton').change(function () {
        let parent = $('#serviceSearch'),
            checked = [],
            checked2 = [];
        parent.find("input[name='service-category[]']:checked").each(function () {
            checked.push(parseInt($(this).val()));
        });
        parent.find("input[name='service-category2[]']:checked").each(function () {
            checked2.push(parseInt($(this).val()));
        });
        let data = {};
        data.action = "filter_service_category";
        data.checked = checked;
        data.checked2 = checked2;
        $.ajax({
            url: ajaxurl,
            dataType: "json",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.type == "success") {
                    $(".c-column").html(response.content);
                    $(".p-service__result span").html(response.count + "件が該当しました");
                }

                if (response.type == "empty") {
                    $(".c-column").html("");
                    $(".p-service__result span").html("0件が該当しました");
                }
            },
        });
    });

    var inputclick = document.querySelector(".c-btn .c-reset");
    inputclick.onclick = function(){
    var element = document.querySelectorAll("#mw_wp_form_mw-wp-form-149 form td input");
    var elementarea = document.querySelector("#mw_wp_form_mw-wp-form-149 form td textarea");
    for (var i = 0; i < element.length; i++) {
        element[i].defaultValue = ''
    }
    elementarea.innerHTML = ''
};

    $(".mw_wp_form form").validate({
        rules: {
            "firstname": {
                required: true
            },
            "lastname": {
                required: true
            },
            "email": {
                required: true,
                email: true,
            },
            "emailconfirm": {
                required: true,
                email: true,
            },
            "message": {
                required: true
            },
            "tel": {
                required: false,
                fnType: true,
                maxlength: 13,
                minlength:10,
            }
        },
        messages: {
            "firstname": {
                required: "この項目は必須です。"
            },
            "lastname": {
                required: "この項目は必須です。"
            },
            "email": {
                required: "この項目は必須です。",
                email: "例） example@gmail.com"
            },
            "emailconfirm": {
                required: "この項目は必須です。",
                email: "例） example@gmail.com"
            },
            "tel": {
                required: "この項目は必須です。",
                fnType: "無効な電話番号",
                maxlength: "無効な電話番号",
                minlength: "無効な電話番号",
            },
            "message": {
                required: "この項目は必須です。"
            },
        }
    });
    $.validator.addMethod('email', function (value) {
        return value.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/);
      }, '正しいメールアドレスを入力してください');
    $.validator.addMethod('fnType', function (value) {
        return value.match(/^(?:\d{0}|\d{10}|\d{11}|\d{3}-\d{3}-\d{4}|\d{2}-\d{4}-\d{4}|\d{3}-\d{4}-\d{4})$/);
      }, '有効な電話番号を入力してください');
    $(".mw_wp_form form .c-btn__submit").click(function () {
        if ($(".mw_wp_form form").valid()) {
            return true;
        }
    });
});