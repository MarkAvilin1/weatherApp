<?php

    $weather = "";
    $error = "";
   

  if ($_GET['city']) {

        $city = str_replace(' ', '', $_GET['city']);
      
        $file_headers = @get_headers('https://www.weather-forecast.com/locations/'.$city.'/forecasts/latest');
      
      if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
          
            $error = 'That city could not be found!';
        
      }else {
          
            $forcastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

            $pageArray = explode('3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forcastPage);

            $secondPageArray = explode('</span></p></td>', $pageArray[1]);

            $weather = $secondPageArray[0];   
          
      }
      
  }

?>
  
  
  
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="icon" href="https://www.hochfuegenski.com/typo3conf/ext/wc_zamgwetter/Classes/Tasks/img/C.png">

    <title>Weather Project</title>

    <style type="text/css">
    
      html {
        background: url(skyNsea.jpg) no-repeat center center fixed;
        background-size: cover;
        }

        body {
          background: none;
          text-shadow: 1px 1px 2px darkred;
        }

        h1 {
            margin-bottom: 20px;    
        }
        
        .box {
          text-align: center;
          margin-top: 120px;
          width: 450px;
        }

        .form-text {
          text-shadow: 1px 1px 2px darkred;
          width: 300px;
          border-radius: 5px;
          text-align: center;
          margin: 0 auto;
          color: white;
        }
        
        .btn {
          width: max-content;
          font-size: large;
          font-weight: bold;
          text-shadow: 1px 1px 2px black;
          border-radius: 5px;
          box-shadow: 1px 1px 1px darkred ;
        }

        #city {
          margin: 5px auto 30px auto;
        }
        
        .weather {
          clear: both;
          margin: 20px auto; 
          text-align: center; 
          width: 500px;       
        }
    
    </style>

  </head>
  <body>


    <div class="container box">
      
      <h1>What's The Weather?</h1>

      <form>
        <div class="form-group">
          <label for="city">Enter The City Name...</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Moscow, Tokyo">
        </div>
        
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
        
    </div>

    <div class="container weather">
        <div id="weather">
          <?php

            if ($weather) {

                echo '<div class="alert alert-success" role="alert">
                    <strong>At '.ucwords($_GET["city"]).'</strong><br>'.$weather.'</div>';

            }else if ($error) {
                
                echo '<div class="alert alert-danger" role="alert"><strong>'.ucwords($_GET["city"]).'</strong><br>
                     '.$error.'</div>';

            }else {
                
                echo '';
                
            }

          ?>        
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>