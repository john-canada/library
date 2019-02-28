//$(function ($) {
var app = angular.module('myApp',[]);
app.controller('myCtrl', function($scope, $http) {

    $scope.handleClick = function () {
        $http.get("http://staging.firmanpowerequipment.com/wp-json/wp/v2/product?include[]=1983&include[]=1665")
            .then(function(response) {
                $scope.jsondata = response.data;
                console.log(response.data);
            });
    }

});

jQuery(document).ready(function ($) {

    var newHTML;
    var i;
    var x;
    var d1, d2, d3;

    //set stars on comparison table via archive
    var compare_products = $(".star-rating-compare");
    var arr_render = [];
    setTimeout(function () {
        compare_products.find(' > span').each(function (index) {

            var post_id = $(this).attr('id').split('-')[1];

            arr_render.push({
                locale: 'en_US',
                merchant_group_id: '77567',
                page_id: post_id,
                merchant_id: '412359',
                api_key: 'adea19b5-b8b5-4faf-b3c7-6282f0d0c87d',
                review_wrapper_url: 'https://www.firmanpowerequipment.com/write-a-review/?pr_page_id=' + post_id,
                components: {
                    CategorySnippet: 'star_rating-' + post_id
                }
            });

            if (index == (compare_products.find(' > span').length - 1)) {
                POWERREVIEWS.display.render(arr_render);
            }

        });
    }, 1000);

    //reset checkbox
    $('.form_filter :checkbox').each(function () {
        $(this).prop('checked', false);
    });

    function showData() {


        var all = new Array();
        var i = 0;

        $('.form_filter :checkbox').each(function () {
            if (this.checked) {


                all[i] = this.value;
                i = i + 1;
                $(this).addClass('selected-compare');

            } else {
                $(this).removeClass('selected-compare');
            }

        });
        console.log(i);
        if (i == 0) {
            $('.select_product_plate').hide();
        }
        if (i == 1) {

            $('.select_product_plate').html("Select 1 more product to compare");
            $('.select_product_plate').show();
        }
        if (i == 2 || i == 3 || i == 4) {

            $.ajax({

                type: 'post',
                //  post_type: 'product',
                //contentType:'application/json; charset=utf-8',

                url: ajax_object.ajax_url,
                data: {
                    data: all.join(),
                    action: 'abcd'
                },

                success: function (response) {
                    console.log(response);
                    //alert('Response from server  ' + response);

                },

                error: function (error) {
                    console.log(error);
                }


            });//end of ajax


            $('.select_product_plate').html("<a><div class='ajaxcall'>Compare " + i + " products </div></a>");
            $('.select_product_plate').show();


            $('.ajaxcall').on('click', function () {
                $('.select_product_plate').html("<a><div class='ajaxcall'>Processing.. </div></a>");

                setTimeout(function () {
                    location.href = 'https://www.firmanpowerequipment.com/product-table/';
                }, 2000);

            });


        }
        if( i >= 4 ){
            $('.form_filter :checkbox').each(function () {
                $(this).not( $('.selected-compare') ).prop('disabled', true);
            });
            $('.select_product_plate').append('<small>Up to 4 selections only<small>');
        }
        if( i <= 3 ){
            $('.form_filter :checkbox').each(function () {
                $(this).not( $('.selected-compare') ).prop('disabled', false);
            });
            $('.select_product_plate').find('small').remove();
        }

    }


    $('.form_filter :checkbox').on("change", function () {
        showData();
    });


    $('.display_specification').on('click', function () {
        $('.display_none').toggle('slow');
        $('.display_specification').hide();
    });

    setTimeout(function () {
        $('.checkbox_index_compare_table').show();
    }, 500);

    $(".extra_style").addClass("intro");

});// end of jquery 




