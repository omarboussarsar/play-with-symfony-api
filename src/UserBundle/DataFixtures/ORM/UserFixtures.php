<?php

namespace UserBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

/**
 * Description of UserFixtures
 *
 * @author omar
 */
class UserFixtures extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/user.yml'
        ];
    }
}
