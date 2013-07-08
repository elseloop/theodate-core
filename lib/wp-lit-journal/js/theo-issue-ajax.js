/**
  *
  * AJAX for Issues Table of Contents page
  *
  */

(function($) {
  
  $( '#theo-issue-toc-form' ).submit( function(e) {
    
    var loadingGif      = $( '#theo-loading' );
    var submitBtn       = $( '#theo-issue-toc-submit' );
    var selected        = $(this).find( '#theo-issues-select' ).val();
    var poetryTable     = $( "#poetry-table tbody" );
    var ekphrasisTable  = $( "#ekphrasis-table tbody");

    e.preventDefault();
    
    loadingGif.show();
    submitBtn.attr( 'disabled', true );

    // poetry data    
    poem_data = {
      
      action:                 'theo_load_issue_poems',
      issue_id:               selected,
      theo_issue_toc_nonce:   theo_issue_vars.theo_issue_toc_nonce

    };

    // poetry table update
    $.post( ajaxurl, poem_data, function(response) {
        
          poetryTable.html(response);

          loadingGif.hide();
          submitBtn.attr( 'disabled', false );

    });

    // ekphrasis data
    // same as poetry, but sent to separate action
    ekphrasis_data = {
      
      action:                 'theo_load_issue_ekphrasis',
      issue_id:               selected,
      theo_issue_toc_nonce:   theo_issue_vars.theo_issue_toc_nonce

    };

    // ekphrasis table update
    $.post( ajaxurl, ekphrasis_data, function(response) {
        
          ekphrasisTable.html(response);

    });    

  });

})(jQuery);