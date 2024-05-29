<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmotionalController extends Controller
{
    public function index()
    {
        $questions = [
            "Saya menyalahkan diri sendiri ketika segala sesuatunya berjalan buruk",
            "Saya merasa cemas atau khawatir tanpa alasan yang jelas",
            "Saya merasa takut atau panik tanpa alasan yang jelas",
            "Saya merasa kesulitan untuk tidur atau tidur terlalu banyak",
            "Saya merasa sedih, tertekan atau sengsara",
            "Pikiran untuk melukai diri sendiri pernah terlintas di benak saya",
            "Saya merasa sulit untuk tertawa atau melihat sisi lucu dari situasi",
            "Saya mengalami perubahan nafsu makan (makan terlalu banyak atau terlalu sedikit)",
            "Saya merasa terisolasi atau sendirian, meskipun ada orang di sekitar saya",
            "Saya merasa putus asa atau tidak ada solusi untuk masalah saya"
        ];

        return view('Mom.catatan-emosi', compact('questions'));
    }

    public function submit(Request $request)
    {
        $scores = $request->input('scores');
        $totalScore = array_sum($scores);
    
        $message = '';
        $imageUrl = '';
        $buttonText = '';
        $url = '';
    
        if ($totalScore >= 0 && $totalScore <= 12) {
            $message = 'Sejauh ini anda memiliki perasaan positif yang cukup baik. Kami menyarankan Moms untuk melihat artikel';
            $imageUrl = 'https://i.ibb.co.com/yFTPCRG/Screenshot-2024-05-10-091333.png';
            $buttonText = 'Lihat Artikel';
            $url = '/articles';
        } elseif ($totalScore >= 13 && $totalScore <= 25) {
            $message = 'Sejauh ini anda memiliki perasaan positif yang cukup baik. Kami menyarankan Moms untuk masuk ke menu kami meditasi';
            $imageUrl = 'https://i.ibb.co.com/yFTPCRG/Screenshot-2024-05-10-091333.png';
            $buttonText = 'Lihat Meditasi';
            $url = '/meditations';
        } elseif ($totalScore >= 26 && $totalScore <= 40) {
            $message = 'Sepertinya emosi negatif Moms saat ini perlu kami perhatikan. Moms dapat berkonsultasi dengan dokter secara langsung untuk mendapatkan perhatian khusus';
            $imageUrl = 'https://i.ibb.co.com/PxRLGNw/Screenshot-2024-05-10-092215.png';
            $buttonText = 'Konsultasi Dokter';
            $url = '/consultations';
        }
    
        return back()->with([
            'success' => $message,
            'imageUrl' => $imageUrl,
            'buttonText' => $buttonText,
            'url' => $url
        ]);
    }
}
