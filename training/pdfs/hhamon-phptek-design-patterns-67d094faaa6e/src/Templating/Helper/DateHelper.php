<?php

namespace Templating\Helper;

class DateHelper implements HelperInterface
{
    public function __construct()
    {
        if (!extension_loaded('intl')) {
            // @codeCoverageIgnoreStart
            throw new \RuntimeException('Intl extension is required.');
            // @codeCoverageIgnoreEnd
        }
    }

    public function format($datetime, $dateFormat = null, $timeFormat = null, $timezone = null, $locale = null)
    {
        $dt = null;
        $tz = null;

        if (null !== $timezone) {
            $tz = is_string($timezone) ? new \DateTimeZone($timezone) : $timezone;
        }

        if ($datetime instanceof \DateTimeImmutable) {
            $dt = new \DateTime($datetime->format('Y-m-d H:i:s'), $tz);
        } else if (!$datetime instanceof \DateTime) {
            $dt = new \DateTime($datetime, $tz);
        } else {
            $dt = clone $datetime;
        }

        if (null === $tz) {
            $tz = $dt->getTimezone();
        }

        if (null === $locale) {
            $locale = \Locale::getDefault();
        }

        if (null === $dateFormat) {
            $dateFormat = \IntlDateFormatter::MEDIUM;
        }

        if (null === $timeFormat) {
            $timeFormat = \IntlDateFormatter::NONE;
        }

        $currentLocale = \Locale::getDefault();

        \Locale::setDefault($locale);

        $formatter = new \IntlDateFormatter($locale, $dateFormat, $timeFormat, $tz);
        $result = $formatter->format($dt);

        \Locale::setDefault($currentLocale);

        return $result;
    }

    public function getName()
    {
        return 'date';
    }
}
