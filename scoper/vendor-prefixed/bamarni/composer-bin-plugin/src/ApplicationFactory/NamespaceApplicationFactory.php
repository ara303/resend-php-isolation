<?php

declare (strict_types=1);
namespace ScoperTest\Bamarni\Composer\Bin\ApplicationFactory;

use ScoperTest\Composer\Console\Application;
interface NamespaceApplicationFactory
{
    public function create(Application $existingApplication): Application;
}
