<?php

namespace ThemeSadingo\Containers;

use Plenty\Plugin\Templates\Twig;

class ThemeSadingoContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('ThemeSadingo::ThemeSadingo');
    }
}
