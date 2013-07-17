(function($){
  
  $('#ekphrasis-table').sortable({
    
    items:      '.theo-content-ekphrasis-list',
    opacity:    0.8,
    cursor:     'move',
    axis:       'y',
    tolerance:  'pointer',
    update: function(event, ui) {
      
      var serializedData  = $(this).sortable('serialize');
      var order           = serializedData + '&action=theo_update_ekphrasis_order';
      //alert(data);
      $.post(ajaxurl, order, function(response) {
        $( "#ekphrasis-table tr").each(function(index){

          // menu_order is saved and will display correctly on reload,
          // but we need a visual cue for the user, so we're just
          // setting the displayed order to the index post-drop,
          // which in most cases should be the same anyway
          var el  = $(this);
          var key = el.find(".key");

          key.text(index - 1);

        });
      });
    
    }

  })

})(jQuery);