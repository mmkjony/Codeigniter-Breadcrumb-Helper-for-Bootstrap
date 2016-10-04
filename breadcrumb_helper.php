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

if ( !function_exists( 'ci_breadcrumb' ) )
{
    function ci_breadcrumb( $initial_crumb = FALSE, $initial_crumb_url = FALSE, $initial_crumb_icon = FALSE )
    {
        $ci = &get_instance();

        $open_tag = '<ul class="breadcrumb">';
        $close_tag = '</ul>';
        $crumb_open_tag = '<li>';
        $active_crumb_open_tag = '<li class="active">';
        $crumb_close_tag = '</li>';

        $total_segments = $ci->uri->total_segments();

        $breadcrumbs = $open_tag;

        if ( $initial_crumb ) {
            $breadcrumbs .= $crumb_open_tag;
            $breadcrumbs .= ci_breadcrumb_href( $initial_crumb, $initial_crumb_url, TRUE, TRUE, $initial_crumb_icon );
        }

        $segment = '';
        $crumb_href = '';

        for ( $i = 1; $i <= $total_segments; $i++ )
        {
            $segment = $ci->uri->segment( $i );
            $crumb_href .= $ci->uri->segment( $i ) . '/';

            if( $total_segments > $i )
            {
                $breadcrumbs .= $crumb_open_tag;
                $breadcrumbs .= ci_breadcrumb_href( $segment, $crumb_href );
            } else
            {
                $breadcrumbs .= $active_crumb_open_tag;
                $breadcrumbs .= ci_breadcrumb_href( $segment, $crumb_href, FALSE, FALSE );
            }
            $breadcrumbs .= $crumb_close_tag;
        }
        $breadcrumbs .= $close_tag;

        return $breadcrumbs;
    }
}

if ( !function_exists( 'ci_breadcrumb_href' ) )
{
    function ci_breadcrumb_href( $uri_segment, $crumb_href = FALSE, $initial = FALSE, $active_link = TRUE, $crumb_icon = FALSE )     {
        $ci = &get_instance();

        $crumb_href = rtrim( $crumb_href, '/' );

        if( $active_link )
        {
            if( $initial )
            {
                return ( $crumb_icon ? '<span class="'.$crumb_icon.'"></span> ' : '' ) . '<a href="' . ( $crumb_href ? $crumb_href : site_url() ) . '">' . ucwords( str_replace( array( '-', '_' ), ' ', $uri_segment ) ) . '</a>';
            } else
            {
                return ( $crumb_icon ? '<span class="'.$crumb_icon.'"></span> ' : '' ) . '<a href="' . site_url( $crumb_href ) . '">' . ucwords( str_replace( array( '-', '_' ), ' ', $uri_segment ) ) . '</a>';
            }
        } else
        {
            return ( $crumb_icon ? '<span class="'.$crumb_icon.'"></span> ' : '' ) . ucwords( str_replace( array( '-', '_' ), ' ', $uri_segment ) );
        }
    }
}
/* End of breadcrumb_helper.php */
