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
                     <label>
                       <input value="LS" type="checkbox"> Landslide
                     </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="TC" type="checkbox"> Cyclone
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="FL" type="checkbox"/> Flood
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="TS" type="checkbox"/> Tsunami
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input value="EQ" type="checkbox"/> Earthquake 
                    </label>
                  </div>
                </li>
                 <li class="list-group-item">
                  <div class="checkbox">
                    <label>
                      <input name="country" placeHolder="Country" type="text" />
                    </label>
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
        // $("#homeform").submit(function(e){
            var postData = $(this).serializeArray();
            var formURL = "http://thilina227.koding.io//hackathon.IOsalli/service/service.php";
            jQuery.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data){
                $('#pt').append("<h2>Success</h2>");
                        //data: return data from server
                },
                error: function(){
                $('#pt').append("<h2>Fail</h2>");
                        //if fails      
                }
            });
            // e.preventDefault(); //STOP default action
            // e.unbind(); //unbind. to stop multiple form submit.
        // });
    }
    // $("#homeform").submit(); //Submit  the FORM
    </script>
    <div id="pt">ppppp</div>
  </body>
</html>