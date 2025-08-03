<?php

namespace App\Helpers;

class AssetHelper
{
    /**
     * Get the appropriate CSS asset URL
     *
     * @param string $asset
     * @return string
     */
    public static function css($asset = 'bootstrap')
    {
        $config = config('assets');
        
        if ($config['offline_mode'] && file_exists(public_path($config['local_assets']['css'][$asset]))) {
            return asset($config['local_assets']['css'][$asset]);
        }
        
        return $config['fallback_cdn']['bootstrap_css'];
    }

    /**
     * Get the appropriate JS asset URL
     *
     * @param string $asset
     * @return string
     */
    public static function js($asset = 'bootstrap')
    {
        $config = config('assets');
        
        if ($config['offline_mode'] && file_exists(public_path($config['local_assets']['js'][$asset]))) {
            return asset($config['local_assets']['js'][$asset]);
        }
        
        return $config['fallback_cdn']['bootstrap_js'];
    }

    /**
     * Check if local assets are available
     *
     * @return bool
     */
    public static function hasLocalAssets()
    {
        $config = config('assets');
        $cssExists = file_exists(public_path($config['local_assets']['css']['bootstrap']));
        $jsExists = file_exists(public_path($config['local_assets']['js']['bootstrap']));
        
        return $cssExists && $jsExists;
    }
} 