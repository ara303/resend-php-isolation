<?php

declare(strict_types=1);

$finder = Isolated\Symfony\Component\Finder\Finder::class;

return array(
	'prefix'             => 'ScoperTest',
	'output-dir'         => 'vendor-prefixed',
	'finders'            => [
        $finder::create()
            ->files()
            ->ignoreVCS(true)
            ->notName('/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock/')
            ->exclude([
                'doc',
                'test',
                'test_old',
                'tests',
                'Tests',
                'vendor-bin',
            ])
            ->in('vendor')
    ]
);