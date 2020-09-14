<?php

namespace Tests\NewRelic;

use jmsfwk\NewRelic\NewRelic;
use PHPUnit\Framework\TestCase;

class NewRelicTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    /**
     * @test
     * @requires extension newrelic
     */
    public function run_calls_the_given_closure_when_the_newrelic_extension_is_loaded()
    {
        NewRelic::run(function () {
            $this->addToAssertionCount(1);
        });
    }

    /**
     * @test
     * @requires extension newrelic
     */
    public function run_returns_the_return_value_of_the_callback()
    {
        $result = NewRelic::run(function () {
            return true;
        });

        self::assertTrue($result);
    }

    /** @test */
    public function run_returns_false_if_the_new_relic_extension_is_not_loaded()
    {
        if (extension_loaded('newrelic')) {
            self::markTestSkipped('Extension newrelic is loaded.');
        }

        self::assertFalse(NewRelic::run(static function () {
            // Do nothing
        }));
    }
}
