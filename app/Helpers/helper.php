<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        return Request::is($path) ? ' class="active"' : '';
    }
}

if (!function_exists('classActiveSegment')) {
    function classActiveSegment($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ' class="active"' : '';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return ' class="active"';
            }
        }
        return '';
    }
}

if (!function_exists('classActiveOnlyPath')) {
    function classActiveOnlyPath($path)
    {
        return Request::is($path) ? ' active' : '';
    }
}

if (!function_exists('classActiveOnlySegment')) {
    function classActiveOnlySegment($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ' active' : '';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return ' active';
            }
        }
        return '';
    }
}

if (!function_exists('classShowOnlySegment')) {
    function classShowOnlySegment($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? 'here show' : '';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return 'here show';
            }
        }
        return '';
    }
}

if (!function_exists('classActiveOnlySegmentTab')) {
    function classActiveOnlySegmentTab($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ' btn-warning' : 'btn-primary';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return ' btn-warning';
            }
            else {
                return ' btn-primary';
            }
        }
        return '';
    }
}

function getTemplate()
{
    /*$template = cache()->remember('view.template', 7 * 24 * 60 * 60, function () {
        return \App\Models\ViewTemplate::where('status', true)->first();
    });*/
    if (!empty($template) and $template->count() > 0) {
        return 'web.' . $template->folder;
    }
    return 'web.default';
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

/**
 * @param $timestamp
 * @param string $format
 *
 * // Use this format everywhere : j:day , M:month, Y:year, H:hour, i:minute => {j M Y} or {j M Y H:i}
 * */
function dateTimeFormat($timestamp, $format = 'H:i', $useAdminSetting = true, $applyTimezone = true, $timezone = "Asia/Bangkok")
{
    if ($applyTimezone) {
        $timezone = getTimezone();
    }

    if ($useAdminSetting) {
        $format = handleDateAndTimeFormat($format);
    }

    if (empty($timezone)) {
        $timezone = "Asia/Bangkok";
    }

    $timezone = new DateTimeZone($timezone);

    return (new DateTime())->setTimezone($timezone)->setTimestamp($timestamp)->format($format);
}

function getTimezone()
{
    $timezone = getGeneralSettings('default_time_zone');

    if (auth()->check()) {
        $user = auth()->user();

        if (!empty($user) and !empty($user->timezone)) {
            $timezone = $user->timezone;
        }
    }

    return $timezone;
}

function handleDateAndTimeFormat($format)
{
    $dateFormat = getGeneralSettings('date_format') ?? 'textual';
    $timeFormat = getGeneralSettings('time_format') ?? '24_hours';

    if ($dateFormat == 'numerical') {
        $format = str_replace('M', 'm', $format);
        $format = str_replace('j ', 'j/', $format);
        $format = str_replace('m ', 'm/', $format);
    } else {
        $format = str_replace('m', 'M', $format);
    }

    if ($timeFormat == '24_hours') {
        $format = str_replace('H', 'h', $format);

        if (strpos($format, 'h')) {
            $format .= ' a';
        }
    } else {
        $format = str_replace('h', 'H', $format);
        $format = str_replace('a', '', $format);
    }

    return $format;
}

function diffTimestampDay($firstTime, $lastTime)
{
    return ($firstTime - $lastTime) / (24 * 60 * 60);
}

function convertMinutesToHourAndMinute($minutes)
{
    return intdiv($minutes, 60) . ':' . (str_pad($minutes % 60, 2, 0, STR_PAD_LEFT));
}

function getListOfTimezones()
{
    return DateTimeZone::listIdentifiers();
}

function toGmtOffset($timezone): string
{
    $userTimeZone = new DateTimeZone($timezone);
    $offset = $userTimeZone->getOffset(new DateTime("now", new DateTimeZone('GMT'))); // Offset in seconds
    $seconds = abs($offset);
    $sign = $offset > 0 ? '+' : '-';
    $hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);
    return sprintf("GMT $sign%02d:%02d", $hours, $mins, $secs);
}

//this function convert string to UTC time zone
function convertTimeToUTCzone($str, $userTimezone, $format = false)
{
    $new_str = new DateTime($str, new DateTimeZone($userTimezone));

    $new_str->setTimeZone(new DateTimeZone('UTC'));

    if ($format) {
        return $new_str->format("Y-m-d H:i");
    }

    return $new_str;
}

function x_week_range()
{
    $start = strtotime(date('Y-m-d', strtotime("last Saturday")));
    return array(
        $start,
        strtotime(date('Y-m-d', strtotime('next Friday', $start)))
    );
}

function getTimeByDay($title)
{
    $start = date('Y-m-d', strtotime("last Saturday"));
    $time = 0;
    switch ($title) {
        case "saturday":
            $time = strtotime(date('Y-m-d', strtotime($start)));
            break;
        case "sunday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+1 days")));
            break;
        case "monday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+2 days")));
            break;
        case "tuesday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+3 days")));
            break;
        case "wednesday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+4 days")));
            break;
        case "thursday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+5 days")));
            break;
        case "friday":
            $time = strtotime(date('Y-m-d', strtotime($start . "+6 days")));
            break;
    }
    return $time;
}

function convertDayToNumber($times)
{
    $numbers = [
        'sunday' => 1,
        'monday' => 2,
        'tuesday' => 3,
        'wednesday' => 4,
        'thursday' => 5,
        'friday' => 6,
        'saturday' => 7
    ];

    $numberDay = [];

    foreach ($times as $day => $time) {
        $numberDay[] = $numbers[$day];
    }

    return $numberDay;
}

function getBindedSQL($query)
{
    $fullQuery = $query->toSql();
    $replaces = $query->getBindings();
    foreach ($replaces as $replace) {
        $fullQuery = Str::replaceFirst('?', $replace, $fullQuery);
    }

    return $fullQuery;
}

