<?php
class SConfig{
    public $_namaApp = "Silihay";
    public $lf_zoom = 13;
    public $lf_zoom2 = 12;
    public $lf_lat = '-0.712412';
    public $lf_lon = '119.975704';

    function is_active($a, $b){
        if($a == $b){
            echo "active";
        }
    }
}