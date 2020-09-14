<?php

namespace jmsfwk\NewRelic;

use Closure;

class NewRelic
{
    /**
     * Call the closure if the New Relic extension is loaded
     */
    public static function run(Closure $callback)
    {
        if (extension_loaded('newrelic')) {
            return $callback();
        }

        return false;
    }

    /**
     * Attaches a custom attribute (key/value pair) to the current transaction and the current span (if enabled).
     *
     * @see newrelic_add_custom_parameter()
     */
    public static function addCustomParameter(string $key, $value): bool
    {
        return self::run(static function () use ($key, $value) {
            return newrelic_add_custom_parameter($key, $value);
        });
    }

    /**
     * Specify functions or methods for the agent to instrument with custom instrumentation.
     *
     * @see newrelic_add_custom_tracer()
     */
    public static function addCustomTracer(string $functionName): bool
    {
        return self::run(static function () use ($functionName) {
            return newrelic_add_custom_tracer($functionName);
        });
    }

    /**
     * Manually specify that a transaction is a background job or a web transaction.
     *
     * @see newrelic_background_job()
     */
    public static function backgroundJob(bool $flag = true): void
    {
        self::run(static function () use ($flag) {
            newrelic_background_job($flag);
        });
    }

    /**
     * Enable or disable the capture of URL parameters.
     *
     * @see newrelic_capture_params()
     */
    public static function captureParams(bool $flag = true): void
    {
        self::run(static function () use ($flag) {
            newrelic_capture_params($flag);
        });
    }

    /**
     * Add a custom metric (in milliseconds) to time a component of your app not captured by default.
     *
     * @see newrelic_custom_metric()
     */
    public static function customMetric(string $name, float $value): bool
    {
        return self::run(static function () use ($name, $value) {
            return newrelic_custom_metric($name, $value);
        });
    }

    /**
     * Disable automatic injection of the browser monitoring snippet on particular pages.
     *
     * @see newrelic_disable_autorum()
     */
    public static function disableAutoRUM(): void
    {
        self::run(static function () {
            newrelic_disable_autorum();
        });
    }

    /**
     * Stop timing the current transaction, but continue instrumenting it.
     *
     * @see newrelic_end_of_transaction()
     */
    public static function endOfTransaction(): void
    {
        self::run(static function () {
            newrelic_end_of_transaction();
        });
    }

    /**
     * Stop instrumenting the current transaction immediately.
     *
     * @see newrelic_end_transaction()
     */
    public static function endTransaction(bool $ignore = false): void
    {
        self::run(static function () use ($ignore) {
            newrelic_end_transaction($ignore);
        });
    }

    /**
     * Returns a browser monitoring snippet to inject at the end of the HTML output.
     *
     * @see newrelic_get_browser_timing_footer()
     */
    public static function getBrowserTimingFooter(bool $includeTags = true): string
    {
        return (string)self::run(static function () use ($includeTags) {
            return newrelic_get_browser_timing_footer($includeTags);
        });
    }

    /**
     * Returns a browser monitoring snippet to inject in the head of your HTML output.
     *
     * @see newrelic_get_browser_timing_header()
     */
    public static function getBrowserTimingHeader(bool $includeTags = true): string
    {
        return (string)self::run(static function () use ($includeTags) {
            return newrelic_get_browser_timing_header($includeTags);
        });
    }

    /**
     * Ignore the current transaction when calculating Apdex.
     *
     * @see newrelic_ignore_apdex()
     */
    public static function ignoreApdex(): void
    {
        self::run(static function () {
            newrelic_ignore_apdex();
        });
    }

    /**
     * Do not instrument the current transaction.
     *
     * @see newrelic_ignore_transaction()
     */
    public static function ignoreTransaction(): void
    {
        self::run(static function () {
            newrelic_ignore_transaction();
        });
    }

    /**
     * Set custom name for current transaction.
     *
     * @see newrelic_name_transaction()
     */
    public static function nameTransaction(string $name): void
    {
        self::run(static function () use ($name) {
            newrelic_name_transaction($name);
        });
    }

    /**
     * Collect errors that the PHP agent does not collect automatically.
     *
     * @see newrelic_notice_error()
     */
    public static function noticeError($error): void
    {
        self::run(static function () use ($error) {
            newrelic_notice_error($error);
        });
    }

    /**
     * Record a custom event with the given name and attributes.
     *
     * @see newrelic_record_custom_event()
     */
    public static function recordCustomEvent(string $name, array $attributes): void
    {
        self::run(static function () use ($name, $attributes) {
            newrelic_record_custom_event($name, $attributes);
        });
    }

    /**
     * Sets the New Relic app name, which controls data rollup.
     *
     * @see newrelic_set_appname()
     */
    public static function setAppName(string $name, string $license = null, bool $xmit = false): bool
    {
        return self::run(static function () use ($name, $license, $xmit) {
            return newrelic_set_appname($name, $license, $xmit);
        });
    }

    /**
     * Create user-related custom attributes.
     *
     * @see NewRelic::addCustomParameter()
     * @see newrelic_set_user_attributes()
     */
    public static function setUserAttributes(string $user, string $account, string $product): bool
    {
        return self::run(static function () use ($user, $account, $product) {
            return newrelic_set_user_attributes($user, $account, $product);
        });
    }

    /**
     * Starts a new transaction, usually after manually ending a transaction.
     *
     * @see newrelic_start_transaction()
     */
    public static function startTransaction(string $name, string $license = null): bool
    {
        return self::run(static function () use ($name, $license) {
            return newrelic_start_transaction($name, $license);
        });
    }
}
