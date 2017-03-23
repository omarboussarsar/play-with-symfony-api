<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use UserBundle\DependencyInjection\UserPass;

class UserBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        $container->addCompilerPass(new UserPass());
    }

}