function getUserLanguagesLists()
{
    $generalSettings = getGeneralSettings();
    $userLanguages = ($generalSettings and !empty($generalSettings['user_languages'])) ? $generalSettings['user_languages'] : null;

    if (!empty($userLanguages) and is_array($userLanguages)) {
        $userLanguages = getLanguages($userLanguages);
    } else {
        $userLanguages = [];
    }

    if (count($userLanguages) > 0) {
        foreach ($userLanguages as $locale => $language) {
            if (mb_strtolower($locale) == mb_strtolower(app()->getLocale())) {
                $firstKey = array_key_first($userLanguages);

                if ($firstKey != $locale) {
                    $firstValue = $userLanguages[$firstKey];

                    unset($userLanguages[$locale]);
                    unset($userLanguages[$firstKey]);

                    $userLanguages = array_merge([
                        $locale => $language,
                        $firstKey => $firstValue
                    ], $userLanguages);
                }
            }
        }
    }

    return $userLanguages;
}

function getLanguages($lang = null)
{
    $languages = [
        "AA" => 'Afar',
        "AF" => 'Afrikanns',
        "SQ" => 'Albanian',
        "AM" => 'Amharic',
        "AR" => 'Arabic',
        "HY" => 'Armenian',
        "AY" => 'Aymara',
        "AZ" => 'Azerbaijani',
        "EU" => 'Basque',
        "DZ" => 'Bhutani',
        "BH" => 'Bihari',
        "BI" => 'Bislama',
        "BR" => 'Breton',
        "BG" => 'Bulgarian',
        "MY" => 'Burmese',
        "BE" => 'Byelorussian',
        "BN" => 'Bangla',
        "KM" => 'Cambodian',
        "CA" => 'Catalan',
        "ZH" => 'Chinese',
        "HR" => 'Croation',
        "CS" => 'Czech',
        "DA" => 'Danish',
        "NL" => 'Dutch',
        "EN" => 'English',
        "ET" => 'Estonian',
        "FO" => 'Faeroese',
        "FJ" => 'Fiji',
        "FI" => 'Finnish',
        "FR" => 'French',
        "KA" => 'Georgian',
        "DE" => 'German',
        "EL" => 'Greek',
        "KL" => 'Greenlandic',
        "GN" => 'Guarani',
        "HI" => 'Hindi',
        "HU" => 'Hungarian',
        "IS" => 'Icelandic',
        "ID" => 'Indonesian',
        "IT" => 'Italian',
        "JA" => 'Japanese',
        "KK" => 'Kazakh',
        "RW" => 'Kinyarwanda',
        "KY" => 'Kirghiz',
        "KO" => 'Korean',
        "KU" => 'Kurdish',
        "LO" => 'Laothian',
        "LA" => 'Latin',
        "LV" => 'Latvian',
        "LT" => 'Lithuanian',
        "MK" => 'Macedonian',
        "MG" => 'Malagasy',
        "MS" => 'Malay',
        "MT" => 'Maltese',
        "MI" => 'Maori',
        "MN" => 'Mongolian',
        "NA" => 'Nauru',
        "NE" => 'Nepali',
        "NO" => 'Norwegian',
        "OM" => 'Oromo',
        "PS" => 'Pashto',
        "FA" => 'Persian',
        "PL" => 'Polish',
        "PT" => 'Portuguese',
        "QU" => 'Quechua',
        "RM" => 'Rhaeto',
        "RO" => 'Romanian',
        "RU" => 'Russian',
        "SM" => 'Samoan',
        "SG" => 'Sangro',
        "SR" => 'Serbian',
        "TN" => 'Setswana',
        "SN" => 'Shona',
        "SI" => 'Singhalese',
        "SS" => 'Siswati',
        "SK" => 'Slovak',
        "SL" => 'Slovenian',
        "SO" => 'Somali',
        "ES" => 'Spanish',
        "SV" => 'Swedish',
        "TL" => 'Tagalog',
        "TG" => 'Tajik',
        "TA" => 'Tamil',
        "TH" => 'Thai',
        "TI" => 'Tigrinya',
        "TR" => 'Turkish',
        "TK" => 'Turkmen',
        "TW" => 'Twi',
        "UK" => 'Ukranian',
        "UR" => 'Urdu',
        "UZ" => 'Uzbek',
        "VI" => 'Vietnamese',
        "XH" => 'Xhosa',
    ];

    if (!empty($lang) and is_array($lang)) {
        return array_flip(array_intersect(array_flip($languages), $lang));
    } elseif (!empty($lang)) {
        return $languages[$lang];
    }

    return $languages;
}

