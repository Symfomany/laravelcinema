<?php

namespace Templating\Tests\Helper;

use Templating\Helper\DateHelper;

class DateHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var DateHelper */
    private $helper;

    static private $oldDefaultLocale;

    public function testGetName()
    {
        $this->assertSame('date', $this->helper->getName());
    }

    /** @dataProvider provideDateTime */
    public function testFormatDateTime($formatted, $datetime, $dateFormat, $timeFormat, $timeZone, $locale)
    {
        $this->assertSame(
            $formatted,
            $this->helper->format($datetime, $dateFormat, $timeFormat, $timeZone, $locale)
        );
    }

    public function provideDateTime()
    {
        return [
            [ 'Saturday, February 21, 2015', '2015-02-21 00:00:00 Europe/Paris', \IntlDateFormatter::FULL, null, null, 'en' ],
            [ 'samedi 21 février 2015', '2015-02-21 00:00:00 Europe/Paris', \IntlDateFormatter::FULL, null, null, 'fr' ],
            [ 'samedi 21 février 2015', '2015-02-21 00:00:00', \IntlDateFormatter::FULL, null, new \DateTimeZone('Europe/Berlin'), 'fr' ],
            [ 'samedi 21 février 2015', '2015-02-21 00:00:00', \IntlDateFormatter::FULL, null, 'Europe/Berlin', 'fr' ],
            [ 'dimanche 25 janvier 2015', \DateTimeImmutable::createFromFormat('Y-m-d', '2015-01-25'), \IntlDateFormatter::FULL, null, 'Europe/Berlin', 'fr' ],
            [ 'dimanche 25 janvier 2015', new \DateTime('2015-01-25'), \IntlDateFormatter::FULL, null, 'Europe/Berlin', 'fr' ],
            [ 'Sunday, January 25, 2015', new \DateTime('2015-01-25'), \IntlDateFormatter::FULL, null, 'Europe/Berlin', null ],
            [ 'Jan 25, 2015', new \DateTime('2015-01-25'), null, null, 'Europe/Berlin', null ],
        ];
    }

    protected function setUp()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('intl extension is required.');
        }

        static::$oldDefaultLocale = \Locale::getDefault();
        \Locale::setDefault('en');

        $this->helper = new DateHelper();
    }

    protected function tearDown()
    {
        \Locale::setDefault(static::$oldDefaultLocale);

        $this->helper = null;
    }
}
