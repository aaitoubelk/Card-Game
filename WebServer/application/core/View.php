<?php
class View
{
    public static $view_404 = '404_view.php';

    public $viewBag = ["errors" => []];

    function render($content_view, $template_view,  $data = null)
    {
        include 'application/views/' . $template_view;
    }


    static function generate_404()
    {
        include 'application/views/' . self::$view_404;
    }
}
