<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/styles.css',
    ];
    public $js = [
        "js/jarallax.js",
        "js/script.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];


    public function init()
    {
        parent::init();

        if (Yii::$app->requestedAction->id == "contact") {
            array_push($this->js, 'js/map.js');
            array_push($this->js, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjP9XGLjp_EtNfBordcEjjRyqUOF5od6o&signed_in=true&libraries=places&callback=initMap');
        }
    }

}
