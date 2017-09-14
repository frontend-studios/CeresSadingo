<?php

namespace CeresSadingo\Providers;


use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class TopItemsRouteServiceProvider extends RouteServiceProvider
{
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
      'tpl.cancellation-rights'=> 'StaticPages.CancellationRights',   // provide template to use for cancellation rights
      'tpl.legal-disclosure'   => 'StaticPages.LegalDisclosure',      // provide template to use for legal disclosure
      'tpl.privacy-policy'     => 'StaticPages.PrivacyPolicy',        // provide template to use for privacy policy
      'tpl.terms-conditions'   => 'StaticPages.TermsAndConditions',   // provide template to use for terms and conditions
      'tpl.item-not-found'     => 'StaticPages.ItemNotFound',         // provide template to use for item not found
      'tpl.page-not-found'     => 'StaticPages.PageNotFound'          // provide template to use for page not found
  ];

    public function map(Router $router)
    {
        $router->get('tpl.home', 'CeresSadingo\Controllers\ContentController@showTopItems');
    }
}
