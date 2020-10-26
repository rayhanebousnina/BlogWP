jQuery(document).ready( function($) {
    
    "use scrict";

    var ajaxurl = blog_prime_ajax.ajax_url;
    var loading = blog_prime_ajax.loading;
    var loadmore = blog_prime_ajax.loadmore;
    var nomore = blog_prime_ajax.nomore;

    var page = 2;
    $('body').on('click', '.loadmore', function() {

        $(this).addClass('loading');
        $(this).html('<span class="ajax-loader"></span><span>'+loading+'</span>');
        var data = {
            'action': 'blog_prime_recommended_posts',
            'page': page,
        };
 
        $.post(ajaxurl, data, function(response) {
            $('.recommended-post-wraper').append(response);

            if( $('body').hasClass('booster-extension') ){
                likedislike('after-load-'+page);
            }

            page++;

            if( !$.trim(response) ){
                $('.loadmore').addClass('no-more-post');
                $('.loadmore').html(nomore);
            }else{
                $('.loadmore').html(loadmore);
            }

            $('.loadmore').removeClass('loading');
            

            var pageSection = $(".data-bg");
            pageSection.each( function () {
                if ( $(this).attr("data-background")) {
                    $(this).css("background-image", "url(" + $(this).data("background") + ")");
                    $('.recommended-load').matchHeight();
                }
            });

        });

    });

});