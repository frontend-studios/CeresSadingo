<?php

namespace CeresSadingo\Containers;

use Plenty\Plugin\Templates\Twig;

class CeresItemListContainer1
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('CeresSadingo::Containers.ItemLists.ItemList1', ["item" => $arg[0]]);
    }
}
