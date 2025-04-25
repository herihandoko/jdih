<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\HukumAdat;
use App\Models\Admin\HukumAdatRegulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class HukumAdatController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $hukumadat = HukumAdat::orderBy('created_at', 'desc')
            ->join('admins', 'hukum_adats.created_by', '=', 'admins.id')
            ->where('hukum_adats.is_deleted', 0)
            ->get(['hukum_adats.*', 'admins.name']);

        return view('admin.hukumadat.index', compact('hukumadat'));
    }

    public function create()
    {
        return view('admin.hukumadat.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'hukumadat_name' => 'required',
            ],
            [
                'hukumadat_name.required' => 'Judul Hukum Adat harus diisi.',
            ]
        );

        $hukumadat = new HukumAdat();

        $hukumadat->hukumadat_name = $request->hukumadat_name;
        $hukumadat->created_by = session('id');

        $hukumadat->save();
        if ($request->hasFile('materi_foto')) {
            $request->validate([
                'materi_foto' => 'array',
                'materi_foto.*' => 'file|mimes:png,jpg,jpeg|max:15360',
            ]);
            $i = 1;
            foreach ($request->file('materi_foto') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();

                $final_name_file = $hukumadat->hukumadat_name . '_' . $i . '_' . time() . '.' . $extension_file;
                $final_name_file = str_replace(' ', '', $final_name_file);
                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 1
                ]);
                $i++;
            }
        }

        if ($request->hasFile('materi_regulasi')) {
            $request->validate([
                'materi_regulasi' => 'array',
                'materi_regulasi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_regulasi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 2
                ]);
            }
        }

        if ($request->hasFile('materi_refrensi')) {
            $request->validate([
                'materi_refrensi' => 'array',
                'materi_refrensi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_refrensi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 3
                ]);
            }
        }

        if ($request->hasFile('materi_dokumentasi')) {
            $request->validate([
                'materi_dokumentasi' => 'array',
                'materi_dokumentasi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_dokumentasi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 4
                ]);
            }
        }

        if ($request->materi_link) {
            $request->validate([
                'materi_link' => 'array',
            ]);

            foreach ($request->materi_link as $link) {
                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $link,
                    'materi_type' => 5
                ]);
            }
        }

        return redirect()->route('admin.hukumadat.index')->with('success', 'Hukum Adat is added successfully!');
    }

    public function edit($id)
    {
        $hukumadatID = Crypt::decrypt($id);
        $hukumadat = HukumAdat::with('hukumadatregulasi')->findOrFail($hukumadatID);
        $currentDate = Carbon::now();
        $currentDateFormat = $currentDate->format('Y-m-d');

        return view('admin.hukumadat.edit', compact('hukumadat', 'currentDateFormat'));
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'hukumadat_name' => 'required'
            ],
            [
                'hukumadat_name.required' => 'Nama Hukum Adat harus diisi.',
            ]
        );

        $hukumadat = HukumAdat::findOrFail($id);

        $hukumadat->hukumadat_name = $request->hukumadat_name;
        $hukumadat->updated_by = session('id');

        $hukumadat->save();

        // Hapus file lama jika ada dan soft delete
        if ($request->has('delete_materi')) {
            foreach ($request->delete_materi as $materialId) {
                $material = HukumAdatRegulasi::findOrFail($materialId);

                Storage::delete('public/places/materi_hukumadat/' . $material->materi_file);
                $material->is_deleted = 1;
                $material->deleted_by = session('id');
                $material->deleted_at = date("Y-m-d H:i:s", strtotime('now'));

                $material->save();
            }
        }

        if ($request->delete_link) {
            foreach ($request->delete_link as $delete_linkId) {
                $material = HukumAdatRegulasi::findOrFail($delete_linkId);

                $material->is_deleted = 1;
                $material->deleted_by = session('id');
                $material->deleted_at = date("Y-m-d H:i:s", strtotime('now'));

                $material->save();
            }
        }

        if ($request->hasFile('materi_foto')) {
            $request->validate([
                'materi_foto' => 'array',
                'materi_foto.*' => 'file|mimes:png,jpg|max:15360',
            ]);
            $i = 1;
            foreach ($request->file('materi_foto') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $hukumadat->hukumadat_name . '_' . $i . '_' . time() . '.' . $extension_file;
                $final_name_file = str_replace(' ', '', $final_name_file);
                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 1
                ]);
                $i++;
            }
        }

        if ($request->hasFile('materi_regulasi')) {
            $request->validate([
                'materi_regulasi' => 'array',
                'materi_regulasi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_regulasi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 2
                ]);
            }
        }

        if ($request->hasFile('materi_refrensi')) {
            $request->validate([
                'materi_refrensi' => 'array',
                'materi_refrensi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_refrensi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 3
                ]);
            }
        }

        if ($request->hasFile('materi_dokumentasi')) {
            $request->validate([
                'materi_dokumentasi' => 'array',
                'materi_dokumentasi.*' => 'file|mimes:pdf|max:15360',
            ]);

            foreach ($request->file('materi_dokumentasi') as $file) {
                $name_file = $file->getClientOriginalName();
                $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $file->getClientOriginalExtension();
                $final_name_file = $filename_pdf . '_' . time() . '.' . $extension_file;

                Storage::putFileAs('public/places/materi_hukumadat', $file, $final_name_file);

                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $final_name_file,
                    'materi_type' => 4
                ]);
            }
        }

        if ($request->materi_link) {
            $request->validate([
                'materi_link' => 'array'
            ]);

            foreach ($request->materi_link as $link) {


                $hukumadat->hukumadatregulasi()->create([
                    'materi_file' => $link,
                    'materi_type' => 5
                ]);
            }
        }



        return redirect()->route('admin.hukumadat.index')->with('success', 'Hukum Adat is updated successfully!');
    }

    public function destroy($id)
    {
        $hukumadat = HukumAdat::findOrFail($id);

        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $hukumadat->fill($data)->save();
        return Redirect()->back()->with('success', 'Hukum Adat is deleted successfully!');
    }
}
