<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\admin;
use App\Models\daftar_bank;
use App\Models\penyedia_lapangan;
use App\Models\rekening;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = User::create([
        'email' => 'superadmin@gmail.com',
        'password' => Hash::make('1'),
        'role' => 'superadmin',
        ]);

        $Admin = User::create([
        'email' => 'admin@gmail.com',
        'password' => Hash::make('1'),
        'role' => 'admin',
        ]);

        $profileAdmin = admin::create([
            'id_user' => $Admin->id,
            'nama' => 'gawr',
            'no_hp' => '08994805924',
        ]);

        $bank = [
            [
                "kode_bank" => "002",
                "nama_bank" => "BANK BRI",
            ],
            [
                "kode_bank" => "003",
                "nama_bank" => "BANK EKSPOR INDONESIA",
            ],
            [
                "kode_bank" => "008",
                "nama_bank" => "BANK MANDIRI",
            ],
            [
                "kode_bank" => "009",
                "nama_bank" => "BANK BNI",
            ],
            [
                "kode_bank" => "011",
                "nama_bank" => "BANK DANAMON",
            ],
            [
                "kode_bank" => "013",
                "nama_bank" => "PERMATA BANK",
            ],
            [
                "kode_bank" => "014",
                "nama_bank" => "BANK BCA",
            ],
            [
                "kode_bank" => "016",
                "nama_bank" => "BANK BII",
            ],
            [
                "kode_bank" => "019",
                "nama_bank" => "BANK PANIN",
            ],
            [
                "kode_bank" => "020",
                "nama_bank" => "BANK ARTA NIAGA KENCANA",
            ],
            [
                "kode_bank" => "022",
                "nama_bank" => "BANK NIAGA",
            ],
            [
                "kode_bank" => "023",
                "nama_bank" => "BANK BUANA IND",
            ],
            [
                "kode_bank" => "026",
                "nama_bank" => "BANK LIPPO",
            ],
            [
                "kode_bank" => "028",
                "nama_bank" => "BANK NISP",
            ],
            [
                "kode_bank" => "030",
                "nama_bank" => "AMERICAN EXPRESS BANK LTD",
            ],
            [
                "kode_bank" => "031",
                "nama_bank" => "CITIBANK N.A.",
            ],
            [
                "kode_bank" => "032",
                "nama_bank" => "JP. MORGAN CHASE BANK, N.A.",
            ],
            [
                "kode_bank" => "033",
                "nama_bank" => "BANK OF AMERICA, N.A",
            ],
            [
                "kode_bank" => "034",
                "nama_bank" => "ING INDONESIA BANK",
            ],
            [
                "kode_bank" => "036",
                "nama_bank" => "BANK MULTICOR TBK.",
            ],
            [
                "kode_bank" => "037",
                "nama_bank" => "BANK ARTHA GRAHA",
            ],
            [
                "kode_bank" => "039",
                "nama_bank" => "BANK CREDIT AGRICOLE INDOSUEZ",
            ],
            [
                "kode_bank" => "040",
                "nama_bank" => "THE BANGKOK BANK COMP. LTD",
            ],
            [
                "kode_bank" => "041",
                "nama_bank" => "THE HONGKONG & SHANGHAI B.C.",
            ],
            [
                "kode_bank" => "042",
                "nama_bank" => "THE BANK OF TOKYO MITSUBISHI UFJ LTD",
            ],
            [
                "kode_bank" => "045",
                "nama_bank" => "BANK SUMITOMO MITSUI INDONESIA",
            ],
            [
                "kode_bank" => "046",
                "nama_bank" => "BANK DBS INDONESIA",
            ],
            [
                "kode_bank" => "047",
                "nama_bank" => "BANK RESONA PERDANIA",
            ],
            [
                "kode_bank" => "048",
                "nama_bank" => "BANK MIZUHO INDONESIA",
            ],
            [
                "kode_bank" => "050",
                "nama_bank" => "STANDARD CHARTERED BANK",
            ],
            [
                "kode_bank" => "052",
                "nama_bank" => "BANK ABN AMRO",
            ],
            [
                "kode_bank" => "053",
                "nama_bank" => "BANK KEPPEL TATLEE BUANA",
            ],
            [
                "kode_bank" => "054",
                "nama_bank" => "BANK CAPITAL INDONESIA, TBK.",
            ],
            [
                "kode_bank" => "057",
                "nama_bank" => "BANK BNP PARIBAS INDONESIA",
            ],
            [
                "kode_bank" => "058",
                "nama_bank" => "BANK UOB INDONESIA",
            ],
            [
                "kode_bank" => "059",
                "nama_bank" => "KOREA EXCHANGE BANK DANAMON",
            ],
            [
                "kode_bank" => "060",
                "nama_bank" => "RABOBANK INTERNASIONAL INDONESIA",
            ],
            [
                "kode_bank" => "061",
                "nama_bank" => "ANZ PANIN BANK",
            ],
            [
                "kode_bank" => "067",
                "nama_bank" => "DEUTSCHE BANK AG.",
            ],
            [
                "kode_bank" => "068",
                "nama_bank" => "BANK WOORI INDONESIA",
            ],
            [
                "kode_bank" => "069",
                "nama_bank" => "BANK OF CHINA LIMITED",
            ],
            [
                "kode_bank" => "076",
                "nama_bank" => "BANK BUMI ARTA",
            ],
            [
                "kode_bank" => "087",
                "nama_bank" => "BANK EKONOMI",
            ],
            [
                "kode_bank" => "088",
                "nama_bank" => "BANK ANTARDAERAH",
            ],
            [
                "kode_bank" => "089",
                "nama_bank" => "BANK HAGA",
            ],
            [
                "kode_bank" => "093",
                "nama_bank" => "BANK IFI",
            ],
            [
                "kode_bank" => "095",
                "nama_bank" => "BANK CENTURY, TBK.",
            ],
            [
                "kode_bank" => "097",
                "nama_bank" => "BANK MAYAPADA",
            ],
            [
                "kode_bank" => "110",
                "nama_bank" => "BANK JABAR",
            ],
            [
                "kode_bank" => "111",
                "nama_bank" => "BANK DKI",
            ],
            [
                "kode_bank" => "112",
                "nama_bank" => "BPD DIY",
            ],
            [
                "kode_bank" => "113",
                "nama_bank" => "BANK JATENG",
            ],
            [
                "kode_bank" => "114",
                "nama_bank" => "BANK JATIM",
            ],
            [
                "kode_bank" => "115",
                "nama_bank" => "BPD JAMBI",
            ],
            [
                "kode_bank" => "116",
                "nama_bank" => "BPD ACEH",
            ],
            [
                "kode_bank" => "117",
                "nama_bank" => "BANK SUMUT",
            ],
            [
                "kode_bank" => "118",
                "nama_bank" => "BANK NAGARI",
            ],
            [
                "kode_bank" => "119",
                "nama_bank" => "BANK RIAU",
            ],
            [
                "kode_bank" => "120",
                "nama_bank" => "BANK SUMSEL",
            ],
            [
                "kode_bank" => "121",
                "nama_bank" => "BANK LAMPUNG",
            ],
            [
                "kode_bank" => "122",
                "nama_bank" => "BPD KALSEL",
            ],
            [
                "kode_bank" => "123",
                "nama_bank" => "BPD KALIMANTAN BARAT",
            ],
            [
                "kode_bank" => "124",
                "nama_bank" => "BPD KALTIM",
            ],
            [
                "kode_bank" => "125",
                "nama_bank" => "BPD KALTENG",
            ],
            [
                "kode_bank" => "126",
                "nama_bank" => "BPD SULSEL",
            ],
            [
                "kode_bank" => "127",
                "nama_bank" => "BANK SULUT",
            ],
            [
                "kode_bank" => "128",
                "nama_bank" => "BPD NTB",
            ],
            [
                "kode_bank" => "129",
                "nama_bank" => "BPD BALI",
            ],
            [
                "kode_bank" => "130",
                "nama_bank" => "BANK NTT",
            ],
            [
                "kode_bank" => "131",
                "nama_bank" => "BANK MALUKU",
            ],
            [
                "kode_bank" => "132",
                "nama_bank" => "BPD PAPUA",
            ],
            [
                "kode_bank" => "133",
                "nama_bank" => "BANK BENGKULU",
            ],
            [
                "kode_bank" => "134",
                "nama_bank" => "BPD SULAWESI TENGAH",
            ],
            [
                "kode_bank" => "135",
                "nama_bank" => "BANK SULTRA",
            ],
            [
                "kode_bank" => "145",
                "nama_bank" => "BANK NUSANTARA PARAHYANGAN",
            ],
            [
                "kode_bank" => "146",
                "nama_bank" => "BANK SWADESI",
            ],
            [
                "kode_bank" => "147",
                "nama_bank" => "BANK MUAMALAT",
            ],
            [
                "kode_bank" => "151",
                "nama_bank" => "BANK MESTIKA",
            ],
            [
                "kode_bank" => "152",
                "nama_bank" => "BANK METRO EXPRESS",
            ],
            [
                "kode_bank" => "153",
                "nama_bank" => "BANK SHINTA INDONESIA",
            ],
            [
                "kode_bank" => "157",
                "nama_bank" => "BANK MASPION",
            ],
            [
                "kode_bank" => "159",
                "nama_bank" => "BANK HAGAKITA",
            ],
            [
                "kode_bank" => "161",
                "nama_bank" => "BANK GANESHA",
            ],
            [
                "kode_bank" => "162",
                "nama_bank" => "BANK WINDU KENTJANA",
            ],
            [
                "kode_bank" => "164",
                "nama_bank" => "HALIM INDONESIA BANK",
            ],
            [
                "kode_bank" => "166",
                "nama_bank" => "BANK HARMONI INTERNATIONAL",
            ],
            [
                "kode_bank" => "167",
                "nama_bank" => "BANK KESAWAN",
            ],
            [
                "kode_bank" => "200",
                "nama_bank" => "BANK TABUNGAN NEGARA (PERSERO)",
            ],
            [
                "kode_bank" => "212",
                "nama_bank" => "BANK HIMPUNAN SAUDARA 1906, TBK .",
            ],
            [
                "kode_bank" => "213",
                "nama_bank" => "BANK TABUNGAN PENSIUNAN NASIONAL",
            ],
            [
                "kode_bank" => "405",
                "nama_bank" => "BANK SWAGUNA",
            ],
            [
                "kode_bank" => "422",
                "nama_bank" => "BANK JASA ARTA",
            ],
            [
                "kode_bank" => "426",
                "nama_bank" => "BANK MEGA",
            ],
            [
                "kode_bank" => "427",
                "nama_bank" => "BANK JASA JAKARTA",
            ],
            [
                "kode_bank" => "441",
                "nama_bank" => "BANK BUKOPIN",
            ],
            [
                "kode_bank" => "451",
                "nama_bank" => "BANK SYARIAH MANDIRI",
            ],
            [
                "kode_bank" => "459",
                "nama_bank" => "BANK BISNIS INTERNASIONAL",
            ],
            [
                "kode_bank" => "466",
                "nama_bank" => "BANK SRI PARTHA",
            ],
            [
                "kode_bank" => "472",
                "nama_bank" => "BANK JASA JAKARTA",
            ],
            [
                "kode_bank" => "484",
                "nama_bank" => "BANK BINTANG MANUNGGAL",
            ],
            [
                "kode_bank" => "485",
                "nama_bank" => "BANK BUMIPUTERA",
            ],
            [
                "kode_bank" => "490",
                "nama_bank" => "BANK YUDHA BHAKTI",
            ],
            [
                "kode_bank" => "491",
                "nama_bank" => "BANK MITRANIAGA",
            ],
            [
                "kode_bank" => "494",
                "nama_bank" => "BANK AGRO NIAGA",
            ],
            [
                "kode_bank" => "498",
                "nama_bank" => "BANK INDOMONEX",
            ],
            [
                "kode_bank" => "501",
                "nama_bank" => "BANK ROYAL INDONESIA",
            ],
            [
                "kode_bank" => "503",
                "nama_bank" => "BANK ALFINDO",
            ],
            [
                "kode_bank" => "506",
                "nama_bank" => "BANK SYARIAH MEGA",
            ],
            [
                "kode_bank" => "513",
                "nama_bank" => "BANK INA PERDANA",
            ],
            [
                "kode_bank" => "517",
                "nama_bank" => "BANK HARFA",
            ],
            [
                "kode_bank" => "520",
                "nama_bank" => "PRIMA MASTER BANK",
            ],
            [
                "kode_bank" => "521",
                "nama_bank" => "BANK PERSYARIKATAN INDONESIA",
            ],
            [
                "kode_bank" => "525",
                "nama_bank" => "BANK AKITA",
            ],
            [
                "kode_bank" => "526",
                "nama_bank" => "LIMAN INTERNATIONAL BANK",
            ],
            [
                "kode_bank" => "531",
                "nama_bank" => "ANGLOMAS INTERNASIONAL BANK",
            ],
            [
                "kode_bank" => "523",
                "nama_bank" => "BANK DIPO INTERNATIONAL",
            ],
            [
                "kode_bank" => "535",
                "nama_bank" => "BANK KESEJAHTERAAN EKONOMI",
            ],
            [
                "kode_bank" => "536",
                "nama_bank" => "BANK UIB",
            ],
            [
                "kode_bank" => "542",
                "nama_bank" => "BANK ARTOS IND",
            ],
            [
                "kode_bank" => "547",
                "nama_bank" => "BANK PURBA DANARTA",
            ],
            [
                "kode_bank" => "548",
                "nama_bank" => "BANK MULTI ARTA SENTOSA",
            ],
            [
                "kode_bank" => "553",
                "nama_bank" => "BANK MAYORA",
            ],
            [
                "kode_bank" => "555",
                "nama_bank" => "BANK INDEX SELINDO",
            ],
            [
                "kode_bank" => "566",
                "nama_bank" => "BANK VICTORIA INTERNATIONAL",
            ],
            [
                "kode_bank" => "558",
                "nama_bank" => "BANK EKSEKUTIF",
            ],
            [
                "kode_bank" => "559",
                "nama_bank" => "CENTRATAMA NASIONAL BANK",
            ],
            [
                "kode_bank" => "562",
                "nama_bank" => "BANK FAMA INTERNASIONAL",
            ],
            [
                "kode_bank" => "564",
                "nama_bank" => "BANK SINAR HARAPAN BALI",
            ],
            [
                "kode_bank" => "567",
                "nama_bank" => "BANK HARDA",
            ],
            [
                "kode_bank" => "945",
                "nama_bank" => "BANK FINCONESIA",
            ],
            [
                "kode_bank" => "946",
                "nama_bank" => "BANK MERINCORP",
            ],
            [
                "kode_bank" => "947",
                "nama_bank" => "BANK MAYBANK INDOCORP",
            ],
            [
                "kode_bank" => "948",
                "nama_bank" => "BANK OCBC – INDONESIA",
            ],
            [
                "kode_bank" => "949",
                "nama_bank" => "BANK CHINA TRUST INDONESIA",
            ],
            [
                "kode_bank" => "950",
                "nama_bank" => "BANK COMMONWEALTH",
            ]
        ];

        foreach ($bank as $daftar_bank) {
            daftar_bank::create($daftar_bank);
        }


        $penyedia = User::create([
            'email' => 'penyedia@gmail.com',
            'password' => Hash::make('1'),
            'role' => 'penyedia',
            'status' => 'belum aktif',
        ]);

        $profilePenyedia = penyedia_lapangan::create([
            'id_user' => $penyedia->id,
            'nama_bisnis' => 'ikada',
            'alamat' => 'batam',
            'jam_buka' => Carbon::parse('08:00:00'),
            'jam_tutup' => Carbon::parse('18:00:00'),
            'no_hp' => '0882392392',
        ]);

        $rekening = rekening::create([
            'kode_bank' => '002',
            'id_penyedia_lapangan' => $profilePenyedia->id,
            'no_rekening' => 123456789,
            'nama_rekening' => 'topan'
        ]);
    }
}
