<?php
namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'id'         => 1,
                'label'       => 'Afghanistan',
                'code' => 'af',
            ],
            [
                'id'         => 2,
                'label'       => 'Albania',
                'code' => 'al',
            ],
            [
                'id'         => 3,
                'label'       => 'Algeria',
                'code' => 'dz',
            ],
            [
                'id'         => 4,
                'label'       => 'American Samoa',
                'code' => 'as',
            ],
            [
                'id'         => 5,
                'label'       => 'Andorra',
                'code' => 'ad',
            ],
            [
                'id'         => 6,
                'label'       => 'Angola',
                'code' => 'ao',
            ],
            [
                'id'         => 7,
                'label'       => 'Anguilla',
                'code' => 'ai',
            ],
            [
                'id'         => 8,
                'label'       => 'Antarctica',
                'code' => 'aq',
            ],
            [
                'id'         => 9,
                'label'       => 'Antigua and Barbuda',
                'code' => 'ag',
            ],
            [
                'id'         => 10,
                'label'       => 'Argentina',
                'code' => 'ar',
            ],
            [
                'id'         => 11,
                'label'       => 'Armenia',
                'code' => 'am',
            ],
            [
                'id'         => 12,
                'label'       => 'Aruba',
                'code' => 'aw',
            ],
            [
                'id'         => 13,
                'label'       => 'Australia',
                'code' => 'au',
            ],
            [
                'id'         => 14,
                'label'       => 'Austria',
                'code' => 'at',
            ],
            [
                'id'         => 15,
                'label'       => 'Azerbaijan',
                'code' => 'az',
            ],
            [
                'id'         => 16,
                'label'       => 'Bahamas',
                'code' => 'bs',
            ],
            [
                'id'         => 17,
                'label'       => 'Bahrain',
                'code' => 'bh',
            ],
            [
                'id'         => 18,
                'label'       => 'Bangladesh',
                'code' => 'bd',
            ],
            [
                'id'         => 19,
                'label'       => 'Barbados',
                'code' => 'bb',
            ],
            [
                'id'         => 20,
                'label'       => 'Belarus',
                'code' => 'by',
            ],
            [
                'id'         => 21,
                'label'       => 'Belgium',
                'code' => 'be',
            ],
            [
                'id'         => 22,
                'label'       => 'Belize',
                'code' => 'bz',
            ],
            [
                'id'         => 23,
                'label'       => 'Benin',
                'code' => 'bj',
            ],
            [
                'id'         => 24,
                'label'       => 'Bermuda',
                'code' => 'bm',
            ],
            [
                'id'         => 25,
                'label'       => 'Bhutan',
                'code' => 'bt',
            ],
            [
                'id'         => 26,
                'label'       => 'Bolivia',
                'code' => 'bo',
            ],
            [
                'id'         => 27,
                'label'       => 'Bosnia and Herzegovina',
                'code' => 'ba',
            ],
            [
                'id'         => 28,
                'label'       => 'Botswana',
                'code' => 'bw',
            ],
            [
                'id'         => 29,
                'label'       => 'Brazil',
                'code' => 'br',
            ],
            [
                'id'         => 30,
                'label'       => 'British Indian Ocean Territory',
                'code' => 'io',
            ],
            [
                'id'         => 31,
                'label'       => 'British Virgin Islands',
                'code' => 'vg',
            ],
            [
                'id'         => 32,
                'label'       => 'Brunei',
                'code' => 'bn',
            ],
            [
                'id'         => 33,
                'label'       => 'Bulgaria',
                'code' => 'bg',
            ],
            [
                'id'         => 34,
                'label'       => 'Burkina Faso',
                'code' => 'bf',
            ],
            [
                'id'         => 35,
                'label'       => 'Burundi',
                'code' => 'bi',
            ],
            [
                'id'         => 36,
                'label'       => 'Cambodia',
                'code' => 'kh',
            ],
            [
                'id'         => 37,
                'label'       => 'Cameroon',
                'code' => 'cm',
            ],
            [
                'id'         => 38,
                'label'       => 'Canada',
                'code' => 'ca',
            ],
            [
                'id'         => 39,
                'label'       => 'Cape Verde',
                'code' => 'cv',
            ],
            [
                'id'         => 40,
                'label'       => 'Cayman Islands',
                'code' => 'ky',
            ],
            [
                'id'         => 41,
                'label'       => 'Central African Republic',
                'code' => 'cf',
            ],
            [
                'id'         => 42,
                'label'       => 'Chad',
                'code' => 'td',
            ],
            [
                'id'         => 43,
                'label'       => 'Chile',
                'code' => 'cl',
            ],
            [
                'id'         => 44,
                'label'       => 'China',
                'code' => 'cn',
            ],
            [
                'id'         => 45,
                'label'       => 'Christmas Island',
                'code' => 'cx',
            ],
            [
                'id'         => 46,
                'label'       => 'Cocos Islands',
                'code' => 'cc',
            ],
            [
                'id'         => 47,
                'label'       => 'Colombia',
                'code' => 'co',
            ],
            [
                'id'         => 48,
                'label'       => 'Comoros',
                'code' => 'km',
            ],
            [
                'id'         => 49,
                'label'       => 'Cook Islands',
                'code' => 'ck',
            ],
            [
                'id'         => 50,
                'label'       => 'Costa Rica',
                'code' => 'cr',
            ],
            [
                'id'         => 51,
                'label'       => 'Croatia',
                'code' => 'hr',
            ],
            [
                'id'         => 52,
                'label'       => 'Cuba',
                'code' => 'cu',
            ],
            [
                'id'         => 53,
                'label'       => 'Curacao',
                'code' => 'cw',
            ],
            [
                'id'         => 54,
                'label'       => 'Cyprus',
                'code' => 'cy',
            ],
            [
                'id'         => 55,
                'label'       => 'Czech Republic',
                'code' => 'cz',
            ],
            [
                'id'         => 56,
                'label'       => 'Democratic Republic of the Congo',
                'code' => 'cd',
            ],
            [
                'id'         => 57,
                'label'       => 'Denmark',
                'code' => 'dk',
            ],
            [
                'id'         => 58,
                'label'       => 'Djibouti',
                'code' => 'dj',
            ],
            [
                'id'         => 59,
                'label'       => 'Dominica',
                'code' => 'dm',
            ],
            [
                'id'         => 60,
                'label'       => 'Dominican Republic',
                'code' => 'do',
            ],
            [
                'id'         => 61,
                'label'       => 'East Timor',
                'code' => 'tl',
            ],
            [
                'id'         => 62,
                'label'       => 'Ecuador',
                'code' => 'ec',
            ],
            [
                'id'         => 63,
                'label'       => 'Egypt',
                'code' => 'eg',
            ],
            [
                'id'         => 64,
                'label'       => 'El Salvador',
                'code' => 'sv',
            ],
            [
                'id'         => 65,
                'label'       => 'Equatorial Guinea',
                'code' => 'gq',
            ],
            [
                'id'         => 66,
                'label'       => 'Eritrea',
                'code' => 'er',
            ],
            [
                'id'         => 67,
                'label'       => 'Estonia',
                'code' => 'ee',
            ],
            [
                'id'         => 68,
                'label'       => 'Ethiopia',
                'code' => 'et',
            ],
            [
                'id'         => 69,
                'label'       => 'Falkland Islands',
                'code' => 'fk',
            ],
            [
                'id'         => 70,
                'label'       => 'Faroe Islands',
                'code' => 'fo',
            ],
            [
                'id'         => 71,
                'label'       => 'Fiji',
                'code' => 'fj',
            ],
            [
                'id'         => 72,
                'label'       => 'Finland',
                'code' => 'fi',
            ],
            [
                'id'         => 73,
                'label'       => 'France',
                'code' => 'fr',
            ],
            [
                'id'         => 74,
                'label'       => 'French Polynesia',
                'code' => 'pf',
            ],
            [
                'id'         => 75,
                'label'       => 'Gabon',
                'code' => 'ga',
            ],
            [
                'id'         => 76,
                'label'       => 'Gambia',
                'code' => 'gm',
            ],
            [
                'id'         => 77,
                'label'       => 'Georgia',
                'code' => 'ge',
            ],
            [
                'id'         => 78,
                'label'       => 'Germany',
                'code' => 'de',
            ],
            [
                'id'         => 79,
                'label'       => 'Ghana',
                'code' => 'gh',
            ],
            [
                'id'         => 80,
                'label'       => 'Gibraltar',
                'code' => 'gi',
            ],
            [
                'id'         => 81,
                'label'       => 'Greece',
                'code' => 'gr',
            ],
            [
                'id'         => 82,
                'label'       => 'Greenland',
                'code' => 'gl',
            ],
            [
                'id'         => 83,
                'label'       => 'Grenada',
                'code' => 'gd',
            ],
            [
                'id'         => 84,
                'label'       => 'Guam',
                'code' => 'gu',
            ],
            [
                'id'         => 85,
                'label'       => 'Guatemala',
                'code' => 'gt',
            ],
            [
                'id'         => 86,
                'label'       => 'Guernsey',
                'code' => 'gg',
            ],
            [
                'id'         => 87,
                'label'       => 'Guinea',
                'code' => 'gn',
            ],
            [
                'id'         => 88,
                'label'       => 'Guinea-Bissau',
                'code' => 'gw',
            ],
            [
                'id'         => 89,
                'label'       => 'Guyana',
                'code' => 'gy',
            ],
            [
                'id'         => 90,
                'label'       => 'Haiti',
                'code' => 'ht',
            ],
            [
                'id'         => 91,
                'label'       => 'Honduras',
                'code' => 'hn',
            ],
            [
                'id'         => 92,
                'label'       => 'Hong Kong',
                'code' => 'hk',
            ],
            [
                'id'         => 93,
                'label'       => 'Hungary',
                'code' => 'hu',
            ],
            [
                'id'         => 94,
                'label'       => 'Iceland',
                'code' => 'is',
            ],
            [
                'id'         => 95,
                'label'       => 'India',
                'code' => 'in',
            ],
            [
                'id'         => 96,
                'label'       => 'Indonesia',
                'code' => 'id',
            ],
            [
                'id'         => 97,
                'label'       => 'Iran',
                'code' => 'ir',
            ],
            [
                'id'         => 98,
                'label'       => 'Iraq',
                'code' => 'iq',
            ],
            [
                'id'         => 99,
                'label'       => 'Ireland',
                'code' => 'ie',
            ],
            [
                'id'         => 100,
                'label'       => 'Isle of Man',
                'code' => 'im',
            ],
            [
                'id'         => 101,
                'label'       => 'Israel',
                'code' => 'il',
            ],
            [
                'id'         => 102,
                'label'       => 'Italy',
                'code' => 'it',
            ],
            [
                'id'         => 103,
                'label'       => 'Ivory Coast',
                'code' => 'ci',
            ],
            [
                'id'         => 104,
                'label'       => 'Jamaica',
                'code' => 'jm',
            ],
            [
                'id'         => 105,
                'label'       => 'Japan',
                'code' => 'jp',
            ],
            [
                'id'         => 106,
                'label'       => 'Jersey',
                'code' => 'je',
            ],
            [
                'id'         => 107,
                'label'       => 'Jordan',
                'code' => 'jo',
            ],
            [
                'id'         => 108,
                'label'       => 'Kazakhstan',
                'code' => 'kz',
            ],
            [
                'id'         => 109,
                'label'       => 'Kenya',
                'code' => 'ke',
            ],
            [
                'id'         => 110,
                'label'       => 'Kiribati',
                'code' => 'ki',
            ],
            [
                'id'         => 111,
                'label'       => 'Kosovo',
                'code' => 'xk',
            ],
            [
                'id'         => 112,
                'label'       => 'Kuwait',
                'code' => 'kw',
            ],
            [
                'id'         => 113,
                'label'       => 'Kyrgyzstan',
                'code' => 'kg',
            ],
            [
                'id'         => 114,
                'label'       => 'Laos',
                'code' => 'la',
            ],
            [
                'id'         => 115,
                'label'       => 'Latvia',
                'code' => 'lv',
            ],
            [
                'id'         => 116,
                'label'       => 'Lebanon',
                'code' => 'lb',
            ],
            [
                'id'         => 117,
                'label'       => 'Lesotho',
                'code' => 'ls',
            ],
            [
                'id'         => 118,
                'label'       => 'Liberia',
                'code' => 'lr',
            ],
            [
                'id'         => 119,
                'label'       => 'Libya',
                'code' => 'ly',
            ],
            [
                'id'         => 120,
                'label'       => 'Liechtenstein',
                'code' => 'li',
            ],
            [
                'id'         => 121,
                'label'       => 'Lithuania',
                'code' => 'lt',
            ],
            [
                'id'         => 122,
                'label'       => 'Luxembourg',
                'code' => 'lu',
            ],
            [
                'id'         => 123,
                'label'       => 'Macau',
                'code' => 'mo',
            ],
            [
                'id'         => 124,
                'label'       => 'Macedonia',
                'code' => 'mk',
            ],
            [
                'id'         => 125,
                'label'       => 'Madagascar',
                'code' => 'mg',
            ],
            [
                'id'         => 126,
                'label'       => 'Malawi',
                'code' => 'mw',
            ],
            [
                'id'         => 127,
                'label'       => 'Malaysia',
                'code' => 'my',
            ],
            [
                'id'         => 128,
                'label'       => 'Maldives',
                'code' => 'mv',
            ],
            [
                'id'         => 129,
                'label'       => 'Mali',
                'code' => 'ml',
            ],
            [
                'id'         => 130,
                'label'       => 'Malta',
                'code' => 'mt',
            ],
            [
                'id'         => 131,
                'label'       => 'Marshall Islands',
                'code' => 'mh',
            ],
            [
                'id'         => 132,
                'label'       => 'Mauritania',
                'code' => 'mr',
            ],
            [
                'id'         => 133,
                'label'       => 'Mauritius',
                'code' => 'mu',
            ],
            [
                'id'         => 134,
                'label'       => 'Mayotte',
                'code' => 'yt',
            ],
            [
                'id'         => 135,
                'label'       => 'Mexico',
                'code' => 'mx',
            ],
            [
                'id'         => 136,
                'label'       => 'Micronesia',
                'code' => 'fm',
            ],
            [
                'id'         => 137,
                'label'       => 'Moldova',
                'code' => 'md',
            ],
            [
                'id'         => 138,
                'label'       => 'Monaco',
                'code' => 'mc',
            ],
            [
                'id'         => 139,
                'label'       => 'Mongolia',
                'code' => 'mn',
            ],
            [
                'id'         => 140,
                'label'       => 'Montenegro',
                'code' => 'me',
            ],
            [
                'id'         => 141,
                'label'       => 'Montserrat',
                'code' => 'ms',
            ],
            [
                'id'         => 142,
                'label'       => 'Morocco',
                'code' => 'ma',
            ],
            [
                'id'         => 143,
                'label'       => 'Mozambique',
                'code' => 'mz',
            ],
            [
                'id'         => 144,
                'label'       => 'Myanmar',
                'code' => 'mm',
            ],
            [
                'id'         => 145,
                'label'       => 'Namibia',
                'code' => 'na',
            ],
            [
                'id'         => 146,
                'label'       => 'Nauru',
                'code' => 'nr',
            ],
            [
                'id'         => 147,
                'label'       => 'Nepal',
                'code' => 'np',
            ],
            [
                'id'         => 148,
                'label'       => 'Netherlands',
                'code' => 'nl',
            ],
            [
                'id'         => 149,
                'label'       => 'Netherlands Antilles',
                'code' => 'an',
            ],
            [
                'id'         => 150,
                'label'       => 'New Caledonia',
                'code' => 'nc',
            ],
            [
                'id'         => 151,
                'label'       => 'New Zealand',
                'code' => 'nz',
            ],
            [
                'id'         => 152,
                'label'       => 'Nicaragua',
                'code' => 'ni',
            ],
            [
                'id'         => 153,
                'label'       => 'Niger',
                'code' => 'ne',
            ],
            [
                'id'         => 154,
                'label'       => 'Nigeria',
                'code' => 'ng',
            ],
            [
                'id'         => 155,
                'label'       => 'Niue',
                'code' => 'nu',
            ],
            [
                'id'         => 156,
                'label'       => 'North Korea',
                'code' => 'kp',
            ],
            [
                'id'         => 157,
                'label'       => 'Northern Mariana Islands',
                'code' => 'mp',
            ],
            [
                'id'         => 158,
                'label'       => 'Norway',
                'code' => 'no',
            ],
            [
                'id'         => 159,
                'label'       => 'Oman',
                'code' => 'om',
            ],
            [
                'id'         => 160,
                'label'       => 'Pakistan',
                'code' => 'pk',
            ],
            [
                'id'         => 161,
                'label'       => 'Palau',
                'code' => 'pw',
            ],
            [
                'id'         => 162,
                'label'       => 'Palestine',
                'code' => 'ps',
            ],
            [
                'id'         => 163,
                'label'       => 'Panama',
                'code' => 'pa',
            ],
            [
                'id'         => 164,
                'label'       => 'Papua New Guinea',
                'code' => 'pg',
            ],
            [
                'id'         => 165,
                'label'       => 'Paraguay',
                'code' => 'py',
            ],
            [
                'id'         => 166,
                'label'       => 'Peru',
                'code' => 'pe',
            ],
            [
                'id'         => 167,
                'label'       => 'Philippines',
                'code' => 'ph',
            ],
            [
                'id'         => 168,
                'label'       => 'Pitcairn',
                'code' => 'pn',
            ],
            [
                'id'         => 169,
                'label'       => 'Poland',
                'code' => 'pl',
            ],
            [
                'id'         => 170,
                'label'       => 'Portugal',
                'code' => 'pt',
            ],
            [
                'id'         => 171,
                'label'       => 'Puerto Rico',
                'code' => 'pr',
            ],
            [
                'id'         => 172,
                'label'       => 'Qatar',
                'code' => 'qa',
            ],
            [
                'id'         => 173,
                'label'       => 'Republic of the Congo',
                'code' => 'cg',
            ],
            [
                'id'         => 174,
                'label'       => 'Reunion',
                'code' => 're',
            ],
            [
                'id'         => 175,
                'label'       => 'Romania',
                'code' => 'ro',
            ],
            [
                'id'         => 176,
                'label'       => 'Russia',
                'code' => 'ru',
            ],
            [
                'id'         => 177,
                'label'       => 'Rwanda',
                'code' => 'rw',
            ],
            [
                'id'         => 178,
                'label'       => 'Saint Barthelemy',
                'code' => 'bl',
            ],
            [
                'id'         => 179,
                'label'       => 'Saint Helena',
                'code' => 'sh',
            ],
            [
                'id'         => 180,
                'label'       => 'Saint Kitts and Nevis',
                'code' => 'kn',
            ],
            [
                'id'         => 181,
                'label'       => 'Saint Lucia',
                'code' => 'lc',
            ],
            [
                'id'         => 182,
                'label'       => 'Saint Martin',
                'code' => 'mf',
            ],
            [
                'id'         => 183,
                'label'       => 'Saint Pierre and Miquelon',
                'code' => 'pm',
            ],
            [
                'id'         => 184,
                'label'       => 'Saint Vincent and the Grenadines',
                'code' => 'vc',
            ],
            [
                'id'         => 185,
                'label'       => 'Samoa',
                'code' => 'ws',
            ],
            [
                'id'         => 186,
                'label'       => 'San Marino',
                'code' => 'sm',
            ],
            [
                'id'         => 187,
                'label'       => 'Sao Tome and Principe',
                'code' => 'st',
            ],
            [
                'id'         => 188,
                'label'       => 'Saudi Arabia',
                'code' => 'sa',
            ],
            [
                'id'         => 189,
                'label'       => 'Senegal',
                'code' => 'sn',
            ],
            [
                'id'         => 190,
                'label'       => 'Serbia',
                'code' => 'rs',
            ],
            [
                'id'         => 191,
                'label'       => 'Seychelles',
                'code' => 'sc',
            ],
            [
                'id'         => 192,
                'label'       => 'Sierra Leone',
                'code' => 'sl',
            ],
            [
                'id'         => 193,
                'label'       => 'Singapore',
                'code' => 'sg',
            ],
            [
                'id'         => 194,
                'label'       => 'Sint Maarten',
                'code' => 'sx',
            ],
            [
                'id'         => 195,
                'label'       => 'Slovakia',
                'code' => 'sk',
            ],
            [
                'id'         => 196,
                'label'       => 'Slovenia',
                'code' => 'si',
            ],
            [
                'id'         => 197,
                'label'       => 'Solomon Islands',
                'code' => 'sb',
            ],
            [
                'id'         => 198,
                'label'       => 'Somalia',
                'code' => 'so',
            ],
            [
                'id'         => 199,
                'label'       => 'South Africa',
                'code' => 'za',
            ],
            [
                'id'         => 200,
                'label'       => 'South Korea',
                'code' => 'kr',
            ],
            [
                'id'         => 201,
                'label'       => 'South Sudan',
                'code' => 'ss',
            ],
            [
                'id'         => 202,
                'label'       => 'Spain',
                'code' => 'es',
            ],
            [
                'id'         => 203,
                'label'       => 'Sri Lanka',
                'code' => 'lk',
            ],
            [
                'id'         => 204,
                'label'       => 'Sudan',
                'code' => 'sd',
            ],
            [
                'id'         => 205,
                'label'       => 'Suriname',
                'code' => 'sr',
            ],
            [
                'id'         => 206,
                'label'       => 'Svalbard and Jan Mayen',
                'code' => 'sj',
            ],
            [
                'id'         => 207,
                'label'       => 'Swaziland',
                'code' => 'sz',
            ],
            [
                'id'         => 208,
                'label'       => 'Sweden',
                'code' => 'se',
            ],
            [
                'id'         => 209,
                'label'       => 'Switzerland',
                'code' => 'ch',
            ],
            [
                'id'         => 210,
                'label'       => 'Syria',
                'code' => 'sy',
            ],
            [
                'id'         => 211,
                'label'       => 'Taiwan',
                'code' => 'tw',
            ],
            [
                'id'         => 212,
                'label'       => 'Tajikistan',
                'code' => 'tj',
            ],
            [
                'id'         => 213,
                'label'       => 'Tanzania',
                'code' => 'tz',
            ],
            [
                'id'         => 214,
                'label'       => 'Thailand',
                'code' => 'th',
            ],
            [
                'id'         => 215,
                'label'       => 'Togo',
                'code' => 'tg',
            ],
            [
                'id'         => 216,
                'label'       => 'Tokelau',
                'code' => 'tk',
            ],
            [
                'id'         => 217,
                'label'       => 'Tonga',
                'code' => 'to',
            ],
            [
                'id'         => 218,
                'label'       => 'Trinidad and Tobago',
                'code' => 'tt',
            ],
            [
                'id'         => 219,
                'label'       => 'Tunisia',
                'code' => 'tn',
            ],
            [
                'id'         => 220,
                'label'       => 'Turkey',
                'code' => 'tr',
            ],
            [
                'id'         => 221,
                'label'       => 'Turkmenistan',
                'code' => 'tm',
            ],
            [
                'id'         => 222,
                'label'       => 'Turks and Caicos Islands',
                'code' => 'tc',
            ],
            [
                'id'         => 223,
                'label'       => 'Tuvalu',
                'code' => 'tv',
            ],
            [
                'id'         => 224,
                'label'       => 'U.S. Virgin Islands',
                'code' => 'vi',
            ],
            [
                'id'         => 225,
                'label'       => 'Uganda',
                'code' => 'ug',
            ],
            [
                'id'         => 226,
                'label'       => 'Ukraine',
                'code' => 'ua',
            ],
            [
                'id'         => 227,
                'label'       => 'United Arab Emirates',
                'code' => 'ae',
            ],
            [
                'id'         => 228,
                'label'       => 'United Kingdom',
                'code' => 'gb',
            ],
            [
                'id'         => 229,
                'label'       => 'United States',
                'code' => 'us',
            ],
            [
                'id'         => 230,
                'label'       => 'Uruguay',
                'code' => 'uy',
            ],
            [
                'id'         => 231,
                'label'       => 'Uzbekistan',
                'code' => 'uz',
            ],
            [
                'id'         => 232,
                'label'       => 'Vanuatu',
                'code' => 'vu',
            ],
            [
                'id'         => 233,
                'label'       => 'Vatican',
                'code' => 'va',
            ],
            [
                'id'         => 234,
                'label'       => 'Venezuela',
                'code' => 've',
            ],
            [
                'id'         => 235,
                'label'       => 'Vietnam',
                'code' => 'vn',
            ],
            [
                'id'         => 236,
                'label'       => 'Wallis and Futuna',
                'code' => 'wf',
            ],
            [
                'id'         => 237,
                'label'       => 'Western Sahara',
                'code' => 'eh',
            ],
            [
                'id'         => 238,
                'label'       => 'Yemen',
                'code' => 'ye',
            ],
            [
                'id'         => 239,
                'label'       => 'Zambia',
                'code' => 'zm',
            ],
            [
                'id'         => 240,
                'label'       => 'Zimbabwe',
                'code' => 'zw',
            ],
        ];

        Country::insert($countries);
    }
}
