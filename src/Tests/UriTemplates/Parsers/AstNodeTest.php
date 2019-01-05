<?php

/*
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2019 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */

namespace Opulence\Routing\Tests\UriTemplates\Parsers;

use Opulence\Routing\UriTemplates\Parsers\AstNode;
use Opulence\Routing\UriTemplates\Parsers\AstNodeTypes;

/**
 * Tests the abstract syntax tree node
 */
class AstNodeTest extends \PHPUnit\Framework\TestCase
{
    public function testCheckingForChildrenReturnsCorrectValue(): void
    {
        $node = new AstNode('foo', 'bar');
        $this->assertFalse($node->hasChildren());
        $node->addChild(new AstNode('baz', 'blah'));
        $this->assertTrue($node->hasChildren());
    }

    public function testGettingChildReturnsCorrectNodes(): void
    {
        $node = new AstNode('foo', 'bar');
        $child = new AstNode('baz', 'blah');
        $node->addChild($child);
        $this->assertEquals([$child], $node->children);
    }

    public function testGettingTypeReturnsCorrectValue(): void
    {
        $expectedType = AstNodeTypes::VARIABLE;
        $this->assertEquals($expectedType, (new AstNode($expectedType, 'foo'))->type);
    }

    public function testGettingValueReturnsCorrectValue(): void
    {
        $expectedValue = 'bar';
        $this->assertEquals($expectedValue, (new AstNode('foo', $expectedValue))->value);
    }

    public function testNodeIsRootOnlyIfItHasNoParent(): void
    {
        $node = new AstNode('foo', 'bar');
        $child = new AstNode('baz', 'blah');
        $node->addChild($child);
        $this->assertTrue($node->isRoot());
        $this->assertFalse($child->isRoot());
    }

    public function testParentNodeIsSetOnChildNodes(): void
    {
        $node = new AstNode('foo', 'bar');
        $child = new AstNode('baz', 'blah');
        $node->addChild($child);
        $this->assertSame($node, $child->parent);
    }
}
