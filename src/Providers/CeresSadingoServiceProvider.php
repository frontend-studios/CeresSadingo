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

	const EVENT_LISTENER_PRIORITY = 99;

    private static $templateKeyToViewMap = [
        'tpl.home'               => 'Homepage.Homepage',                // provide template to use for homepage
        'tpl.category.content'   => 'Category.Content.CategoryContent', // provide template to use for content categories
        'tpl.category.item'      => 'Category.Item.CategoryItem',       // provide template to use for item categories
        'tpl.category.blog'      => 'PageDesign.PageDesign',            // provide template to use for blog categories
        'tpl.category.container' => 'PageDesign.PageDesign',            // provide template to use for container categories
        'tpl.item'               => 'Item.SingleItem',                  // provide template to use for single items
        'tpl.basket'             => 'Basket.Basket',                    // provide template to use for basket
        'tpl.checkout'           => 'Checkout.Checkout',                // provide template to use for checkout
        'tpl.my-account'         => 'MyAccount.MyAccount',              // provide template to use for my-account
        'tpl.confirmation'       => 'Checkout.OrderConfirmation',       // provide template to use for confirmation
        'tpl.login'              => 'Customer.Login',                   // provide template to use for login
        'tpl.register'           => 'Customer.Register',                // provide template to use for register
        'tpl.guest'              => 'Customer.Guest',                   // provide template to use for guest
        'tpl.password-reset'     => 'Customer.ResetPassword',           // provide template to use for password-reset
        'tpl.contact'            => 'Customer.Contact',                 // provide template to use for contact
        'tpl.search'             => 'ItemList.ItemListView',            // provide template to use for item search
        'tpl.wish-list'          => 'WishList.WishListView',            // provide template to use for wishlist
        'tpl.order.return'       => 'OrderReturn.OrderReturnView',      // provide template to use for order return
        'tpl.cancellation-rights'=> 'StaticPages.CancellationRights',   // provide template to use for cancellation rights
        'tpl.legal-disclosure'   => 'StaticPages.LegalDisclosure',      // provide template to use for legal disclosure
        'tpl.privacy-policy'     => 'StaticPages.PrivacyPolicy',        // provide template to use for privacy policy
        'tpl.terms-conditions'   => 'StaticPages.TermsAndConditions',   // provide template to use for terms and conditions
        'tpl.item-not-found'     => 'StaticPages.ItemNotFound',         // provide template to use for item not found
        'tpl.page-not-found'     => 'StaticPages.PageNotFound'          // provide template to use for page not found
    ];

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

		return false;
  }
}
