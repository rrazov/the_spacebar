<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
<<<<<<< HEAD
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
=======
>>>>>>> 10add1d7033389fa9b825c826d75e2e3b872361e
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

<<<<<<< HEAD
class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
=======
class AppExtension extends AbstractExtension
{
    /**
     * @var MarkdownHelper
     */
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
>>>>>>> 10add1d7033389fa9b825c826d75e2e3b872361e
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }


    public function processMarkdown($value)
    {
<<<<<<< HEAD
        return $this->container
            ->get(MarkdownHelper::class)
            ->parse($value);
    }

    /**
     * Returns an array of service types required by such instances, optionally keyed by the service names used internally.
     *
     * For mandatory dependencies:
     *
     *  * array('logger' => 'Psr\Log\LoggerInterface') means the objects use the "logger" name
     *    internally to fetch a service which must implement Psr\Log\LoggerInterface.
     *  * array('loggers' => 'Psr\Log\LoggerInterface[]') means the objects use the "loggers" name
     *    internally to fetch an iterable of Psr\Log\LoggerInterface instances.
     *  * array('Psr\Log\LoggerInterface') is a shortcut for
     *  * array('Psr\Log\LoggerInterface' => 'Psr\Log\LoggerInterface')
     *
     * otherwise:
     *
     *  * array('logger' => '?Psr\Log\LoggerInterface') denotes an optional dependency
     *  * array('loggers' => '?Psr\Log\LoggerInterface[]') denotes an optional iterable dependency
     *  * array('?Psr\Log\LoggerInterface') is a shortcut for
     *  * array('Psr\Log\LoggerInterface' => '?Psr\Log\LoggerInterface')
     *
     * @return array The required service types, optionally keyed by service names
     */
    public static function getSubscribedServices()
    {
        return [
            MarkdownHelper::class,
        ];
=======
        return $this->markdownHelper->parse($value);
>>>>>>> 10add1d7033389fa9b825c826d75e2e3b872361e
    }
}
