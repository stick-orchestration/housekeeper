<?php

namespace Tests;

use Stick\Housekeeper\Jack;
use Stick\Service\MetadataObject;

class JackTest extends \PHPUnit\Framework\TestCase
{
    public function testSave()
    {
        $jack = new Jack(new TestBackend());

        $fooService = new FooService();
        $barService = new BarService();

        $barGrantforFoo = $fooService->addObject($barService);
        $fooGrantforBar = $barService->addObject($fooService);

        $jack->saveEntity('grant', 'foo_bar', $barGrantforFoo);
        $jack->saveEntity('grant', 'bar_foo', $fooGrantforBar);
        $jack->saveEntity('foo', 'foo', $fooService);
        $jack->saveEntity('bar', 'bar', $barService);

        $jack->associate('foo', FooService::class);
        $jack->associate('bar', BarService::class);
        $jack->associate('grant', TestGrant::class);
        $jack->associate('metadata', MetadataObject::class);

        $this->assertEquals($jack->getEntity('bar', 'bar'), $barService);
        $this->assertEquals($jack->getEntity('foo', 'foo'), $fooService);
        $this->assertEquals($jack->getEntity('grant', 'foo_bar'), $barGrantforFoo);
        $this->assertEquals($jack->getEntity('grant', 'bar_foo'), $fooGrantforBar);
    }
}
