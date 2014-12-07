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
            <form id="homeform" name="homeform" action="http://thilina227.koding.io//hackathon.IOsalli/service/service.php" method="POST" class="navbar-form" role="search">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="checkbox">
                       <input name="LS" value="LS" type="checkbox"> Landslide
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                      <input name="TC" value="TC" type="checkbox"> Cyclone
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                      <input name="FL" value="FL" type="checkbox"/> Flood
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                      <input name="TS" value="TS" type="checkbox"/> Tsunami
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                      <input name="EQ" value="EQ" type="checkbox"/> Earthquake 
                  </div>
                </li>
                 <li class="list-group-item">
                  <div class="checkbox">
                      <input name="country" placeHolder="Country" type="text" />
                  </div>
                </li>
                <li class="list-group-item">
                  <input name="from" type=date step=7 min="1800-01-01" /> : From
                </li>
                <li class="list-group-item">
                  <input name="to" type=date step=7 min="1800-01-01"/> : To
                </li>
                <li class="list-group-item">
                  <button id="btnhome" type="button" class="btn btn-default">Search <span class="glyphicon glyphicon-search"></span></button>
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
    <script src="js/test.js"></script>
    <script type="text/javascript">
    $( "#btnhome" ).click(function() {
        calltoservice();
        return false;
    });
            
    function calltoservice(){
            var postData = $("#homeform").serializeArray();
            $('#pt').append("<h2>"+postData[0].value+"</h2>");
            var formURL = "http://54.169.169.212/hackathon.IOsalli/service/service.php";
            jQuery.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: "text",
                success:function(data){
                $('#pt').append("<h2>Success</h2>");
                
                var codes = jQuery.parseJSON(data);
                $('#pt').append("<h2>Success2</h2>");
                    console.log(codes);
                    $('#pt').append("<h2>Success3</h2>");
                    $.each(codes, function (key, value) {
                      $('#pt').append("<h2>" +value.title + "</h2>");
                    });
                },
                error: function(){
                $('#pt').append("<h2>Fail</h2>");
                        //if fails      
                }
            });
    }
    </script>
    <div id="pt">ppppp</div>
  </body>
</html>