<?php

/**
 * File Name: breadcrumb_helper.php
 *
 * Codeigniter Breadcrumb Helper for Bootstrap 3+
 *
 * This helper helps to create automatic breadcrumb links based on bootstrap 3+
 *
 * Link: https://github.com/mmkjony/Codeigniter-Breadcrumb-Helper-for-Bootstrap
 *
 * Written by MMK Jony [https://github.com/mmkjony/]
 *
 **/

if (!function_exists('ci_breadcrumb'))
{
    function ci_breadcrumb($initial_crumb = '', $initial_crumb_url = '')
    {
        $ci = &get_instance();

        $open_tag = '<ol class="breadcrumb">';
        $close_tag = '</ol>';
        $crumb_open_tag = '<li>';
        $active_crumb_open_tag = '<li class="active">';
        $crumb_close_tag = '</li>';

        $total_segments = $ci->uri->total_segments();

        $breadcrumbs = $open_tag;

        if ($initial_crumb != '') {
            $breadcrumbs .= $crumb_open_tag;
            $breadcrumbs .= ci_breadcrumb_href($initial_crumb, false, true);
        }

        $segment = '';
        $crumb_href = '';

        for ($i = 1; $i <= $total_segments; $i++)
        {
            $segment = $ci->uri->segment($i);
            $crumb_href .= $ci->uri->segment($i) . '/';

            if ($total_segments > $i)
            {
                $breadcrumbs .= $crumb_open_tag;
                $breadcrumbs .= ci_breadcrumb_href($segment, $crumb_href);
            }else
            {
                $breadcrumbs .= $active_crumb_open_tag;
                $breadcrumbs .= ci_breadcrumb_href($segment, $crumb_href, false, false);
            }
            $breadcrumbs .= $crumb_close_tag;
        }
        $breadcrumbs .= $close_tag;

        return $breadcrumbs;
    }
}

if (!function_exists('ci_breadcrumb_href'))
{
    function ci_breadcrumb_href($uri_segment, $crumb_href = false, $initial = false, $active_link = true)     {
        $ci = &get_instance();
        $base_url = $ci->config->base_url();

        $crumb_href = rtrim($crumb_href, '/');

        if($active_link)
        {
            if($initial)
            {
                return '<a href="' . $base_url . '">' . strtolower(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
            }else
            {
                return '<a href="' . $base_url . $crumb_href . '">' . strtolower(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
            }
        }else
        {
            return strtolower(str_replace(array('-', '_'), ' ', $uri_segment));
        }
    }
}
/* End of breadcrumb_helper.php */
