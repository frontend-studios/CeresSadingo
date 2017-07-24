<?php

namespace CeresSadingo\Providers;

use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

class CeresSadingoServiceProvider extends ServiceProvider
{
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

		// footer view
		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			 $partial->set('footer', 'CeresSadingo::content.Footer');
		}, 0);
		return false;

  }
}
