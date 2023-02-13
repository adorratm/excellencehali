<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Intl\Tests\DateFormatter\Verification;

use Symfony\Component\Intl\DateFormatter\IntlDateFormatter;
use Symfony\Component\Intl\Tests\DateFormatter\AbstractIntlDateFormatterTest;
use Symfony\Component\Intl\Util\IntlTestHelper;

/**
 * Verifies that {@link AbstractIntlDateFormatterTest} matches the behavior of
 * the {@link \IntlDateFormatter} class in a specific version of ICU.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class IntlDateFormatterTest extends AbstractIntlDateFormatterTest
{
    protected function setUp(): void
    {
        IntlTestHelper::requireFullIntl($this, false);

        parent::setUp();
    }

    /**
     * @dataProvider formatTimezoneProvider
     */
    public function testFormatTimezone($pattern, $timezone, $expected)
    {
        if ((80114 === \PHP_VERSION_ID || 80201 === \PHP_VERSION_ID) && str_contains($timezone, 'GMT')) {
            $this->markTestSkipped('Broken version of PHP');
        }

        IntlTestHelper::requireFullIntl($this, '59.1');

        parent::testFormatTimezone($pattern, $timezone, $expected);
    }

    public function testFormatUtcAndGmtAreSplit()
    {
        IntlTestHelper::requireFullIntl($this, '59.1');

        parent::testFormatUtcAndGmtAreSplit();
    }

    /**
     * @dataProvider dateAndTimeTypeProvider
     */
    public function testDateAndTimeType($timestamp, $datetype, $timetype, $expected)
    {
        IntlTestHelper::requireFullIntl($this, '59.1');

        parent::testDateAndTimeType($timestamp, $datetype, $timetype, $expected);
    }

    protected function getDateFormatter($locale, $datetype, $timetype, $timezone = null, $calendar = IntlDateFormatter::GREGORIAN, $pattern = null)
    {
        if ((80114 === \PHP_VERSION_ID || 80201 === \PHP_VERSION_ID) && \is_string($timezone) && str_contains($timezone, 'GMT')) {
            $this->markTestSkipped('Broken version of PHP');
        }

        IntlTestHelper::requireFullIntl($this, '55.1');

        if (!$formatter = new \IntlDateFormatter($locale, $datetype ?? IntlDateFormatter::FULL, $timetype ?? IntlDateFormatter::FULL, $timezone, $calendar, $pattern)) {
            throw new \InvalidArgumentException(intl_get_error_message());
        }

        return $formatter;
    }

    protected function getIntlErrorMessage(): string
    {
        return intl_get_error_message();
    }

    protected function getIntlErrorCode(): int
    {
        return intl_get_error_code();
    }

    protected function isIntlFailure($errorCode): bool
    {
        return intl_is_failure($errorCode);
    }
}
