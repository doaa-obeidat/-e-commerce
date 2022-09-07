jQuery(document).ready(function(){
    jQuery(".skt-blocks-quick-links").click(function(){
        if(jQuery(".skt-blocks-quick-links").hasClass( "skt-blocks-quick-links-close" )) {
            jQuery(".skt-blocks-quick-links").removeClass( "skt-blocks-quick-links-close" );
            jQuery(".skt-blocks-quick-links").addClass( "skt-blocks-quick-links-open" );
        } else {
            jQuery(".skt-blocks-quick-links").addClass( "skt-blocks-quick-links-close" );
            jQuery(".skt-blocks-quick-links").removeClass( "skt-blocks-quick-links-open" );
        }
    }); 
});
