<?php

namespace Tests;


use Stick\Service\ActionCallMethodTrait;
use Stick\Service\Entities\ServiceEntity;
use Stick\Service\GrantInterface;
use Stick\Service\ServiceInterface;

/**
 * Class FooService
 * @package Tests
 */
class FooService extends ServiceEntity
{
    use ActionCallMethodTrait;

    /**
     * @param ServiceInterface $applicant
     * @return GrantInterface
     */
    public function addObject(ServiceInterface $applicant) : GrantInterface
    {
        $grant = new TestGrant();
        $grant->setApplicant($applicant);
        $grant->setSupplicant($this);
        $grant->setData(['user' => "joe"]);
        return $grant;
    }

    /**
     * @param GrantInterface $object
     */
    public function removeObject(GrantInterface $object) : void
    {
        return;
    }
}
