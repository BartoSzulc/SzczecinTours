<?php

namespace App\Setup\Environment;

class Development
{
    private $class;

    public function init()
    {
        $this->noRobotsIndex();
        $this->customResponsiveBar(); // Uncomment this line if needed
    }

    private function noRobotsIndex()
    {
        add_filter('wp_robots', 'wp_robots_no_robots');
    }

    private function customResponsiveBar()
    {
        add_filter('body_class', function ($classes) {
            $this->class = 'debug-screens';
            $classes[] = $this->class;
            return $classes;
        });
    }
}