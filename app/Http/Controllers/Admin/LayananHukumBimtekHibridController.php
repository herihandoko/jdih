<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\LayananHukumBimtekHibrid;
use App\Models\Admin\LayananHukumBimtekHibridMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class LayananHukumBimtekHibridController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $layananHukumBimtek = LayananHukumBimtekHibrid::orderBy('bimtek_start_date', 'desc')->get();
        
        return view('admin.layanan_hukum.bimtekhibrid.index', compact('layananHukumBimtek'));
    }

    public function create()
    {
        return view('admin.layanan_hukum.bimtekhibrid.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bimtek_name' => 'required',
            'bimtek_link_zoom' => 'required',
            'bimtek_link_register' => 'required',
            'bimtek_start_date' => 'required',
            'bimtek_end_date' => 'required'
        ],
        [
            'bimtek_name.required' => 'Judul Bimtek harus diisi.',
            'bimtek_link_zoom.required' => 'Link Zoom harus diisi.',
            'bimtek_link_register.required' => 'Link Pendafatran harus diisi.',
            'bimtek_start_date.required' => 'Tgl Mulai Bimtek harus diisi.',
            'bimtek_end_date.required' => 'Tgl Berakhir Bimtek harus diisi.',
        ]);

        $layananHukumBimtek = new LayananHukumBimtekHibrid();
        
        $layananHukumBimtek->bimtek_name = $request->bimtek_name;
        $layananHukumBimtek->bimtek_link_zoom = $request->bimtek_link_zoom;
        $layananHukumBimtek->bimtek_link_register = $request->bimtek_link_register;
        $layananHukumBimtek->bimtek_start_date = Carbon::createFromFormat('d-m-Y', $request->bimtek_start_date)->format('Y-m-d');
        $layananHukumBimtek->bimtek_end_date = Carbon::createFromFormat('d-m-Y', $request->bimtek_end_date)->format('Y-m-d');
        $layananHukumBimtek->bimtek_link_doc = $request->bimtek_link_doc;
        $layananHukumBimtek->bimtek_desc = $request->bimtek_desc;
        $layananHukumBimtek->created_by = session('id');
        
        $layananHukumBimtek->save();
        
        if ($request->hasFile('materi_file')) {
            $request->validate([
                'materi_file' => 'array',
                'materi_file.*' => 'file|mimes:pdf,ppt,pptx|max:15360',
            ]);

            foreach ($request->file('materi_file') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf.'_'.time().'.'.$extension_file;

                Storage::putFileAs('public/places/materi_bimtek', $file, $final_name_file);

                $layananHukumBimtek->material()->create([
                    'materi_file' => $final_name_file
                ]);
            }
        }
        
        return redirect()->route('admin.layanan_hukum.bimtekhibrid.index')->with('success', 'Bimtek Hibrid is added successfully!');
    }

    public function edit($id)
    {
        $bimtekID = Crypt::decrypt($id);
        $layananHukumBimtek = LayananHukumBimtekHibrid::with('material')->findOrFail($bimtekID);
        $currentDate = Carbon::now();
        $currentDateFormat = $currentDate->format('Y-m-d');
        
        return view('admin.layanan_hukum.bimtekhibrid.edit', compact('layananHukumBimtek', 'currentDateFormat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bimtek_name' => 'required',
            'bimtek_link_zoom' => 'required',
            'bimtek_link_register' => 'required',
            'bimtek_start_date' => 'required',
            'bimtek_end_date' => 'required'
        ],
        [
            'bimtek_name.required' => 'Judul Bimtek harus diisi.',
            'bimtek_link_zoom.required' => 'Link Zoom harus diisi.',
            'bimtek_link_register.required' => 'Link Pendafatran harus diisi.',
            'bimtek_start_date.required' => 'Tgl Mulai Bimtek harus diisi.',
            'bimtek_end_date.required' => 'Tgl Berakhir Bimtek harus diisi.',
        ]);

        $layananHukumBimtek = LayananHukumBimtekHibrid::findOrFail($id);
        
        $layananHukumBimtek->bimtek_name = $request->bimtek_name;
        $layananHukumBimtek->bimtek_link_zoom = $request->bimtek_link_zoom;
        $layananHukumBimtek->bimtek_link_register = $request->bimtek_link_register;
        $layananHukumBimtek->bimtek_start_date = Carbon::createFromFormat('d-m-Y', $request->bimtek_start_date)->format('Y-m-d');
        $layananHukumBimtek->bimtek_end_date = Carbon::createFromFormat('d-m-Y', $request->bimtek_end_date)->format('Y-m-d');
        $layananHukumBimtek->bimtek_link_doc = $request->bimtek_link_doc;
        $layananHukumBimtek->bimtek_desc = $request->bimtek_desc;
        $layananHukumBimtek->updated_by = session('id');
        
        $layananHukumBimtek->save();
        
        // Hapus file lama jika ada dan soft delete
        if ($request->has('delete_materi')) {
            foreach ($request->delete_materi as $materialId) {
                $material = LayananHukumBimtekHibridMaterial::findOrFail($materialId);
                
                Storage::delete('public/places/materi_bimtek/' . $material->materi_file);
                $material->is_deleted = 1;
                $material->deleted_by = session('id');
                $material->deleted_at = date("Y-m-d H:i:s", strtotime('now'));
                
                $material->save();
            }
        }
        
        if ($request->hasFile('materi_file')) {
            $request->validate([
                'materi_file' => 'array',
                'materi_file.*' => 'file|mimes:pdf,ppt,pptx|max:15360',
            ]);

            foreach ($request->file('materi_file') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf.'_'.time().'.'.$extension_file;

                Storage::putFileAs('public/places/materi_bimtek', $file, $final_name_file);

                $layananHukumBimtek->material()->create([
                    'materi_file' => $final_name_file
                ]);
            }
        }

        return redirect()->route('admin.layanan_hukum.bimtekhibrid.index')->with('success', 'Bimtek Hibrid is updated successfully!');
    }
}