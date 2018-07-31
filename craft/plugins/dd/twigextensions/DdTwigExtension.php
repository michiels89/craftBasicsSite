<?php
namespace Craft;

class DdTwigExtension extends \Twig_Extension
{
    protected $env;

    public function getName()
    {
        return 'DD Twig Extension';
    }

    public function getFunctions()
    {
        return array(
            'd'    => new \Twig_Function_Method($this, 'd'),
            'dd'   => new \Twig_Function_Method($this, 'dd'),
            );
    }

    public function initRuntime(\Twig_Environment $env)
    {
        $this->env = $env;
    }

    public function d($debug)
    {
        return craft()->dd->d($debug);
    }

    public function dd($debug)
    {
        return craft()->dd->dd($debug);
    }


}
