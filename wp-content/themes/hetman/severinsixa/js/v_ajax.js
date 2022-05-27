$(document).ready(function() {
    console.log('v_ajax ready');
    $('.js_click_select').on('change', function() {
        console.log($(this).text().trim());

        let $this = $(this);

        let data = new FormData;

        let product_title = $(this).text().trim();
        let term = $(this).closest('.js_find_produc').attr('data-term-id')

        data.append('action', 'ajax_get_product_comparison');
        data.append('title', product_title)
        data.append('term', term)

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                // console.log('data = ' + data.status);
                if(data.result == 'ok') {
                    $this.closest('.js_find_produc').find('.js_pate_product').html(data.html)
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })
    $('.js_click_filter').click(function(event){
        const filter_params = new Map();
        let $this = $(this);
        let val = parseInt($this.attr('data-active'))
        let $filter = $(this).closest('.js_find_product').find('.js_get_filter_params');
        let offset = 1;
        if ($(this).hasClass('js_click_load_more')){
            offset = parseInt($(this).attr('data-offset')) + 1;
        } else {
            $this.attr('data-active',  val === 0 ? 1 : 0);
        }

        console.log('offset = ' + offset);

        let selected = $filter.find('[data-active=1]')
        let get_params_arr = [], get_params='';
        let data = new FormData;
        filter_params.set('category', $filter.attr('data-term'));
        selected.each
        (
            function(index)
            {
                let tax = $(this).attr('data-term-main');
                let term = $(this).attr('data-term-slug');
                // console.log('tax = ' + tax + ' term = ' + term);
                if (filter_params.has(tax)) {
                    filter_params.set(tax, filter_params.get(tax) + ';' + term)
                } else {
                    filter_params.set(tax, term);
                }
            }
        );
        // console.log(filter_params);

        filter_params.forEach((value, key, map) => {
            // alert(`${key}: ${value}`); // огурец: 500 и так далее
            get_params_arr.push(key + '=' + value);
        });
        get_params = get_params_arr.join('&');
        console.log(get_params);

        let path = window.location.href.split('?')[0]
        console.log({path})

        data.append('action', 'ajax_get_product_filter');
        data.append('get_params', get_params)
        data.append('offset', offset)

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                // console.log('data = ' + data.status);
                if(data.result == 'ok') {
                    $this.closest('.js_find_product').find('.js_paste_product').html(data.html)
                    $this.closest('.js_find_product').find('.js_post_count').html(data.post_count)
                    $this.closest('.js_find_product').find('.js_show_product_count').html(data.show_product_count)
                    window.history.pushState('page2', 'Title', path + '?' + get_params);
                    $this.closest('.js_find_product').find('.js_click_load_more').attr('data-offset', offset)
                    console.log('hide = ' + data.hide)
                    $this.closest('.js_find_product').find('.js_click_load_more').css('visibility', data.hide)
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })

//     $('.js_send_contact_form').click(function(event){
//         event.preventDefault();
//         // console.log('send info')
//         let fid_info = $(this).closest('.js_get_form_info');
//         let data = new FormData;

//         let first_name = fid_info.find('.js_get_first_name').val();
//         if (first_name.length < 2) {
//             fid_info.find('.js_get_first_name').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_first_name').removeClass('error');

//         let last_name = fid_info.find('.js_get_last_name').val();
//         if (last_name.length < 2) {
//             fid_info.find('.js_get_last_name').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_last_name').removeClass('error');

//         let email = fid_info.find('.js_get_email').val();
//         if (email.length < 2) {
//             fid_info.find('.js_get_email').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_email').removeClass('error');

//         let phone = fid_info.find('.js_get_phone').val().replace(/\D/g, '');
//         if (phone.length < 11) {
//             fid_info.find('.js_get_phone').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_phone').removeClass('error');

//         let select = $( ".js_get_select option:selected" ).text();

//         let theme = fid_info.find('.js_get_theme').val();
//         if (theme.length < 5) {
//             fid_info.find('.js_get_theme').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_theme').removeClass('error');

//         let message = fid_info.find('.js_get_message').val();
//         if (message.length < 5) {
//             fid_info.find('.js_get_message').addClass('error');
//             return;
//         }
//         fid_info.find('.js_get_message').removeClass('error');

//         data.append('action', 'ajax_send_contact_form');
//         data.append('first_name', first_name)
//         data.append('last_name', last_name)
//         data.append('email', email)
//         data.append('phone', phone)
//         data.append('select', select)
//         data.append('theme', theme)
//         data.append('message', message)

//         $.ajax({
//             url: window.ajaxUrl,
//             type: 'POST',
//             dataType: 'json',
//             processData: false,
//             contentType: false,
//             data: data,
//             success: function (data) {
//                 // console.log('data' + data);
//                 // console.log('data = ' + data.status);
//                 if(data.status == 'ok'){
//                     fid_info.find('.js_get_first_name').val('');
//                     fid_info.find('.js_get_last_name').val('');
//                     fid_info.find('.js_get_email').val('');
//                     fid_info.find('.js_get_phone').val('');
//                     fid_info.find('.js_get_theme').val('');
//                     fid_info.find('.js_get_message').val('');

//                     showPopup();
//                 }
//             },
//             error: function (jqXHR, status, errorThrown) {
//                 console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
//             }
//         })
//     })

    // $('.js_click_checkbox').on('change', function (event){
    //     let input = $(this).find('.js_get_bundle');
    //     if (input.attr("checked") == 'checked')
    //         input.attr("checked",  false);
    //     else
    //         input.attr("checked",  'checked');
    // })

    $('.js_add_product_to_cart').on('click', function() {
        event.preventDefault();

        let $this = $(this);
        let data = new FormData;
        let info = $(this).closest('.js_get_info')
        let product_id = [];
        product_id.push($(this).attr('data-product_id'));
        let quantity = $( ".js_get_quantity option:selected" ).text();
        let js_get_bundle = $('.js_get_bundle').find("input:checked");

        console.log(js_get_bundle);

        js_get_bundle.each
        (
            function(index)
            {
                let id = $(this).attr('data-product_id');
                product_id.push(id);
            }
        );

        data.append('action', 'ajax_add_product_to_cart');
        data.append('product_id', product_id.join(';'))
        data.append('quantity', quantity)

        console.log(product_id.join(';'));

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                // console.log('data = ' + data.status);
                if(data.result == 'ok') {
                    $('.js_update_product_cart').html(data.cart_product_count)
                    js_get_bundle.each
                    (
                        function(index)
                        {
                            $(this).attr("checked",  false);
                        }
                    );
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })

    $('.js_change_quantity').on('change', function(event) {
        // event.preventDefault();


        let $this = $(this);
        let data = new FormData;
        let $info = $(this).closest('.js_get_product_info')

        let js_update_cross_quantity = $info.find('.js_update_cross_quantity')

        let quantity = parseInt($(this).find( "option:selected" ).text());
        let product_id = $info.attr('data-product_id')


        data.append('action', 'ajax_change_product_quantity');
        data.append('product_id', product_id)
        data.append('quantity', quantity)

        // return;

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                if(data.status == 'ok') {
                    $('.js_update_product_cart').html(data.curt_items)
                    $('.js_set_subtotal').html(data.subtotal)
                    $('.js_set_shipping').html(data.shipping)
                    $('.js_set_tax').html(data.tax)
                    $('.js_set_total').html(data.total)

                    js_update_cross_quantity.each
                    (
                        function(index)
                        {
                            $(this).html(quantity + ' x')
                        }
                    );
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })

    $('.js_remove_from_cart').on('click', function(event) {
        event.preventDefault();

        let data = new FormData;
        let $info = $(this).closest('.js_get_product_info')
        let product_id = $info.attr('data-product_id')

        data.append('action', 'ajax_remove_from_cart');
        data.append('product_id', product_id)

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                if(data.status == 'ok') {
                    $info.remove();
                    $('.js_update_product_cart').html(data.curt_items)
                    $('.js_set_subtotal').html(data.subtotal)
                    $('.js_set_shipping').html(data.shipping)
                    $('.js_set_tax').html(data.tax)
                    $('.js_set_total').html(data.total)
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })

    $('.js_add_coupons').on('click', function(event) {
        event.preventDefault();

        let data = new FormData;
        let $info = $(this).closest('.js_find_info')
        let coupons = $info.find('.js_get_coupons').val();

        data.append('action', 'ajax_add_coupons');
        data.append('coupons', coupons);

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                if(data.status == 'ok') {
                    $('.js_update_product_cart').html(data.curt_items)
                    $('.js_set_subtotal').html(data.subtotal)
                    $('.js_set_shipping').html(data.shipping)
                    $('.js_set_tax').html(data.tax)
                    $('.js_set_total').html(data.total)

                    $('.js_add_coupons_item').css('display', data.show_coupon)

                    let html = '<div class="cart__sum-item">\n' +
                        '<p class="cart__sum-title">' + data.title + '</p>\n' +
                        '<p class="cart__sum-value">' + data.amount + '</p>\n' +
                        '</div>'
                    $('.js_add_coupons_item').append(html);
                    console.log(data.amount)
                }
                $info.find('.js_get_coupons').val('');
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })

    $('.js_set_shipping_methods').on('change', function(event) {
        let data = new FormData;
        let $shipping_methods = $(this).find('input:checked').val()
        // let coupons = $info.find('.js_get_coupons').val();

        if ($shipping_methods == null)
            return;

        data.append('action', 'ajax_set_shipping_methods');
        data.append('shipping_methods', $shipping_methods);
        //
        console.log('shipping_methods = ' + $shipping_methods)
        // return;

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                if(data.status == 'ok') {
                    $('.js_update_product_cart').html(data.curt_items)
                    $('.js_set_subtotal').html(data.subtotal)
                    $('.js_set_shipping').html(data.shipping)
                    $('.js_set_tax').html(data.tax)
                    $('.js_set_total').html(data.total)
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })


})