 jQuery(document).ready( function(){ 
  jQuery( document ).on( 'click', '.custom_featured_btn', function () {
       var pid = jQuery(this).data('value');
       var nounce = ajax_featured.featured_nonce;
       //alert(nounce);
        jQuery.ajax({
          //url: '".plugin_dir_url(__FILE__)."featured_opt.php',
          url: ajax_featured.ajax_url,
          type: 'POST',
          data: {
            action : 'wpm_ajax_request',
            pid : pid,
            nounce : nounce,
          },
          success: function(response){
            if(response){
              location.reload();
            }
          }
        });
      location.reload();
  });
});
