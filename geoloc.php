<?
    session_start();
    
    $location = 'http://maps.googleapis.com/maps/api/geocode/json?';
    $location .= $_POST['loc'];
    $location .= '&sensor=true';    
    #exit($location);
    #$location = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=true';
    
    $dets = file_get_contents($location);
    $params = json_decode($dets,TRUE);    
    
    #print_r($params);
    #print_r($params['results'][0]['address_components'][2]['long_name']);
    
    $city_param = $params['results'][0]['formatted_address'];
    $_SESSION['target_city'] = $city_param;
    $_SESSION['geoset']=TRUE;
    # if(stristr($city_param,$quiz->target_city)) // city match
?>