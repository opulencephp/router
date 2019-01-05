<?php

/*
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2019 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */

namespace Opulence\Routing;

use Opulence\Routing\Matchers\Constraints\IRouteConstraint;
use Opulence\Routing\Middleware\MiddlewareBinding;
use Opulence\Routing\UriTemplates\UriTemplate;

/**
 * Defines a route
 */
class Route
{
    /** @var UriTemplate The raw URI template */
    public $uriTemplate;
    /** @var RouteAction The action in the route */
    public $action;
    /** @var IRouteConstraint[] The list of constraints on this route */
    public $constraints;
    /** @var MiddlewareBinding[] The list of middleware bindings */
    public $middlewareBindings;
    /** @var string|null The name of the route */
    public $name;
    /** @var array The mapping of attribute names to values */
    public $attributes;

    /**
     * @param UriTemplate $uriTemplate The raw URI template
     * @param RouteAction $action The action this route takes
     * @param IRouteConstraint[] $constraints The list of constraints
     * @param MiddlewareBinding[] $middlewareBindings The list of middleware bindings
     * @param string|null $name The name of this route
     * @param array $attributes The mapping of custom attribute names => values
     */
    public function __construct(
        UriTemplate $uriTemplate,
        RouteAction $action,
        array $constraints,
        array $middlewareBindings = [],
        string $name = null,
        array $attributes = []
    ) {
        $this->uriTemplate = $uriTemplate;
        $this->action = $action;
        $this->constraints = $constraints;
        $this->middlewareBindings = $middlewareBindings;
        $this->name = $name;
        $this->attributes = $attributes;
    }

    /**
     * Performs a deep clone of object properties
     */
    public function __clone()
    {
        $this->action = clone $this->action;
        $this->uriTemplate = clone $this->uriTemplate;
    }
}