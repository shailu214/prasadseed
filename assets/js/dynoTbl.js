(function ( $ ) {

    $.fn.dynmoTbl = function( options ) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            url: "",
            data: [],
            tpl: [],
            paging: false
        }, options );

        body = this.find('tbody');
        foot = this.find('tfoot');
        // alert(body.html());
        // Greenify the collection based on the settings variable.

        cols = settings.data;
        result = getData(settings.url, {'page':1, 'limit':10});

        var htm = '';
        $.each(result.data, function(i , row){
          htm = htm+'<tr>';
          t=0;
          $.each(cols, function(j , rs){

            if(rs == 'tpl') {
              htm = htm+'<td>'+settings.tpl[t]+'</td>';
              t++;
            } else {
              htm = htm+'<td>'+row[rs]+'</td>';
            }

          });
          htm = htm+'</tr>';
        });
        body.html(htm);
        var meta = result.meta;


      if(settings.paging == true) {
        row = result.meta.rows;
        pg = '<ul class="pagination btn-group">';
        for (i=1; i<= row; i++ ) {
          pg=pg+'<li><a href="javascript:;" class="btn btn-sm btn-outline-primary" >'+i+'</a></li>';
        }
        pg = pg+"</ul>";
        foot.html(pg);
        // alert(pg);
      }

    };

    function getData (uri, meta) {
      $.ajax({
       'async': false,
        'url':uri,
        'data': meta,
        'global': false,
        'dataType':'json',
        'success': function( result ) {
          res = result;
        }
      });

      return res;
    }

}( jQuery ));
