/**
  *
  * AJAX for Issues Table of Contents page
  *
  */

(function($) {
  
  $( '#theo-issue-toc-form' ).submit( function(e) {
    
    var loadingGif  = $( '#theo-loading' );
    var submitBtn   = $( '#theo-issue-toc-submit' );
    var selected    = $(this).find( '#theo-issues-select' ).val();
    var table       = $( "#poetry-table tbody" );

    e.preventDefault();
    
    loadingGif.show();
    submitBtn.attr( 'disabled', true );
    
    data = {
      
      action:                 'theo_load_issue',
      issue_id:               selected,
      theo_issue_toc_nonce:   theo_issue_vars.theo_issue_toc_nonce

    };

    $.post( ajaxurl, data, function(response) {
        
          table.html(response);

          loadingGif.hide();
          submitBtn.attr( 'disabled', false );

    }); 

  });

})(jQuery);