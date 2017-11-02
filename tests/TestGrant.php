<?php

namespace Tests;

use Stick\Service\Entities\GrantEntity;
use Stick\Service\EntityInterface;
use Stick\Service\GrantMetadataTrait;

/**
 * Class TestGrant
 * @package Tests
 */
class TestGrant extends GrantEntity implements EntityInterface
{
    use GrantMetadataTrait;
}
