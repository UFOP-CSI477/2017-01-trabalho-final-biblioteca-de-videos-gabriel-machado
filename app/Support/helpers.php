<?php

if (!function_exists('classActivePath')) {
    function classActivePath($path, $fullpath=true)
    {
        $path = explode('/', $path);
        $buf = '';
        for($seg=1; $seg<count($path); $seg++) {
            if(request()->segment($seg) != $path[$seg]) {
                return '';
            }
            $buf = $buf . $path[$seg];
        }
        if ($fullpath and request()->segment($seg) != '') {
            return '';
        }
        return ' class="active"';
    }
}

if (!function_exists('navItem')) {
    function navItem($text,$path)
    {
        return '<li' . classActivePath($path, false) . '><a href="' . url($path) . '">' . $text . '</a></li>';
    }
}

if (!function_exists('menuItem')) {
    function menuItem($text,$path)
    {
        return '<li' . classActivePath($path) . '><a href="' . url($path) . '">' . $text . '</a></li>';
    }
}

if (!function_exists('filterItem')) {
    function filterItem($text,$month)
    {
        return '<a href="' . (Request::get('month') == $month ? '?month=' : '?month=' . $month) . '" class="btn month-btn ' . (Request::get('month') == $month ? 'active' : 'btn-link') . '">' . $text . '</a>';
    }
}
