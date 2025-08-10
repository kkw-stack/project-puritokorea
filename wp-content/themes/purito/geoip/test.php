<?php
// https://github.com/maxmind/geoip-api-php/blob/master/README.md
require_once($_SERVER['DOCUMENT_ROOT'].'/geoip.inc');

// http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz
$gi = geoip_open($_SERVER['DOCUMENT_ROOT'].'/GeoIP.dat',GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];


echo geoip_country_code_by_addr($gi, $ip) ;
echo '<br />';
echo geoip_country_name_by_addr($gi, $ip);

geoip_close($gi);
