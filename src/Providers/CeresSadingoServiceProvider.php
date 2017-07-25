<?php

namespace CeresSadingo\Providers;

use Ceres\Caching\HomepageCacheSettings;
use Ceres\Caching\NavigationCacheSettings;
use Ceres\Caching\SideNavigationCacheSettings;
use IO\Extensions\Functions\Partial;
use IO\Helper\CategoryKey;
use IO\Helper\CategoryMap;
use IO\Helper\TemplateContainer;
use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ConfigRepository;

class CeresSadingoServiceProvider extends ServiceProvider
{

	public function register(){
	}

	public function boot (Twig $twig, Dispatcher $eventDispatcher)
  {

    // überschreibt die Startseiten View
    $eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData)
		{
        $container->setTemplate("CeresSadingo::Homepage.Homepage");
        return false;
    });

		// Überschreibt die Category View
		$eventDispatcher->listen('IO.tpl.category.item', function(TemplateContainer $container, $templateData)
		{
			$container->setTemplate('CeresSadingo::Category.Item.CategoryItem');
			return false;
		}, 0);

		// Überschreibt Ceres Views
		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			 $partial->set('header', 'CeresSadingo::PageDesign.Partials.Header.Header');
			 $partial->set('footer', 'CeresSadingo::PageDesign.Partials.Footer');
		}, 0);

		return false;
  }
}
