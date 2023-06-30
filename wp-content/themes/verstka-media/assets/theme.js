jQuery(function($) {

    $('.more_button').on('click',function(){
        $button  = $(this);
        let page = parseInt($button.attr('data-page') )+ 1;
        let term_id = parseInt($button.attr('data-term-id') );


        let data = {
            action:'getPostsPerPage',
            page: page,
            term_id: term_id
        };
        if(parseInt($button.attr('data-author-id') ) > 0){
            data['author']=parseInt($button.attr('data-author-id'));
        }

        // 'ajaxurl' не определена во фронте, поэтому мы добавили её аналог с помощью wp_localize_script()
        jQuery.post( themeAjax.url, data, function(response) {
            $button.attr('data-page',page);
            if(response != '408'){
                $('main ul').append(response);
            }
        });

    });

    $('.more_button_main').on('click',function(){
        $button  = $(this);
        let page = parseInt($button.attr('data-page') )+ 1;
        let term_id = parseInt($button.attr('data-term-id') );

        let data = {
            action:'getPostsPerPageMain',
            page: page,
            term_id: term_id
        };

        // 'ajaxurl' не определена во фронте, поэтому мы добавили её аналог с помощью wp_localize_script()
        jQuery.post( themeAjax.url, data, function(response) {
            $button.attr('data-page',page);
            if(response != '408'){
                $('.wp-container-custom.wp-block-post-template').append(response);
            }
        });

    });

    var searchInput=document.getElementById('wp-block-search__input-1');
    if(searchInput){
        searchInput.setAttribute('autofocus','autofocus');
        searchInput.focus();
        searchInput.click(function (){
            searchInput.focus();
            searchInput.prompt();
        });
    }

    $('.spoilerIcon').on('click',function (){
        $spoilerContainer = $(this).closest('.intextSpoiler');
        $spoilerContainer.find('.spoilerText').show();
        $spoilerContainer.find('.spoilerClose').show();
        $spoilerContainer.find('.spoilerIcon').hide();
        $spoilerContainer.attr('style','display:inline;');
    });

    $('.spoilerClose').on('click',function (){
            $spoilerContainer = $(this).closest('.intextSpoiler');
        $spoilerContainer.attr('style','display:inline-block;');
            $spoilerContainer.find('.spoilerClose').hide();
            $spoilerContainer.find('.spoilerText').hide();
            $spoilerContainer.find('.spoilerIcon').show();
    });
    window.onscroll = function() {myFunction()};


    var navbar = document.querySelector('header.wp-block-template-part');

// Get the offset position of the navbar
    var sticky = 125;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
});