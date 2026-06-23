<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banks = [
            [
                'id'=> 132,
                'code'=> '560',
                'legal_name'=> 'Page MFBank',
              ],
              [
                'id'=> 133,
                'code'=> '304',
                'legal_name'=> 'Stanbic Mobile Money',
              ],
              [
                'id'=> 134,
                'code'=> '308',
                'legal_name'=> 'FortisMobile',
              ],
              [
                'id'=> 135,
                'code'=> '328',
                'legal_name'=> 'TagPay',
              ],
              [
                'id'=> 136,
                'code'=> '309',
                'legal_name'=> 'FBNMobile',
              ],
              [
                'id'=> 137,
                'code'=> '011',
                'legal_name'=> 'First Bank of Nigeria',
              ],
              [
                'id'=> 138,
                'code'=> '326',
                'legal_name'=> 'Sterling Mobile',
              ],
              [
                'id'=> 139,
                'code'=> '990',
                'legal_name'=> 'Omoluabi Mortgage Bank',
              ],
              [
                'id'=> 140,
                'code'=> '311',
                'legal_name'=> 'ReadyCash (Parkway)',
              ],
              [
                'id'=> 141,
                'code'=> '057',
                'legal_name'=> 'Zenith Bank',
              ],
              [
                'id'=> 142,
                'code'=> '068',
                'legal_name'=> 'Standard Chartered Bank',
              ],
              [
                'id'=> 143,
                'code'=> '306',
                'legal_name'=> 'eTranzact',
              ],
              [
                'id'=> 144,
                'code'=> '070',
                'legal_name'=> 'Fidelity Bank',
              ],
              [
                'id'=> 145,
                'code'=> '023',
                'legal_name'=> 'CitiBank',
              ],
              [
                'id'=> 146,
                'code'=> '215',
                'legal_name'=> 'Unity Bank',
              ],
              [
                'id'=> 147,
                'code'=> '323',
                'legal_name'=> 'Access Money',
              ],
              [
                'id'=> 148,
                'code'=> '302',
                'legal_name'=> 'Eartholeum',
              ],
              [
                'id'=> 149,
                'code'=> '324',
                'legal_name'=> 'Hedonmark',
              ],
              [
                'id'=> 150,
                'code'=> '325',
                'legal_name'=> 'MoneyBox',
              ],
              [
                'id'=> 151,
                'code'=> '301',
                'legal_name'=> 'JAIZ Bank',
              ],
              [
                'id'=> 152,
                'code'=> '050',
                'legal_name'=> 'Ecobank Plc',
              ],
              [
                'id'=> 153,
                'code'=> '307',
                'legal_name'=> 'EcoMobile',
              ],
              [
                'id'=> 154,
                'code'=> '318',
                'legal_name'=> 'Fidelity Mobile',
              ],
              [
                'id'=> 155,
                'code'=> '319',
                'legal_name'=> 'TeasyMobile',
              ],
              [
                'id'=> 156,
                'code'=> '999',
                'legal_name'=> 'NIP Virtual Bank',
              ],
              [
                'id'=> 157,
                'code'=> '320',
                'legal_name'=> 'VTNetworks',
              ],
              [
                'id'=> 158,
                'code'=> '221',
                'legal_name'=> 'Stanbic IBTC Bank',
              ],
              [
                'id'=> 159,
                'code'=> '501',
                'legal_name'=> 'Fortis Microfinance Bank',
              ],
              [
                'id'=> 160,
                'code'=> '329',
                'legal_name'=> 'PayAttitude Online',
              ],
              [
                'id'=> 161,
                'code'=> '322',
                'legal_name'=> 'ZenithMobile',
              ],
              [
                'id'=> 162,
                'code'=> '303',
                'legal_name'=> 'ChamsMobile',
              ],
              [
                'id'=> 163,
                'code'=> '403',
                'legal_name'=> 'SafeTrust Mortgage Bank',
              ],
              [
                'id'=> 164,
                'code'=> '551',
                'legal_name'=> 'Covenant Microfinance Bank',
              ],
              [
                'id'=> 165,
                'code'=> '415',
                'legal_name'=> 'Imperial Homes Mortgage Bank',
              ],
              [
                'id'=> 166,
                'code'=> '552',
                'legal_name'=> 'NPF MicroFinance Bank',
              ],
              [
                'id'=> 167,
                'code'=> '526',
                'legal_name'=> 'Parralex',
              ],
              [
                'id'=> 168,
                'code'=> '035',
                'legal_name'=> 'Wema Bank',
              ],
              [
                'id'=> 169,
                'code'=> '084',
                'legal_name'=> 'Enterprise Bank',
              ],
              [
                'id'=> 170,
                'code'=> '063',
                'legal_name'=> 'Diamond Bank',
              ],
              [
                'id'=> 171,
                'code'=> '305',
                'legal_name'=> 'Paycom',
              ],
              [
                'id'=> 172,
                'code'=> '100',
                'legal_name'=> 'SunTrust Bank',
              ],
              [
                'id'=> 173,
                'code'=> '317',
                'legal_name'=> 'Cellulant',
              ],
              [
                'id'=> 174,
                'code'=> '401',
                'legal_name'=> 'ASO Savings and & Loans',
              ],
              [
                'id'=> 175,
                'code'=> '030',
                'legal_name'=> 'Heritage',
              ],
              [
                'id'=> 176,
                'code'=> '402',
                'legal_name'=> 'Jubilee Life Mortgage Bank',
              ],
              [
                'id'=> 177,
                'code'=> '058',
                'legal_name'=> 'GTBank Plc',
              ],
              [
                'id'=> 178,
                'code'=> '032',
                'legal_name'=> 'Union Bank',
              ],
              [
                'id'=> 179,
                'code'=> '232',
                'legal_name'=> 'Sterling Bank',
              ],
              [
                'id'=> 180,
                'code'=> '076',
                'legal_name'=> 'Skye Bank',
              ],
              [
                'id'=> 181,
                'code'=> '082',
                'legal_name'=> 'Keystone Bank',
              ],
              [
                'id'=> 182,
                'code'=> '327',
                'legal_name'=> 'Pagatech',
              ],
              [
                'id'=> 183,
                'code'=> '559',
                'legal_name'=> 'Coronation Merchant Bank',
              ],
              [
                'id'=> 184,
                'code'=> '601',
                'legal_name'=> 'FSDH',
              ],
              [
                'id'=> 185,
                'code'=> '313',
                'legal_name'=> 'Mkudi',
              ],
              [
                'id'=> 186,
                'code'=> '214',
                'legal_name'=> 'First City Monument Bank',
              ],
              [
                'id'=> 187,
                'code'=> '314',
                'legal_name'=> 'FET',
              ],
              [
                'id'=> 188,
                'code'=> '523',
                'legal_name'=> 'Trustbond',
              ],
              [
                'id'=> 189,
                'code'=> '315',
                'legal_name'=> 'GTMobile',
              ],
              [
                'id'=> 190,
                'code'=> '033',
                'legal_name'=> 'United Bank for Africa',
              ],
              [
                'id'=> 191,
                'code'=> '044',
                'legal_name'=> 'Access Bank',
              ],
              [
                'id'=> 567,
                'code'=> '90115',
                'legal_name'=> 'TCF MFB',
              ]
        ];

        Bank::insert($banks);
    }
}
