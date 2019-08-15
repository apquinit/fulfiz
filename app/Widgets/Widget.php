<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

abstract class Widget extends AbstractWidget
{
    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
