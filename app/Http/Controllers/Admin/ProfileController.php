<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ProfileController extends Controller
{
    public $profile;
    public function __construct(Profile $profile)
    {
        $this->profile = new BaseService($profile);
    }

    public function index()
    {
        if (\request()->ajax()) {
            $profile = $this->profile->Query();

            $paginate = \request()->get('paginate', 15);
            if (request()->search) {
                $profile->where('nama', 'like', '%' . \request()->search . '%')
                    ->orWhere('nip', 'like', '%' . \request()->search . '%');
            }

            $data['table'] = $profile->paginate($paginate);
            return view('admin.profile._data_profile', $data);
        }
        return view('admin.profile.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = Excel::toArray([], $file)[0];
        $header = array_shift($data);

        foreach ($data as $row) {
            if (count($header) !== count($row)) {
                dd($row);
            }

            $rowData = array_combine($header, $row);

            try {
                $this->profile->Query()->updateOrCreate(
                    ['nip' => $rowData['nip']],
                    [
                        'nipkonversi' => $rowData['nipkonversi'],
                        'nama' => $rowData['nama'],
                        'gelardepan' => $rowData['gelardepan'],
                        'gelarbelakang' => $rowData['gelarbelakang'],
                        'namalengkap' => $rowData['namalengkap'],
                        'tempatlahir_rfk' => $rowData['tempatlahir_rfk'],
                        'pnstempatlahir' => $rowData['pnstempatlahir'],
                        'tempatlahirkab_rfk' => $rowData['tempatlahirkab_rfk'],
                        'pnstempatlahirkab' => $rowData['pnstempatlahirkab'],
                        'tanggallahir' =>  Carbon::createFromFormat('d/m/Y', $rowData['tanggallahir'])->format('Y-m-d'),
                        'usia' => $rowData['usia'],
                        'kelompok_usia' => $rowData['kelompok_usia'],
                        'jeniskelamin_rfk' => $rowData['jeniskelamin_rfk'],
                        'jeniskelamin' => $rowData['jeniskelamin'],
                        'golongandarah' => $rowData['golongandarah'],
                        'agama_rfk' => $rowData['agama_rfk'],
                        'agama' => $rowData['agama'],
                        'perkawinanstatus_rfk' => $rowData['perkawinanstatus_rfk'],
                        'perkawinanstatus' => $rowData['perkawinanstatus'],
                        'kepegawaianstatus_rfk' => $rowData['kepegawaianstatus_rfk'],
                        'kepegawaianstatus' => $rowData['kepegawaianstatus'],
                        'pnstmt' => $rowData['pnstmt'],
                        'kepegawaianjenis_rfk' => $rowData['kepegawaianjenis_rfk'],
                        'kepegawaianjenis' => $rowData['kepegawaianjenis'],
                        'kedudukanhukum_rfk' => $rowData['kedudukanhukum_rfk'],
                        'kedudukanhukum' => $rowData['kedudukanhukum'],
                        'alamat' => $rowData['alamat'],
                        'alamatrt' => $rowData['alamatrt'],
                        'alamatrw' => $rowData['alamatrw'],
                        'alamatdesa_rfk' => $rowData['alamatdesa_rfk'],
                        'pnsdesa' => $rowData['pnsdesa'],
                        'pnskodepos' => $rowData['pnskodepos'],
                        'pnskec_rfk' => $rowData['pnskec_rfk'],
                        'pnskec' => $rowData['pnskec'],
                        'pnskab_rfk' => $rowData['pnskab_rfk'],
                        'pnskab' => $rowData['pnskab'],
                        'pnsprov_rfk' => $rowData['pnsprov_rfk'],
                        'pnsprov' => $rowData['pnsprov'],
                        'alamattelephone1' => $rowData['alamattelephone1'],
                        'alamattelephone2' => $rowData['alamattelephone2'],
                        'motto' => $rowData['motto'],
                        'arsiplokasi_rfk' => $rowData['arsiplokasi_rfk'],
                        'arsiplokasi' => $rowData['arsiplokasi'],
                        'kartupeg' => $rowData['kartupeg'],
                        'kartuaskes' => $rowData['kartuaskes'],
                        'kartutaspen' => $rowData['kartutaspen'],
                        'npwp' => $rowData['npwp'],
                        'ayahnama' => $rowData['ayahnama'],
                        'ayahtempatlahir_rfk' => $rowData['ayahtempatlahir_rfk'],
                        'ayahtempatlahir' => $rowData['ayahtempatlahir'],
                        'ayahtanggallahir' => $rowData['ayahtanggallahir'] == 0 ? null : date('Y-m-d', strtotime($rowData['ayahtanggallahir'])),
                        'ayahpekerjaan_rfk' => $rowData['ayahpekerjaan_rfk'],
                        'ayahpekerjaan' => $rowData['ayahpekerjaan'],
                        'ibunama' => $rowData['ibunama'],
                        'ibutempatlahir_rfk' => $rowData['ibutempatlahir_rfk'],
                        'ibutempatlahir' => $rowData['ibutempatlahir'],
                        'ibutanggallahir' => $rowData['ibutanggallahir'] == 0 ? null : date('Y-m-d', strtotime($rowData['ibutanggallahir'])),
                        'ibupekerjaan_rfk' => $rowData['ibupekerjaan_rfk'],
                        'ibupekerjaan' => $rowData['ibupekerjaan'],
                        'orangtuaalamat' => $rowData['orangtuaalamat'],
                        'orangtuaalamatrt' => $rowData['orangtuaalamatrt'],
                        'orangtuaalamatrw' => $rowData['orangtuaalamatrw'],
                        'orangtualokasidesa_rfk' => $rowData['orangtualokasidesa_rfk'],
                        'orangtuadesa' => $rowData['orangtuadesa'],
                        'orangtuakodepos' => $rowData['orangtuakodepos'],
                        'orangtuakec_rfk' => $rowData['orangtuakec_rfk'],
                        'orangtuakec' => $rowData['orangtuakec'],
                        'orangtuakab_rfk' => $rowData['orangtuakab_rfk'],
                        'orangtuakab' => $rowData['orangtuakab'],
                        'orangtuaprov_rfk' => $rowData['orangtuaprov_rfk'],
                        'orangtuaprov' => $rowData['orangtuaprov'],
                        'orangtuatelephone' => $rowData['orangtuatelephone'],
                        'catatan' => $rowData['catatan'],
                        'pendidikan_rfk' => $rowData['pendidikan_rfk'],
                        'pendidikan' => $rowData['pendidikan'],
                        'tktpendidikan_kode' => $rowData['tktpendidikan_kode'],
                        'tktpendidikan' => $rowData['tktpendidikan'],
                        'namasekolah' => $rowData['namasekolah'],
                        'noijazah' => $rowData['noijazah'],
                        'tglijazah' => date('Y-m-d', strtotime($rowData['tglijazah'])),
                        'tahunlulus' => $rowData['tahunlulus'],
                        'pangkatbknnomor' => $rowData['pangkatbknnomor'],
                        'pangkatbkntanggal' => date('Y-m-d', strtotime($rowData['pangkatbkntanggal'])),
                        'golongan' => $rowData['golongan'],
                        'pangkatgolruang_rfk' => $rowData['pangkatgolruang_rfk'],
                        'golruangnama' => $rowData['golruangnama'],
                        'pangkat' => $rowData['pangkat'],
                        'pangkatmktahun' => $rowData['pangkatmktahun'],
                        'pangkatmkbulan' => $rowData['pangkatmkbulan'],
                        'pangkatkeputusan_rfk' => $rowData['pangkatkeputusan_rfk'],
                        'pangkatpenetap_rfk' => $rowData['pangkatpenetap_rfk'],
                        'pangkatpenetap' => $rowData['pangkatpenetap'],
                        'pangkatnnomor' => $rowData['pangkatnnomor'],
                        'pangkattanggal' => date('Y-m-d', strtotime($rowData['pangkattanggal'])),
                        'pangkattmt' => date('Y-m-d', strtotime($rowData['pangkattmt'])),
                        'pangkatarsipstatus_rfk' => $rowData['pangkatarsipstatus_rfk'],
                        'pangkatarsip' => $rowData['pangkatarsip'],
                        'jabatan_rfk' => $rowData['jabatan_rfk'],
                        'jabatannama' => $rowData['jabatannama'],
                        'jabataneselon_rfk' => $rowData['jabataneselon_rfk'],
                        'jabatangroup_rfk' => $rowData['jabatangroup_rfk'],
                        'jabatanjenis_rfk' => $rowData['jabatanjenis_rfk'],
                        'jabatanjenis' => $rowData['jabatanjenis'],
                        'jabatankelompok_rfk' => $rowData['jabatankelompok_rfk'],
                        'jabatankelompok' => $rowData['jabatankelompok'],
                        'jabatantugas_rfk' => $rowData['jabatantugas_rfk'],
                        'skpd_rfk' => $rowData['skpd_rfk'],
                        'skpdnama' => $rowData['skpdnama'],
                        'skpdorganisasi_rfk' => $rowData['skpdorganisasi_rfk'],
                        'skpdorganisasinama' => $rowData['skpdorganisasinama'],
                        'jabatankeputusan_rfk' => $rowData['jabatankeputusan_rfk'],
                        'jabatanpenetap_rfk' => $rowData['jabatanpenetap_rfk'],
                        'jabatanpenetap' => $rowData['jabatanpenetap'],
                        'jabatannomor' => $rowData['jabatannomor'],
                        'jabatantanggal' => date('Y-m-d', strtotime($rowData['jabatantanggal'])),
                        'jabatantmt' => date('Y-m-d', strtotime($rowData['jabatantmt'])),
                        'skpdorganisasistruktur_rfk' => $rowData['skpdorganisasistruktur_rfk'],
                        'jabatanarsipstatus_rfk' => $rowData['jabatanarsipstatus_rfk'],
                        'jabatanarsip' => $rowData['jabatanarsip'],
                        'diklatnama' => $rowData['diklatnama'],
                        'diklateselon' => $rowData['diklateselon'],
                        'diklatsttptanggal' => date('Y-m-d', strtotime($rowData['diklatsttptanggal'])),
                    ]
                );
            } catch (\Throwable $th) {
                return $this->warning($th->getMessage());
            }
        }

        return back()->with('success', 'Data berhasil diimpor.');
    }

    public function show($id)
    {
        if (\request()->ajax()) {
            $profile = $this->profile->find($id);
            return view('admin.profile._show_profile', compact('profile'));
        }
    }
}
