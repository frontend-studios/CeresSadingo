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
use IO\Helper\ComponentContainer;

class CeresSadingoServiceProvider extends ServiceProvider
{

	const EVENT_LISTENER_PRIORITY = 99;
    /**
     * Register the service provider.
     */

    public function register() {
         
    }

	public function boot(Twig $twig, Dispatcher $eventDispatcher, ConfigRepository $config)
  	{
    // überschreibt die Startseiten View
    $eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData)
		{
        $container->setTemplate("CeresSadingo::Homepage.Homepage");
        return false;
    	});

		// überschreibt das Basket Templates
		$eventDispatcher->listen('IO.tpl.basket', function(TemplateContainer $container, $templateData)
		{
				$container->setTemplate("CeresSadingo::Basket.Basket");
				return false;
		});

		// überschreibt das Search Templates
		$eventDispatcher->listen('IO.tpl.search', function(TemplateContainer $container, $templateData)
		{
				$container->setTemplate("CeresSadingo::ItemList.ItemListView");
				return false;
		});

		// Überschreibt die Category View
		$eventDispatcher->listen('IO.tpl.category.item', function(TemplateContainer $container, $templateData)
		{
			$container->setTemplate('CeresSadingo::Category.Item.CategoryItem');
			return false;
		}, 0);

		// Überschreibt die Item View
		// $eventDispatcher->listen('IO.tpl.item', function(TemplateContainer $container, $templateData)
		// {
		// 	$container->setTemplate('CeresSadingo::Item.SingleItem');
		// 	return false;
		// }, 0);

		// Überschreibt Ceres Views
		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			pluginApp(Container::class)->register('CeresSadingo::PageDesign.Partials.Header.NavigationList.twig', NavigationCacheSettings::class);
			pluginApp(Container::class)->register('CeresSadingo::PageDesign.Partials.Header.SideNavigation.twig', SideNavigationCacheSettings::class);

			 $partial->set('header', 'CeresSadingo::PageDesign.Partials.Header.Header');
			 $partial->set('footer', 'CeresSadingo::PageDesign.Partials.Footer');
			 $partial->set('page-design', 'CeresSadingo::PageDesign.PageDesign');
		}, self::EVENT_LISTENER_PRIORITY);

		$eventDispatcher->listen('IO.Component.Import', function (ComponentContainer $container)
        {   
			if($componentContainer->getOriginComponentTemplate() == 'Ceres::ItemList.Components.CategoryItem') 
            {
                    $componentContainer->setNewComponentTemplate('CeresSadingo::ItemList.Components.CategoryItem');
            }   
            if($container->getOriginComponentTemplate() == 'Ceres::Item.Components.SingleItem') 
            {
                $container->setNewComponentTemplate('CeresSadingo::Item.Components.SingleItem');
            }
        }, self::EVENT_LISTENER_PRIORITY);
  }
}
