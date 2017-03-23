<?php

namespace UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of UserPass
 *
 * @author omar
 */
class UserPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        if (!$container->hasDefinition('user.service_chain')) {
            return;
        }

        $definition = $container->getDefinition('user.service_chain');
        $taggedServices = $container->findTaggedServiceIds('user.service');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addService', array(
                    new Reference($id),
                    $attributes["alias"]
                ));
            }
        }
    }

}
