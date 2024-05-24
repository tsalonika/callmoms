<?php

namespace App\Http\Controllers;

use App\Models\Meditation;
use App\Models\Psychologist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $psychologists = Psychologist::with('user')->get()->map(function ($psychologist) {
            return [
                'id' => $psychologist->id,
                'name' => $psychologist->name,
                'id_card_number' => $psychologist->id_card_number,
                'gender' => $psychologist->gender,
                'address' => $psychologist->address,
                'photo' => $psychologist->photo,
                'school' => $psychologist->school,
                'graduated_year' => $psychologist->graduated_year,
                'certificate' => $psychologist->certificate,
                'strp_number' => $psychologist->strp_number,
                'strp' => $psychologist->strp,
                'status' => $psychologist->status,
                'phoneNumber' => $psychologist->user->phoneNumber,
            ];
        });
    
        return view('Admin.index', compact('psychologists'));
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $psychologist = Psychologist::findOrFail($request->id);
        $psychologist->status = $request->status ? 'active' : 'inactive';
        $psychologist->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function showMeditation()
    {
        $meditations = DB::table('meditations')->orderBy('created_at', 'desc')->get();
        return view('Admin.meditation', compact('meditations'));
    }

    public function addMeditation(Request $request) {
        try {
            $request->validate([
                'thumbnail' => 'required|image',
                'music' => 'required|file',
            ]);

            $thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            $music = $request->file('music')->store('musics', 'public');

            $meditation = new Meditation();
            $meditation->thumbnail = $thumbnail;
            $meditation->music = $music;
            $meditation->save();

            return redirect()->back()->with('success', 'Berhasil Menambahkan Meditasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menambahkan Meditasi' . $e->getMessage());
        }
    }

    public function editMeditation(Request $request) {
        try {
            $request->validate([
                'id' => 'required|exists:meditations,id',
                'thumbnail' => 'nullable|image',
                'music' => 'nullable|file',
            ]);
    
            $meditation = Meditation::findOrFail($request->id);
    
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
                $meditation->thumbnail = $thumbnail;
            }
    
            if ($request->hasFile('music')) {
                $music = $request->file('music')->store('musics', 'public');
                $meditation->music = $music;
            }
    
            $meditation->save();
    
            return redirect()->back()->with('success', 'Berhasil Mengedit Meditasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengedit Meditasi: ' . $e->getMessage());
        }
    }

    public function deleteMeditation($id) {
        try {
            $meditation = Meditation::findOrFail($id);
            $meditation->delete();
            return response()->json(['message' => 'Berhasil Menghapus Meditasi'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal Menghapus Meditasi', 'error' => $e->getMessage()], 500);
        }
    }
    
}
