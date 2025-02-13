<?php

namespace Sherpa\Sherpa\test\simple;

use Sherpa\Test\core\SherpaTest;
use Sherpa\Test\core\Test;

class SimpleTest extends Test
{

    public ?string $name = "Simple Test!";
    public ?string $description
        = "This is a simple test for helping to develop Sherpa Test";

    #[SherpaTest]
    public function myFirstTest(): void
    {
        success();
        fail();
    }

    #[SherpaTest]
    public function mySecondTest(): void
    {
        dump("second test");
    }


    public function startup(): void
    {
    }

    public function beforeEachTest(): void
    {
    }

    public function afterEachTest(): void
    {
    }

    public function end(): void
    {
    }
}