function localeToCountryCode($code, $revers = false)
{
    $languages = [
        "AA" => 'DJ', // language code => country code
        "AF" => 'ZA',
        "SQ" => 'AL',
        "AM" => 'ET',
        "AR" => 'IQ',
        "HY" => 'AM',
        "AY" => 'BO',
        "AZ" => 'AZ',
        "EU" => 'ES',
        "BN" => 'BD',
        "DZ" => 'BT',
        "BI" => 'VU',
        "BG" => 'BG',
        "MY" => 'MM',
        "BE" => 'BY',
        "KM" => 'KH',
        "CA" => 'ES',
        "ZH" => 'CN',
        "HR" => 'HR',
        "CS" => 'CZ',
        "DA" => 'DK',
        "NL" => 'NL',
        "EN" => 'US',
        "ET" => 'EE',
        "FO" => 'FO',
        "FJ" => 'FJ',
        "FI" => 'FI',
        "FR" => 'FR',
        "KA" => 'GE',
        "DE" => 'DE',
        "EL" => 'GR',
        "KL" => 'GL',
        "GN" => 'GN',
        "HI" => 'IN',
        "HU" => 'HU',
        "IS" => 'IS',
        "ID" => 'ID',
        "IT" => 'IT',
        "JA" => 'JP',
        "KK" => 'KZ',
        "RW" => 'RW',
        "KY" => 'KG',
        "KO" => 'KR',
        "LO" => 'LA',
        "LA" => 'RS',
        "LV" => 'LV',
        "LT" => 'LT',
        "MK" => 'MK',
        "MG" => 'MG',
        "MS" => 'MS',
        "MT" => 'MT',
        "MI" => 'NZ',
        "MN" => 'MN',
        "NA" => 'NR',
        "NE" => 'NP',
        "NO" => 'NO',
        "OM" => 'ET',
        "PS" => 'AF',
        "FA" => 'IR',
        "PL" => 'PL',
        "PT" => 'PT',
        "QU" => 'BO',
        "RM" => 'CH',
        "RO" => 'RO',
        "RU" => 'RU',
        "SM" => 'WS',
        "SG" => 'CG',
        "SR" => 'SR',
        "TN" => 'BW',
        "SN" => 'ZW',
        "SI" => 'LK',
        "SS" => 'SZ',
        "SK" => 'SK',
        "SL" => 'SI',
        "SO" => 'SO',
        "ES" => 'ES',
        "SV" => 'SE',
        "TL" => 'PH',
        "TG" => 'TJ',
        "TA" => 'LK',
        "TH" => 'TH',
        "TI" => 'ER',
        "TR" => 'TR',
        "TK" => 'TM',
        "TW" => 'TW',
        "UK" => 'UA',
        "UR" => 'PK',
        "UZ" => 'UZ',
        "VI" => 'VN',
        "XH" => 'ZA',
    ];

    if ($revers) {
        $languages = array_flip($languages);
        return !empty($languages[$code]) ? $languages[$code] : '';
    }

    return !empty($languages[$code]) ? $languages[$code] : '';
}

function getMoneyUnits($unit = null)
{
    $units = [
        "USD" => 'United States Dollar',
        "EUR" => 'Euro Member Countries',
        "AUD" => 'Australia Dollar',
        "AED" => 'United Arab Emirates dirham',
        "KAD" => 'KAD',
        "JPY" => 'Japan Yen',
        "CNY" => 'China Yuan Renminbi',
        "SAR" => 'Saudi Arabia Riyal',
        "KRW" => 'Korea (South) Won',
        "INR" => 'India Rupee',
        "RUB" => 'Russia Ruble',
        "Lek" => 'Albania Lek',
        "AFN" => 'Afghanistan Afghani',
        "ARS" => 'Argentina Peso',
        "AWG" => 'Aruba Guilder',
        "AZN" => 'Azerbaijan Manat',
        "BDT" => 'Bangladeshi taka',
        "BSD" => 'Bahamas Dollar',
        "BBD" => 'Barbados Dollar',
        "BYN" => 'Belarus Ruble',
        "BZD" => 'Belize Dollar',
        "BMD" => 'Bermuda Dollar',
        "BOB" => 'Bolivia Bolíviano',
        "BAM" => 'Bosnia and Herzegovina Convertible Mark',
        "BWP" => 'Botswana Pula',
        "BGN" => 'Bulgaria Lev',
        "BRL" => 'Brazil Real',
        "BND" => 'Brunei Darussalam Dollar',
        "KHR" => 'Cambodia Riel',
        "CAD" => 'Canada Dollar',
        "KYD" => 'Cayman Islands Dollar',
        "CLP" => 'Chile Peso',
        "COP" => 'Colombia Peso',
        "CRC" => 'Costa Rica Colon',
        "HRK" => 'Croatia Kuna',
        "CUP" => 'Cuba Peso',
        "CZK" => 'Czech Republic Koruna',
        "DKK" => 'Denmark Krone',
        "DZD" => 'Algerian Dinar',
        "DOP" => 'Dominican Republic Peso',
        "XCD" => 'East Caribbean Dollar',
        "EGP" => 'Egypt Pound',
        "GTQ" => 'Guatemala Quetzal',
        "GHS" => 'Ghanaian cedi',
        "HKD" => 'Hong Kong Dollar',
        "HUF" => 'Hungary Forint',
        "IDR" => 'Indonesia Rupiah',
        "IRR" => 'Iran Rial',
        "ILS" => 'Israel Shekel',
        "LBP" => 'Lebanon Pound',
        "MAD" => 'Moroccan dirham',
        "MYR" => 'Malaysia Ringgit',
        "NGN" => 'Nigeria Naira',
        "NPR" => 'Nepalese Rupee',
        "NOK" => 'Norway Krone',
        "OMR" => 'Oman Rial',
        "PKR" => 'Pakistan Rupee',
        "PHP" => 'Philippines Peso',
        "PLN" => 'Poland Zloty',
        "RON" => 'Romania Leu',
        "ZAR" => 'South Africa Rand',
        "LKR" => 'Sri Lanka Rupee',
        "SEK" => 'Sweden Krona',
        "CHF" => 'Switzerland Franc',
        "THB" => 'Thailand Baht',
        "TRY" => 'Turkey Lira',
        "UAH" => 'Ukraine Hryvnia',
        "GBP" => 'United Kingdom Pound',
        "TWD" => 'Taiwan New Dollar',
        "VND" => 'Viet Nam Dong',
        "UZS" => 'Uzbekistan Som',
        "KZT" => 'Kazakhstani Tenge',
    ];

    if (!empty($unit)) {
        return $units[$unit];
    }

    return $units;
}

