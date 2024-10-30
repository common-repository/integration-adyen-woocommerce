( function($, woosa){

   if ( ! woosa ) {
      return;
   }

   var Ajax = woosa.ajax;
   var Translation = woosa.translation;

   var moduleTools = {

      init: function(){

         //prevent the window which says "the changes may be lost"
         $(document).on('load click change', function(){
            window.onbeforeunload = null;
         });

         this.show_process_loader();
      },


      /**
       * Displays a loader when pressing a button
       */
      show_process_loader: function(){

         $(document).on('click', '[data-'+woosa.prefix+'-tools] a.button', function(e){

            $(this).addClass('disabled');

            jQuery('#wpcontent').block({
               message: null,
               overlayCSS: {
                  background: '#fff',
                  opacity: 0.6
               }
            });

         });

      }

   };

   $( document ).ready( function() {
      moduleTools.init();
   });


})( jQuery, adn_module_tools );