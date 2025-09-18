<?php

if (!function_exists('admin_url')) {
    /**
     * Generate admin URL
     * 
     * @param string $path
     * @return string
     */
    function admin_url($path = '') {
        return base_url('admin/' . ltrim($path, '/'));
    }
}

if (!function_exists('admin_asset')) {
    /**
     * Generate admin asset URL
     * 
     * @param string $path
     * @return string
     */
    function admin_asset($path = '') {
        return base_url('assets/admin/' . ltrim($path, '/'));
    }
}

if (!function_exists('is_active_menu')) {
    /**
     * Check if current route matches menu
     * 
     * @param string|array $route
     * @param string $class
     * @return string
     */
    function is_active_menu($route, $class = 'active') {
        $currentRoute = uri_string();
        
        if (is_array($route)) {
            foreach ($route as $r) {
                if (strpos($currentRoute, $r) !== false) {
                    return $class;
                }
            }
            return '';
        }
        
        return strpos($currentRoute, $route) !== false ? $class : '';
    }
}

if (!function_exists('current_user')) {
    /**
     * Get current logged in user data
     * 
     * @param string|null $key
     * @return mixed
     */
    function current_user($key = null) {
        if ($key) {
            return session()->get($key);
        }
        
        return [
            'id' => session()->get('user_id'),
            'username' => session()->get('username'),
            'email' => session()->get('email'),
            'login_time' => session()->get('login_time')
        ];
    }
}

if (!function_exists('format_currency')) {
    /**
     * Format number as Indonesian currency
     * 
     * @param int|float $amount
     * @return string
     */
    function format_currency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('format_date')) {
    /**
     * Format date to Indonesian format
     * 
     * @param string $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'd/m/Y') {
        if (!$date) return '-';
        return date($format, strtotime($date));
    }
}

if (!function_exists('format_datetime')) {
    /**
     * Format datetime to Indonesian format
     * 
     * @param string $datetime
     * @return string
     */
    function format_datetime($datetime) {
        if (!$datetime) return '-';
        return date('d/m/Y H:i', strtotime($datetime));
    }
}

if (!function_exists('time_ago')) {
    /**
     * Get time ago format
     * 
     * @param string $datetime
     * @return string
     */
    function time_ago($datetime) {
        if (!$datetime) return '-';
        
        $time = time() - strtotime($datetime);
        
        if ($time < 60) return 'Baru saja';
        if ($time < 3600) return floor($time/60) . ' menit yang lalu';
        if ($time < 86400) return floor($time/3600) . ' jam yang lalu';
        if ($time < 2592000) return floor($time/86400) . ' hari yang lalu';
        if ($time < 31536000) return floor($time/2592000) . ' bulan yang lalu';
        
        return floor($time/31536000) . ' tahun yang lalu';
    }
}

if (!function_exists('generate_breadcrumb')) {
    /**
     * Generate breadcrumb array
     * 
     * @param array $items
     * @return array
     */
    function generate_breadcrumb($items = []) {
        $breadcrumb = [
            ['title' => 'Dashboard', 'url' => admin_url()]
        ];
        
        foreach ($items as $item) {
            $breadcrumb[] = $item;
        }
        
        return $breadcrumb;
    }
}