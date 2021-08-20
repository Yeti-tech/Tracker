<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\bootstrap\BootstrapPluginAsset;
use rmrevin\yii\fontawesome\CdnProAssetBundle;
use yii\bootstrap\BootstrapAsset;
use yii\web\YiiAsset;
use rmrevin\yii\fontawesome\NpmProAssetBundle;
use app\assets\FontAwesomeAsset;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        'rmrevin\yii\fontawesome\CdnProAssetBundle'

    ];
}