function currenciesLists($sing = null)
{
    $lists = [
        "USD" => 'United States Dollar',
        "EUR" => 'Euro Member Countries',
        "AUD" => 'Australia Dollar',
        "AED" => 'United Arab Emirates dirham',
        "KAD" => 'KAD',
        "JPY" => 'Japan Yen',
        "CNY" => 'China Yuan Renminbi',
        "SAR" => 'Saudi Arabia Riyal',
        "KRW" => 'Korea (South) Won',
        "INR" => 'India Rupee',
        "RUB" => 'Russia Ruble',
        "Lek" => 'Albania Lek',
        "AFN" => 'Afghanistan Afghani',
        "ARS" => 'Argentina Peso',
        "AWG" => 'Aruba Guilder',
        "AZN" => 'Azerbaijan Manat',
        "BSD" => 'Bahamas Dollar',
        "BBD" => 'Barbados Dollar',
        "BDT" => 'Bangladeshi taka',
        "BYN" => 'Belarus Ruble',
        "BZD" => 'Belize Dollar',
        "BMD" => 'Bermuda Dollar',
        "BOB" => 'Bolivia Bolíviano',
        "BAM" => 'Bosnia and Herzegovina Convertible Mark',
        "BWP" => 'Botswana Pula',
        "BGN" => 'Bulgaria Lev',
        "BRL" => 'Brazil Real',
        "BND" => 'Brunei Darussalam Dollar',
        "KHR" => 'Cambodia Riel',
        "CAD" => 'Canada Dollar',
        "KYD" => 'Cayman Islands Dollar',
        "CLP" => 'Chile Peso',
        "COP" => 'Colombia Peso',
        "CRC" => 'Costa Rica Colon',
        "HRK" => 'Croatia Kuna',
        "CUP" => 'Cuba Peso',
        "CZK" => 'Czech Republic Koruna',
        "DKK" => 'Denmark Krone',
        "DZD" => 'Algerian Dinar',
        "DOP" => 'Dominican Republic Peso',
        "XCD" => 'East Caribbean Dollar',
        "EGP" => 'Egypt Pound',
        "GTQ" => 'Guatemala Quetzal',
        "GHS" => 'Ghanaian cedi',
        "HKD" => 'Hong Kong Dollar',
        "HUF" => 'Hungary Forint',
        "IDR" => 'Indonesia Rupiah',
        "IRR" => 'Iran Rial',
        "ILS" => 'Israel Shekel',
        "LBP" => 'Lebanon Pound',
        "MAD" => 'Moroccan dirham',
        "MYR" => 'Malaysia Ringgit',
        "NGN" => 'Nigeria Naira',
        "NPR" => 'Nepalese Rupee',
        "NOK" => 'Norway Krone',
        "OMR" => 'Oman Rial',
        "PKR" => 'Pakistan Rupee',
        "PHP" => 'Philippines Peso',
        "PLN" => 'Poland Zloty',
        "RON" => 'Romania Leu',
        "ZAR" => 'South Africa Rand',
        "LKR" => 'Sri Lanka Rupee',
        "SEK" => 'Sweden Krona',
        "CHF" => 'Switzerland Franc',
        "THB" => 'Thailand Baht',
        "TRY" => 'Turkey Lira',
        "UAH" => 'Ukraine Hryvnia',
        "GBP" => 'United Kingdom Pound',
        "TWD" => 'Taiwan New Dollar',
        "VND" => 'Viet Nam Dong',
        "UZS" => 'Uzbekistan Som',
        "KZT" => 'Kazakhstani Tenge',

    ];

    if (!empty($sing)) {
        return $lists[$sing];
    }

    return $lists;
}

function currency()
{
    return getFinancialSettings('currency') ?? 'IDR';
}

function currencySign()
{
    switch (currency()) {
        case 'USD':
            return '$';
            break;
        case 'EUR':
            return '€';
            break;
        case 'JPY':
        case 'CNY':
            return '¥';
            break;
        case 'AED':
            return 'د.إ';
            break;
        case 'SAR':
            return 'ر.س';
            break;
        case 'KRW':
            return '₩';
            break;
        case 'INR':
            return '₹';
            break;
        case 'RUB':
            return '₽';
            break;
        case 'Lek':
            return 'Lek';
            break;
        case 'AFN':
            return '؋';
            break;
        case 'ARS':
            return '$';
            break;
        case 'AWG':
            return 'ƒ';
            break;
        case 'AUD':
            return '$';
            break;
        case 'AZN':
            return '₼';
            break;
        case 'BSD':
            return '$';
            break;
        case 'BBD':
            return '$';
            break;
        case 'BDT':
            return '৳';
            break;
        case 'BYN':
            return 'Br';
            break;
        case 'BZD':
            return 'BZ$';
            break;
        case 'BMD':
            return '$';
            break;
        case 'BOB':
            return '$b';
            break;
        case 'BAM':
            return 'KM';
            break;
        case 'BWP':
            return 'P';
            break;
        case 'BGN':
            return 'лв';
            break;
        case 'BRL':
            return 'R$';
            break;
        case 'BND':
            return '$';
            break;
        case 'COP':
            return '$';
            break;
        case 'CRC':
            return '₡';
            break;
        case 'CZK':
            return 'Kč';
            break;
        case 'CUP':
            return '₱';
            break;
        case 'DKK':
            return 'kr';
            break;
        case 'DZD':
            return 'دج';
            break;
        case 'DOP':
            return 'RD$';
            break;
        case 'XCD':
            return '$';
            break;
        case 'EGP':
            return '£';
            break;
        case 'GTQ':
            return 'Q';
            break;
        case 'HKD':
            return '$';
            break;
        case 'HUF':
            return 'Ft';
            break;
        case 'IDR':
            return 'Rp';
            break;
        case 'IRR':
            return '﷼';
            break;
        case 'ILS':
            return '₪';
            break;
        case 'LBP':
            return '£';
            break;
        case 'MAD':
            return 'DH';
            break;
        case 'MYR':
            return 'RM';
            break;
        case 'NGN':
            return '₦';
            break;
        case 'NPR':
            return 'रू';
            break;
        case 'NOK':
            return 'kr';
            break;
        case 'OMR':
            return '﷼';
            break;
        case 'PKR':
            return '₨';
            break;
        case 'PHP':
            return '₱';
            break;
        case 'PLN':
            return 'zł';
            break;
        case 'RON':
            return 'lei';
            break;
        case 'ZAR':
            return 'R';
            break;
        case 'LKR':
            return '₨';
            break;
        case 'SEK':
            return 'kr';
            break;
        case 'CHF':
            return 'CHF';
            break;
        case 'THB':
            return '฿';
            break;
        case 'TRY':
            return '₺';
            break;
        case 'UAH':
            return '₴';
            break;
        case 'GBP':
            return '£';
            break;
        case 'GHS':
            return 'GH₵';
            break;
        case 'VND':
            return '₫';
            break;
        case 'TWD':
            return 'NT$';
            break;
        case 'UZS':
            return 'лв';
            break;
        case 'KZT':
            return '₸';
            break;
        default:
            return '$';
    }

    return '$';
}

