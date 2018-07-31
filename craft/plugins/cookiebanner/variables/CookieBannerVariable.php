<?php
/**
 * Cookie banner plugin for Craft CMS
 *
 * Cookie banner Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    Statik
 * @copyright Copyright (c) 2018 Statik
 * @link      https://www.statik.be
 * @package   CookieBanner
 * @since     1.0.0
 */

namespace Craft;

class CookieBannerVariable {
	/**
	 * Whatever you want to output to a Twig template can go into a Variable method. You can have as many variable
	 * functions as you want.  From any Twig template, call it like this:
	 *
	 *     {{ craft.cookieBanner.exampleVariable }}
	 *
	 * Or, if your variable requires input from Twig:
	 *
	 *     {{ craft.cookieBanner.exampleVariable(twigValue) }}
	 */
	public function render() {
		Craft()->templates->setTemplateMode( TemplateMode::CP );

		echo Craft()->templates->render( 'Cookiebanner/banner' );
		echo Craft()->templates->render( 'Cookiebanner/modal' );
		Craft()->templates->includeCssResource('cookiebanner/cookiebanner.css', false);
		Craft()->templates->includeJsResource('cookiebanner/cookiebanner.js', false);
	}
}