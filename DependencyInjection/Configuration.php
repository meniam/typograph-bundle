<?php

namespace TypographBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('typograph');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('typograph');
        }

        $rootNode
            ->children()
                ->arrayNode('configs')
                    ->useAttributeAsKey('name')

                    ->prototype('array')
                        ->useAttributeAsKey('name')
                        ->prototype('variable')->end()
                    ->end()

                    ->defaultValue(array(
                        'default' => array(
                            'Text.paragraphs'           => 'off',
                            'Text.breakline'            => 'off',
                            'Text.auto_links'           => 'off',
                            'Text.email'                => 'off',
                            'OptAlign.oa_oquote'        => 'off',
                            'OptAlign.oa_obracket_coma' => 'off'
                        )
                    ))
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