function getCountriesMobileCode()
{
    return [
        'Indonesia (+62)' => '+62',
    ];
}

// Truncate a string only at a whitespace
function truncate($text, $length, $withTail = true)
{
    $length = abs((int)$length);
    if (strlen($text) > $length) {
        $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", ($withTail ? '\\1 ...' : '\\1'), $text);
    }

    return ($text);
}


/**
 * @param null $page => Setting::$pagesSeoMetas
 * @return array [title, description]
 */
function getSeoMetas($page = null)
{
    return App\Models\Setting::getSeoMetas($page);
}

/**
 * @return array [title, image, link]
 */
function getSocials()
{
    return App\Models\Setting::getSocials();
}

/**
 * @return array [title, items => [title, link]]
 */
function getFooterColumns()
{
    return App\Models\Setting::getFooterColumns();
}


/*
 * @return array [site_name, site_email, site_phone, site_language, register_method, user_languages, rtl_languages, fav_icon, locale, logo, footer_logo, rtl_layout, home hero1 is active, home hero2 is active, content_translate, default_time_zone, date_format, time_format]
 */
function getGeneralSettings($key = null)
{
    return App\Models\Setting::getGeneralSettings($key);
}

/**
 * @param null $key
 * $key => "agora_resolution" | "agora_max_bitrate" | "agora_min_bitrate" | "agora_frame_rate" | "agora_live_streaming" | "agora_chat" | "agora_cloud_rec" | "agora_in_free_courses"
 * "new_interactive_file" | "timezone_in_register" | "timezone_in_create_webinar"
 * "sequence_content_status" | "webinar_assignment_status" | "webinar_private_content_status" | "disable_view_content_after_user_register"
 * "direct_classes_payment_button_status" | "mobile_app_status" | "cookie_settings_status" | "show_other_register_method" | "show_certificate_additional_in_register"
 * @return
 * */
function getFeaturesSettings($key = null)
{
    return App\Models\Setting::getFeaturesSettings($key);
}

/**
 * @param null $key
 * $key => cookie_settings_modal_message | cookie_settings_modal_items
 * @return
 * */
function getCookieSettings($key = null)
{
    return App\Models\Setting::getCookieSettings($key);
}


/**
 * @param $key
 * @return array|[commission, tax, minimum_payout, currency, currency_position, price_display]
 */
function getFinancialSettings($key = null)
{
    return App\Models\Setting::getFinancialSettings($key);
}


/**
 * @param string $section => 2 for hero section 2
 * @return array|[title, description, hero_background]
 */
function getHomeHeroSettings($section = '1')
{
    return App\Models\Setting::getHomeHeroSettings($section);
}

/**
 * @return array|[title, description, background]
 */
function getHomeVideoOrImageBoxSettings()
{
    return App\Models\Setting::getHomeVideoOrImageBoxSettings();
}


/**
 * @param null $page => admin_login, admin_dashboard, login, register, remember_pass, search, categories,
 * become_instructor, certificate_validation, blog, instructors
 * ,dashboard, panel_sidebar, user_avatar, user_cover, instructor_finder_wizard, products_lists
 * @return string|array => [all pages]
 */
function getPageBackgroundSettings($page = null)
{
    return App\Models\Setting::getPageBackgroundSettings($page);
}


/**
 * @param null $key => css, js
 * @return string|array => {css, js}
 */
function getCustomCssAndJs($key = null)
{
    return App\Models\Setting::getCustomCssAndJs($key);
}

/**
 * @return array
 */
function getSiteBankAccounts()
{
    return App\Models\Setting::getSiteBankAccounts();
}

/**
 * @return array [status, users_affiliate_status, affiliate_user_commission, affiliate_user_amount, referred_user_amount, referral_description]
 */
function getReferralSettings()
{
    $settings = App\Models\Setting::getReferralSettings();

    if (empty($settings['status'])) {
        $settings['status'] = false;
    } else {
        $settings['status'] = true;
    }

    if (empty($settings['users_affiliate_status'])) {
        $settings['users_affiliate_status'] = false;
    } else {
        $settings['users_affiliate_status'] = true;
    }

    if (empty($settings['affiliate_user_commission'])) {
        $settings['affiliate_user_commission'] = 0;
    }

    if (empty($settings['affiliate_user_amount'])) {
        $settings['affiliate_user_amount'] = 0;
    }

    if (empty($settings['referred_user_amount'])) {
        $settings['referred_user_amount'] = 0;
    }

    if (empty($settings['referral_description'])) {
        $settings['referral_description'] = '';
    }

    return $settings;
}

/**
 * @return array
 */
function getOfflineBanksTitle()
{
    $titles = [];

    $banks = getSiteBankAccounts();

    if (!empty($banks) and count($banks)) {
        foreach ($banks as $bank) {
            $titles[] = $bank['title'];
        }
    }

    return $titles;
}

