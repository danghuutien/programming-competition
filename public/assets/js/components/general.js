$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $('body').on('click', '.recruitment-left__box form .search-icon', function(){
        $('.recruitment-action .action-submit button').click();
    })
    $('body').on('click', '.recruitment-action .action-cancel .button', function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().find('.form-group input').each(function(index,element){
            $(element).val('')
        })
        $(this).parent().parent().parent().find('.form-group select').each(function(index,element){
            $(element).val('0')
        })
        $('.recruitment-action .action-submit button').click();
    });
    $('body').on('click', '.recruitment-action .action-submit button', function(e) {
        e.preventDefault();
        data = $(this).closest('form').serialize();

        $.ajax({
            url: '/ajax/filter_jobs',
            type: 'POST',
            data: data,
            beforeSend: function() {
                loadingBox('open');
            },
            success: function (response) {
                console.log('tra ve: ',response.status);
                if(response.status == 1) {
                    console.log(response.count);
                    $('#listdata').empty();
                    $('#listdata').append(response.html);
                    $('.pagination').empty(); 
                    $('.pagination').append(response.pagination); 
                    $('.recruitment .recruitment-right__heading').removeClass('none');
                    $('.recruitment .recruitment-right__heading .left').empty(); 
                    $('.recruitment .recruitment-right__heading .left').append(`<p>${response.count} công việc đang chờ bạn tại Eurowindow Holding</p>`);
                } else if (response.status == 0){
                    console.log(2);
                    const html = '<em style="color:red;">Không tìm thấy bài tuyển dụng phù hợp!</em>'
                    $('#listdata').empty();
                    $('.recruitment .recruitment-right__heading').addClass('none')
                    $('#listdata').append(html);
                    $('.pagination').empty(); 
                    $('.pagination').append(response.pagination);  
                }
                loadingBox('close');
            },
            error: function (xhr, status, error) {
                loadingBox('close')
                alert_show('error', 'Đã xảy ra lỗi. Vui lòng thử lại sau.');
            }
        });
    });
    
});
// check validate order
function validForm(form) {
    var check = true;
    $('.err_show').removeClass('active');
    $('#'+form+' .form-control').each(function(){
        var name = $( this ).attr('name');
        $( this ).css({'border':'1px solid #d5d5d5'}).css({'visibility':'visible'});
        if($( this ).val() == '') {
            $( this ).focus();
            $( this ).parent().find('.err_show.null').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'email' && !isEmail($( this ).val())) {
            $( this ).parent().find('.err_show.email').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'phone' && !isPhone($( this ).val())) {
            $( this ).parent().find('.err_show.phone').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() == 0 && $( this ).attr('name') == 'product_name') {
            $( this ).parent().find('.err_show').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if(check == false){
            // console.log($('#'+form+' .form-control:first-child .err_show.active'))
            var f = form;
            if(f == 'formComment' || f.includes('formComment')){
                f = 'cmt_vote';
            }
            // nếu là form tu vấn chi tiết sp thì khoogn scroll
            if(f != 'form_contact'){
                var t = $('#'+f).position().top;
                $("html, body").animate({ scrollTop: t }, "slow");
            }
        }
    });
    return check;
} 
function setCookie(key, value, minute) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (minute * 60 * 1000));
    document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
};
function isPhone(phone) {
    var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    return regex.test(phone);
}; 
// LoadingBox
function loadingBox(type='open') {
    if (type == 'open') {
        $("#loading_box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
    } else {
        $("#loading_box").animate({opacity: 0.0}, 200, function(){
            $("#loading_box").css("visibility","hidden");
        });
    }
}
function alert_show(type='success',message='') {
    $('#toast-container .toast').addClass('toast-'+type);
    $('#toast-container .toast div').text(message);
    $('#toast-container').css('display','block');
    setTimeout(function() {
        $('#toast-container').css('display','none');
        $('#toast-container .toast').removeClass('toast-'+type);
        $('#toast-container .toast div').text('');
    }, 2000);
}
var getUrlParameter = function(url,name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
$('body').on('click','.pagination__numbers .paginate_item',function(){
    let data_href = $(this).data('href')
    if(data_href == null || data_href == undefined || data_href == '') return
    var page = getUrlParameter(data_href, 'page');
    pushOrUpdate({ page: page, });
    let newUrl = data_href.split('?')[0] || data_href
    newUrl = newUrl + '#trang='+page
    $('.pagination__numbers .paginate_item').each(function(index, element){
        if($(element).hasClass('active')){
            $(element).removeClass('active')
        }
    })
    $(this).addClass('active')
    update_url(newUrl);
    loadData('', '', '', false);
});
function pushOrUpdate(param_obj) {
    var url = new URL($('input[name="current_url"]').val());
    $.each(param_obj, function(key, value) {
        url.searchParams.set(key, value);
    })
    var newUrl = url.href;
    update_input_url(newUrl);
}
function update_input_url(url_page){
    $('input[name="current_url"]').val(url_page)
}
function update_url(url_page) {
    history.pushState(null, null, url_page);
}
function loadData(animate='progress', type='', type_wrapper='', typeAppend = true) {
    var url = $('input[name="current_url"]').val();
    loadAjaxGetPaginate(url, {
        beforeSend: function(){},
        success:function(result){
            if(type == 'products') {
                $('.datas-top__wrap .count')
                    .data('count', result.total)
                    .attr('data-count', result.total)
                    .text(result.total)
            }
            $('.pagination').empty(); 
            $('.pagination').append(result.pagination);  
            if (!typeAppend) {
                $('html, body').animate({
                    scrollTop: $('#listdata').position().top
                }, 300)
                $('#listdata').empty()
                $('body .paginate_item').each(function(){
                    let href = $(this).data('href')
                    let page = getUrlParameter(href, 'page');
                    let newUrl = href.split('?')[0] || href
                    newUrl+='#trang='+page
                    let currentUrl = window.location.href
                    if(currentUrl == newUrl) {
                        $(this).addClass('active')
                    }
                })
            }
            $('#listdata').append(result.html);
        },
        error: function (error) {}
    }, animate);
}
function loadAjaxGetPaginate(url, option, type){
    if (checkEmpty(type)) { type = 'progress'; }
    var _option = {
        beforeSend:function(){},
        success:function(result){},
        error:function(error){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        beforeSend: function(){
            loadingBox('open');
        },
        success:function(result){
            loadingBox('close');
            _option.success(result);
        },
        error: function (error) {
           /* Có lỗi sẽ ân Module Loading và thông báo */
            loadingBox('close');
            alert_show('error', $('#loading_box').data('error'))
            _option.error(error);
        }
    })
}
function checkEmpty(value) {
    if (value == null) {
        return true;
    } else if (value == 'null') { 
        return true;
    } else if (value == undefined) { 
        return true;
    } else if (value == '') { 
        return true;
    } else if(value == []) {
        return true;
    } else {
        return false;
    }
}
$('.popup .form-group .form-control').on('focus', function(){
    $(this).parent().find('.label').addClass('active')
    
})
$('.popup .form-group .form-control').on('blur', function(){
    if($(this).val() == ''){
        $(this).parent().find('.label').removeClass('active')
    }
})
$('#popup .close-popup').on('click', function(){
    $('#popup').removeClass('active')
    $('#popup').find('.form-control').each(function(index, element){
        $(element).focus()
    })
    $('#upload-cv').removeClass('error')
    $('#popup-overlay').removeClass('active')
})
$('#popup-overlay').click(function(){
    $('#popup').removeClass('active')
    $('#popup').find('.form-control').each(function(index, element){
        $(element).focus()
    })
    $('#upload-cv').removeClass('error')
    $('#popup-overlay').removeClass('active')
})
$('#popup .form-group #upload-cv').on('click', function(){
    $(this).parent().find('input[name="file_cv"]').click()
})

$('body').on('click','.open-popup__recruitmen.button-action .action',function() {
    $('#popup').addClass("active")
    $('#popup-overlay').addClass('active')
    let job_id = $(this).data('id')
    let job_name = $(this).data('name')
    $('#popup').find('input[name="job_id"]').val(job_id)
    $('#popup input[name="job_id"]').parent().find('.label').text(job_name)
    $('#popup input[name="job_id"]').parent().find('.label').addClass('active')
})

$('body').on('click','.recruitment-item .share',function() {
    const link= $(this).parent().parent().find('.recruitment-item__middle .text-title__main').parent().attr('href');
    share(link)
})
$('body').on('click','.detail-recruitment__right .share',function() {
    const link = window.location.href
    share(link)
})

function share(link){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(link).select();
    document.execCommand("copy");
    $temp.remove();
    alert('Đã copy !!!')
}

$('.register-new .box-right .action-regi').click(function() {
    $('#popup-register-new').addClass("active")
    $('#popup-regi__overlay').addClass('active')
})
$('#popup-register-new .close-popup').on('click', function(){
    $(this).parent().removeClass('active')
    $('#popup-regi__overlay').removeClass('active')
    $('#popup-register-new').find('.form-control').each(function(index, element){
        $(element).focus()
    })
})
$('#popup-regi__overlay').on('click', function(){
    $('#popup-register-new').removeClass('active')
    $(this).removeClass('active')
    $('#popup-register-new').find('.form-control').each(function(index, element){
        $(element).focus()
    })
})
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}

// check định dạng số điện thoại
function validatePhone(phone) {
	var flag = false;
	phone = phone.trim();
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        if (phone.length >= 9 && phone.length <=11) {
        	flag = true;
        } else {
        	flag = false;
        }
    }
    return flag;
}

$(document).on( "scroll", function() {
    if($(this).scrollTop() > 20){
        $(this).find('header .header-content').addClass('active')
    }else{
        $(this).find('header .header-content').removeClass('active')
    }
});

$(window).scroll(function(){
    const width = $(window).outerHeight()
    if($(this).scrollTop() > width / 3) {
        $('.cta .backtop').addClass('active');
    } else {
        $('.cta .backtop').removeClass('active');
    }
})
$('body').on('click', '.cta .backtop', function(){
    $('html, body').animate({scrollTop:0}, 500)
})
$('.venobox').venobox();