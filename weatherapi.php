<?php
if(isset($_POST['submitBtn'])){
    $key=  "db82586bad5a4090b59105847230607";
    $city = $_POST['search'];
    $aqi = 'Yes';
    // $url = "https://api.weatherapi.com/v1/current.json?key=$key&q=$city&aqi=$aqi";
    $api_url="https://api.weatherapi.com/v1/current.json?key=$key&q=$city&aqi=$aqi";
    $curl = curl_init();
    //set options for the transfer
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    //execute the session
    $curl_response = curl_exec($curl);
    //finish off the session
    curl_close($curl);
    $weatherData = json_decode($curl_response, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body{
            background-color: #deedf5;
        }
        .card{
            --bs-card-bg: #f8f9faa3;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-4">
    <?php if(isset($weatherData)){?>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4">

                <div class="card" style="color: #4B515D; border-radius: 35px;">
                <div class="card-body p-4">

                    <div class="d-flex">
                        <h6 class="flex-grow-1"><?=$weatherData['location']['name'];?></h6>
                        <h6><?=date('H:m:s',strtotime($weatherData['location']['localtime']));?></h6>
                    </div>
                    <div class="d-flex">
                        <h6 class="flex-grow-1"><?=$weatherData['location']['region'];?></h6>
                        <h6><?=$weatherData['location']['country'];?></h6>
                    </div>

                    <div class="d-flex flex-column text-center mt-5 mb-4">
                    <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;"> <?=$weatherData['current']['temp_c'];?>°C </h6>
                    <span class="small" style="color: #868B94"><?=$weatherData['location']['localtime'];?></span>
                    </div>

                    <div class="d-flex align-items-center">
                    <div class="flex-grow-1" style="font-size: 1rem;">
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1">Wind P/Km: <?=$weatherData['current']['wind_kph'];?> km/h
                        </span></div>
                        <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> <span class="ms-1">Humidity: <?=$weatherData['current']['humidity'];?>% </span>
                        </div>
                    </div>
                    <div>
                        <img src="<?=$weatherData['current']['condition']['icon'];?>"
                        width="100px">
                    </div>
                    </div>

                </div>
                </div>

            </div>
        </div>
        <?php }?>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col col-lg-6 col-md-6">
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="submitBtn" type="submit">Search</button>
                </form>
            </div>
            <div class="col col-md-3 col-lg-3 col-sm-3"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>