/**
 * @return array
 */
function getReportReasons()
{
    return App\Models\Setting::getReportReasons();
}

/**
 * @param $template {String|nullable}
 * @return array
 */
function getNotificationTemplates($template = null)
{
    return App\Models\Setting::getNotificationTemplates($template);
}

/**
 * @param $key
 * @return array
 */
function getContactPageSettings($key = null)
{
    return App\Models\Setting::getContactPageSettings($key);
}

/**
 * @param $key
 * @return array
 */
function get404ErrorPageSettings($key = null)
{
    return App\Models\Setting::get404ErrorPageSettings($key);
}

/**
 * @param $key
 * @return array
 */
function getHomeSectionsSettings($key = null)
{
    return App\Models\Setting::getHomeSectionsSettings($key);
}

/**
 * @param $key
 * @return array
 */
function getNavbarLinks()
{
    $links = App\Models\Setting::getNavbarLinksSettings();

    if (!empty($links)) {
        usort($links, function ($item1, $item2) {
            return $item1['order'] <=> $item2['order'];
        });
    }

    return $links;
}

/**
 * @return array
 */
function getPanelSidebarSettings()
{
    return App\Models\Setting::getPanelSidebarSettings();
}


/**
 * @return array
 */
function getFindInstructorsSettings()
{
    return App\Models\Setting::getFindInstructorsSettings();
}

/**
 * @return array
 */
function getRewardProgramSettings()
{
    return App\Models\Setting::getRewardProgramSettings();
}

/**
 * @return array
 */
function getRewardsSettings()
{
    return App\Models\Setting::getRewardsSettings();
}

/**
 * @param $kay => [status, virtual_product_commission, physical_product_commission, store_tax,
 *                 possibility_create_virtual_product, possibility_create_physical_product,
 *                 shipping_tracking_url, activate_comments
 *              ]
 */
function getStoreSettings($key = null)
{
    return App\Models\Setting::getStoreSettings($key);
}

function getBecomeInstructorSectionSettings()
{
    return App\Models\Setting::getBecomeInstructorSectionSettings();
}

function getForumSectionSettings()
{
    return App\Models\Setting::getForumSectionSettings();
}

function getRegistrationPackagesGeneralSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesGeneralSettings($key);
}

function getRegistrationPackagesInstructorsSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesInstructorsSettings($key);
}

function getRegistrationPackagesOrganizationsSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesOrganizationsSettings($key);
}

function getMobileAppSettings($key = null)
{
    return App\Models\Setting::getMobileAppSettings($key);
}

function getRemindersSettings($key = null)
{
    return App\Models\Setting::getRemindersSettings($key);
}

function getAdvertisingModalSettings()
{
    $cookieKey = 'show_advertise_modal';
    $settings = App\Models\Setting::getAdvertisingModalSettings();

    $show = false;

    if (!empty($settings) and !empty($settings['status']) and $settings['status'] == 1) {
        $checkCookie = Cookie::get($cookieKey);

        if (empty($checkCookie)) {
            $show = true;

            Cookie::queue($cookieKey, 1, 30 * 24 * 60);
        }
    }

    return $show ? $settings : null;
}

function getOthersPersonalizationSettings($key = null)
{
    return \App\Models\Setting::getOthersPersonalizationSettings($key);
}

/**
 * @return string ("primary_color"|"secondary_color") || null
 * */
function getThemeColorsSettings($admin = false)
{
    $settings = App\Models\Setting::getThemeColorsSettings();

    $result = '';

    if (!empty($settings) and count($settings)) {
        $result = ":root{" . PHP_EOL;

        if ($admin) {
            foreach (\App\Models\Setting::$rootAdminColors as $color) {
                if (!empty($settings['admin_' . $color])) {
                    $result .= "--$color:" . $settings['admin_' . $color] . ';' . PHP_EOL;
                }
            }
        } else {
            foreach (\App\Models\Setting::$rootColors as $color) {
                if (!empty($settings[$color])) {
                    $result .= "--$color:" . $settings[$color] . ';' . PHP_EOL;
                }
            }
        }

        $result .= "}" . PHP_EOL;
    }

    return $result;
}


/**
 * @return string ("primary_color"|"secondary_color") || null
 * */
