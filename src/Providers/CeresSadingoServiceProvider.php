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
	private static $templateKeyToViewMap = [
		'tpl.category.content'   => 'Category.Content.CategoryContent', // provide template to use for content categories
		'tpl.category.item'      => 'Category.Item.CategoryItem',       // provide template to use for item categories
		'tpl.category.blog'      => 'PageDesign.PageDesign',            // provide template to use for blog categories
		'tpl.category.container' => 'PageDesign.PageDesign'            // provide template to use for container categories
	];
	/**
	 * Register the service provider.
	 */
	public function register(){
	}

	public function boot (Twig $twig, Dispatcher $eventDispatcher)
  {
    // provide template to use for homepage
    $eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData) {
        $container->setTemplate("CeresSadingo::Homepage.Homepage");
        return false;
    });

		// provide mapped category IDs - DEPRECATED?
		$eventDispatcher->listen('init.categories', function (CategoryMap $categoryMap) use (&$config) {
			$categoryMap->setCategoryMap(array(
					CategoryKey::HOME => $config->get("CeresSadingo.global.category.home"),
					CategoryKey::PAGE_NOT_FOUND => $config->get("CeresSadingo.global.category.page_not_found"),
					CategoryKey::ITEM_NOT_FOUND => $config->get("CeresSadingo.global.category.item_not_found")
			));

		}, self::EVENT_LISTENER_PRIORITY);

		// footer view
		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			 $partial->set('header', 'CeresSadingo::PageDesign.Partials.Header.Header');
			 $partial->set('footer', 'CeresSadingo::PageDesign.Partials.Footer');
		}, 0);
		return false;

  }
}
