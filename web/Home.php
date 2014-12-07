<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disaster Management System</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://rawgit.com/seiyria/bootstrap-slider/master/dist/css/bootstrap-slider.min.css">

  </head>
  <body>
    <div class="row">
      <div class="col-xs-6 col-md-9">
        <iframe src="map/files/index.html" width="100%" height="650">
          
        </iframe>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="row">
          <div class="col-xs-12 col-md-11">
            <div class="panel panel-danger">
              <div class="panel-heading" id='panel_head'>
                <h3 class="panel-title">News
                <span class="caret pull-right"></span></h3>
              </div>
              <div class="panel-body" id="panel">
                Panel content
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-11">
            <form class="navbar-form" role="search">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="checkbox">
                     <label>
                       <input value="Landslide" type="checkbox"> Landslide
                     </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="Cyclone" type="checkbox"> Cyclone
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="Flood" type="checkbox"> Flood
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="Tsunami" type="checkbox"> Tsunami
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="Earthquake" type="checkbox"> Earthquake 
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <input type=date step=7 min=1800-01-01> : From
                </li>
                <li class="list-group-item">
                  <input type=date step=7 min=1800-01-01> : To
                </li>
                <li class="list-group-item">
                  <button type="button" class="btn btn-default">Search <span class="glyphicon glyphicon-search"></span></button>
                </li>
              </ul>
            </form>
          </div>
        </div>

      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://rawgit.com/seiyria/bootstrap-slider/master/dist/bootstrap-slider.min.js"></script>
    <script src="js/test.js">></script>
    <script type="text/JavaScript">
    $(function(){
        
    var ajaxSubmit = function(){
        $.ajax({
         type: "GET",
         url: 'service.php',
         async: false,
         beforeSend: function(x) {
          if(x &amp;&amp; x.overrideMimeType) {
           x.overrideMimeType("application/j-son;charset=UTF-8");
          }
         },
         dataType: "json",
        success: function(data){
        for(i = 0; i < data.items.length; i++) {
                            $('#ptest').append("<p>" + data[i].title + "</p>");
                         }
           /* $.each( data.markers, function(i, marker) {
            $('#newsfeed').append("<h>"+location +"</h>");
    		    	    $('#map_canvas').gmap('addMarker', {
    				     'position': new google.maps.LatLng(marker.latitude, marker.longitude), 
    				     'bounds': true,
    				     'icon': 'images/'+  marker.icon
    		    	    }).click(function() {
    				        $('#map_canvas').gmap('openInfoWindow', { 'content': marker.content }, this);
    		    	    });
    	    	    });*/
            }
        });
    };
        
        $(".navbar-form").submit(ajaxSubmit);
    })
    </script>
    <div id="ptest"></div>
        
    </div>
  </body>
</html>