function getThemeFontsSettings()
{
    $settings = App\Models\Setting::getThemeFontsSettings();

    $result = '';

    if (!empty($settings) and count($settings)) {

        foreach ($settings as $type => $setting) {

            if (!empty($settings[$type]['regular'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: 400;
                      font-display: swap;
                      src: local('Poppins Regular'), local('Poppins-Regular'), url({$settings[$type]['regular']}) format('woff2');
                    }";
            }

            if (!empty($settings[$type]['bold'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: bold;
                      font-display: swap;
                      src: local('Poppins Regular'), local('Poppins-Regular'), url({$settings[$type]['bold']}) format('woff2');
                    }";
            }

            if (!empty($settings[$type]['medium'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: 500;
                      font-display: swap;
                      src: local('Poppins Regular'), local('Poppins-Regular'), url({$settings[$type]['medium']}) format('woff2');
                    }";
            }

        }
    }

    return $result;
}

/**
 * @param $page => home, search, classes, categories, login, register, contact, blog, certificate_validation, 'instructors', 'organizations'
 *
 * @return string
 * */
function getPageRobot($page)
{
    $seoSettings = getSeoMetas($page);

    return (empty($seoSettings['robot']) or $seoSettings['robot'] != 'noindex') ? 'index, follow, all' : 'NOODP, nofollow, noindex';
}

function getPageRobotNoIndex()
{
    return 'NOODP, nofollow, noindex';
}

function getDefaultLocale()
{
    $key = 'site_language';
    $name = \App\Models\Setting::$generalName;

    /// I did not use the helper method because the Setting model uses translation and may get stuck in the loop.

    $setting = cache()->remember('settings.getDefaultLocale', 24 * 60 * 60, function () use ($name) {
        $setting = \Illuminate\Support\Facades\DB::table('settings')
            ->where('page', $name)
            ->where('name', $name)
            ->join('setting_translations', 'settings.id', '=', 'setting_translations.setting_id')
            ->select('settings.*', 'setting_translations.value')
            ->first();

        $value = [];

        if (!empty($setting) and !empty($setting->value) and isset($setting->value)) {
            $value = json_decode($setting->value, true);
        }

        return $value;
    });

    $siteLanguage = 'ID';

    if (!empty($setting)) {
        if (!empty($setting[$key])) {
            $siteLanguage = $setting[$key];
        }
    }

    return $siteLanguage;
}

function deepClone($object)
{
    $cloned = clone($object);
    foreach ($cloned as $key => $val) {
        if (is_object($val) || (is_array($val))) {
            $cloned->{$key} = unserialize(serialize($val));
        }
    }

    return $cloned;
}

function sendNotification($template, $options, $user_id = null, $group_id = null, $sender = 'system', $type = 'single')
{
    $templateId = getNotificationTemplates($template);
    $notificationTemplate = \App\Models\NotificationTemplate::where('id', $templateId)->first();

    if (!empty($notificationTemplate)) {
        $title = str_replace(array_keys($options), array_values($options), $notificationTemplate->title);
        $message = str_replace(array_keys($options), array_values($options), $notificationTemplate->template);

        $check = \App\Models\Notification::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->where('title', $title)
            ->where('message', $message)
            ->where('sender', $sender)
            ->where('type', $type)
            ->first();

        $ignoreDuplicateTemplates = ['new_badge'];

        if (empty($check) or !in_array($template, $ignoreDuplicateTemplates)) {
            \App\Models\Notification::create([
                'user_id' => $user_id,
                'group_id' => $group_id,
                'title' => $title,
                'message' => $message,
                'sender' => $sender,
                'type' => $type,
                'created_at' => time()
            ]);

            if (env('APP_ENV') == 'production') {
                $user = \App\User::where('id', $user_id)->first();
                if (!empty($user) and !empty($user->email)) {
                    try {
                        \Mail::to($user->email)->send(new \App\Mail\SendNotifications(['title' => $title, 'message' => $message]));
                    } catch (Exception $exception) {
                        // dd($exception)
                    }
                }
            }
        }

        return true;
    }

    return false;
}

function time2string($time)
{
    $d = floor($time / 86400);
    $_d = ($d < 10 ? '0' : '') . $d;

    $h = floor(($time - $d * 86400) / 3600);
    $_h = ($h < 10 ? '0' : '') . $h;

    $m = floor(($time - ($d * 86400 + $h * 3600)) / 60);
    $_m = ($m < 10 ? '0' : '') . $m;

    $s = $time - ($d * 86400 + $h * 3600 + $m * 60);
    $_s = ($s < 10 ? '0' : '') . $s;

    return [
        'day' => $_d,
        'hour' => $_h,
        'minute' => $_m,
        'second' => $_s
    ];
}

$months = [
    1 => 'Jan.',
    2 => 'Feb.',
    3 => 'Mar.',
    4 => 'Apr.',
    5 => 'May',
    6 => 'Jun.',
    7 => 'Jul.',
    8 => 'Aug.',
    9 => 'Sep.',
    10 => 'Oct.',
    11 => 'Nov.',
    12 => 'Dec.'
];

function fromAndToDateFilter($from, $to, $query, $column = 'created_at', $strToTime = true)
{
    if (!empty($from) and !empty($to)) {
        $from = $strToTime ? strtotime($from) : $from;
        $to = $strToTime ? strtotime($to) : $to;

        $query->whereBetween($column, [$from, $to]);
    } else {
        if (!empty($from)) {
            $from = $strToTime ? strtotime($from) : $from;

            $query->where($column, '>=', $from);
        }

        if (!empty($to)) {
            $to = $strToTime ? strtotime($to) : $to;

            $query->where($column, '<', $to);
        }
    }

    return $query;
}

function random_str($length)
{
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;

    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[rand(0, $max)];
    }

    return $str;
}

function checkCourseForSale($course, $user)
{
    if (!$course->canSale()) {
        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Di luar kapasitas kelas!',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    if ($course->checkUserHasBought($user)) {
        $toastData = [
            'title' => 'Pendaftaran gagal!',
            'msg' => 'Pelatihan berhasil didaftarkan.',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    if ($course->creator_id == $user->id or $course->teacher_id == $user->id) {
        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Anda tidak dapat membeli pelatihan Anda.',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    $isRequiredPrerequisite = false;
    if (!empty($course->prerequisites)) {
        $prerequisites = $course->prerequisites;
        if (count($prerequisites)) {
            foreach ($prerequisites as $prerequisite) {
                $prerequisiteWebinar = $prerequisite->prerequisiteWebinar;

                if ($prerequisite->required and !empty($prerequisiteWebinar) and !$prerequisiteWebinar->checkUserHasBought()) {
                    $isRequiredPrerequisite = true;
                }
            }
        }
    }

    if ($isRequiredPrerequisite) {
        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Anda harus lulus prasyarat yang diperlukan.',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    return 'ok';
}



function isAdminUrl($url = null)
{
    if (empty($url)) {
        $url = request()->getPathInfo();
    }
    return (1 === strpos($url, 'admin'));
}

function getTranslateAttributeValue($model, $key, $loca = null)
{
    $isAdminUrl = isAdminUrl();

    $locale = app()->getLocale();
    $contentLocale = $isAdminUrl ? getContentLocale() : null; // for admin edit contents

    $isEditModel = ($isAdminUrl and !empty($contentLocale) and is_array($contentLocale) and $contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id);

    if ($isAdminUrl and
        !empty($contentLocale) and
        is_array($contentLocale) and
        (
            ($contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id) or
            (
                (!empty($model->parent_id) and $contentLocale['item_id'] == $model->parent_id) or // for category edit page
                (!empty($model->filter_id) and $contentLocale['item_id'] == $model->filter_id) // for filter edit page
            )
        )
    ) {
        $locale = $contentLocale['locale']; // for admin edit contents
    }

    try {
        $locale = !empty($loca) ? $loca : $locale;

        if ($model->getTable() === 'settings' and in_array($model->name, \App\Models\Setting::getSettingsWithDefaultLocal())) {
            $locale = \App\Models\Setting::$defaultSettingsLocale;
        }

        $model->locale = $locale;

        return $model->translate(mb_strtolower($locale))->{$key};
    } catch (\Exception $e) {
        // this conditions get client side

        if (empty($contentLocale) and empty($loca)) { //  first get translate by site default language
            $defaultLocale = getDefaultLocale();

            return getTranslateAttributeValue($model, $key, $defaultLocale);
        } elseif ((!empty($loca) or !$isEditModel) and $loca != 'en' and !empty($model->translations) and count($model->translations)) { // if not translate by site default language get translate by English language
            return getTranslateAttributeValue($model, $key, 'en');
        } else if ((!empty($loca) or !$isEditModel) and !empty($model->translations) and count($model->translations)) { // if not default and English get translate by first locale
            $translations = $model->translations->first();

            return getTranslateAttributeValue($model, $key, $translations->locale);
        }

        return '';
    }
}

function getContentLocale()
{
    return session()->get('edit_content_locale', null);
}

function storeContentLocale($locale, $table, $item_id)
{
    removeContentLocale();

    $data = [
        'locale' => $locale,
        'table' => $table,
        'item_id' => $item_id
    ];

    session()->put('edit_content_locale', $data);
}

function removeContentLocale()
{
    session()->remove('edit_content_locale');
}

function getAgoraResolutions(): array
{
    return [
        '160_120', '120_120', '320_180', '180_180', '240_180', '320_240', '240_240', '424_240', '640_360', '360_360',
        '640_360', '360_360', '480_360', '480_360', '640_480', '480_480', '640_480', '480_480', '848_480', '848_480',
        '640_480', '1280_720', '1280_720', '960_720', '960_720', '1920_1080', '1920_1080', '1920_1080'
    ];
}

function handlePriceFormat($price, $decimals = 2, $decimal_separator = '.', $thousands_separator = ''): string
{
    return number_format($price, $decimals, $decimal_separator, $thousands_separator);
}

function handlePrice($price, $showCurrency = true, $format = false, $coursePagePrice = false)
{
    $priceDisplay = getFinancialSettings('price_display') ?? 'only_price';

    if ($priceDisplay != 'only_price') {
        $tax = getFinancialSettings('tax') ?? 0;

        if ($tax > 0) {
            $taxPrice = $price * $tax / 100;

            if ($priceDisplay == 'total_price') {
                $price = $price + $taxPrice;

                if ($format) {
                    $price = handlePriceFormat($price);
                }
            } elseif ($priceDisplay == 'price_and_tax') {
                if ($coursePagePrice) {
                    return [
                        'price' => $price,
                        'tax' => $taxPrice
                    ];
                }

                if ($format) {
                    $price = handlePriceFormat($price);
                    $taxPrice = handlePriceFormat($taxPrice);
                }

                if ($showCurrency) {
                    $price = addCurrencyToPrice($price);
                    $taxPrice = addCurrencyToPrice($taxPrice);
                }

                $price = $price . '+' . $taxPrice . ' tax';
            }
        }
    } elseif ($format) {
        $price = handlePriceFormat($price);
    }

    if ($coursePagePrice) {
        return [
            'price' => $price,
            'tax' => 0
        ];
    }

    if ($showCurrency and $priceDisplay != 'price_and_tax') {
        $price = addCurrencyToPrice($price);
    }

    return $price;
}

function addCurrencyToPrice($price)
{
    if (!empty($price)) {
        $currency = currencySign();
        $currencyPosition = getFinancialSettings('currency_position');

        switch ($currencyPosition) {
            case 'left':
                $price = $currency . $price;
                break;

            case 'left_with_space':
                $price = $currency . ' ' . $price;
                break;

            case 'right':
                $price = $price . $currency;
                break;

            case 'right_with_space':
                $price = $price . ' ' . $currency;
                break;

            default:
                $price = $currency . $price;
        }
    }

    return $price;
}

/**
 * This text is for the course details page only and should not be used elsewhere. Use the "handlePrice" method for other places.
 * */
function handleCoursePagePrice($price)
{
    $result = handlePrice($price, true, false, true);

    $price = addCurrencyToPrice($result['price']);

    $tax = !empty($result['tax']) ? addCurrencyToPrice($result['tax']) : 0;

    return [
        'price' => $price,
        'tax' => $tax,
    ];
}


function checkShowCookieSecurityDialog()
{
    $show = false;

    if (getFeaturesSettings('cookie_settings_status')) {

        if (auth()->check()) {
            $checkDB = \App\Models\UserCookieSecurity::where('user_id', auth()->id())
                ->first();

            $show = empty($checkDB);
        } else {
            $checkCookie = Cookie::get('cookie-security');

            $show = empty($checkCookie);
        }
    }

    return $show;
}

function getNavbarButton($roleId = null)
{
    if (empty($roleId)) {
        $roleId = \App\Models\Role::getUserRoleId();
    }

    $navButton = \App\Models\NavbarButton::where('role_id', $roleId)->first();

    return $navButton;
}
