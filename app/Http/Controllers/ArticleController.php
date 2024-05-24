<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('Articles.index');
    }

    public function getById($id)
    {
        $article_detail = '<h2>Mengenal Baby Blues</h2>
        <p><em>Baby blues&nbsp;</em>adalah bentuk ringan dari depresi dan gangguan kecemasan yang terjadi pada masa-masa awal pasca-persalinan. Sekitar 50-80 persen wanita mengalami kondisi ini setelah melahirkan. Biasanya gejalanya mulai muncul dalam 1-5 hari setelah bersalin dan kemudian reda dalam 10 hari. Sebagian besar wanita yang mengalami&nbsp;<em>baby blues&nbsp;</em>memang cenderung bisa pulih sendiri tanpa penanganan profesional.</p>
        <p>Meski demikian, ada juga wanita yang kemudian mengalami kondisi yang disebut gangguan kecemasan atau depresi perinatal. Kondisi ini berkembang dari&nbsp;<em>baby blues&nbsp;</em>dan memerlukan penanganan profesional, seperti obat-obatan dan terapi psikologis. Bila dibiarkan tanpa penanganan, kondisi itu akan membahayakan ibu dan bayinya.</p>
        <p><em>Baby blues&nbsp;</em>diyakini berkaitan dengan perubahan emosional dan fisik yang terjadi seiring dengan persalinan. Walau merupakan kondisi yang lazim terjadi pada kalangan ibu setelah melahirkan, perasaan sedih, marah, khawatir, cemas, dan semacamnya itu membutuhkan perhatian dari ibu dan ayah agar dapat ditangani secara mandiri.</p>
        <p>&nbsp;</p>
        <h2>Gejala</h2>
        <p><em>Baby blues&nbsp;</em>ditandai dengan perubahan suasana hati yang terjadi selama beberapa hari pasca-persalinan. Pada periode ini, para ibu yang mengalaminya menyebutkan merasa lebih sedih dan khawatir ketimbang biasanya. Mereka juga merasa sangat lelah dan tidak mengenali dirinya sendiri. Berikut ini beberapa gejala&nbsp;<em>baby blues&nbsp;</em>yang kerap muncul:</p>
        <ul>
        <li>Merasa sedih</li>
        <li>Menangis tak terkendali</li>
        <li>Mudah marah</li>
        <li>Merasa cemas</li>
        <li>Merasa lebih emosional</li>
        <li>Sulit tidur</li>
        <li>Mudah lupa</li>
        <li>Selera makan menurun</li>
        </ul>
        <p>Penting untuk diketahui bahwa gejala&nbsp;<em>baby blues&nbsp;</em>bersifat ringan. Bila ibu merasa sangat depresi atau dilanda kecemasan, hingga ada pikiran untuk bunuh diri atau mencelakai buah hati, ini tanda kondisi yang lebih serius. Ibu yang mengalami gejala tersebut perlu segera mencari bantuan dari orang terdekat atau mendatangi dokter secepatnya.</p>
        <p>&nbsp;</p>
        <h2>Penyebab</h2>
        <p><em>Baby blues&nbsp;</em>bukanlah penyakit, melainkan kondisi psikologis ibu yang berkembang sesaat setelah melahirkan. Hingga kini para pakar belum bisa memastikan apa penyebab munculnya kondisi tersebut dan kenapa tidak semua ibu mengalaminya. Diduga ada banyak faktor yang menjadi pemicunya, termasuk perubahan hormon, stres yang dialami saat merawat bayi yang baru lahir, dan kurang tidur pada masa-masa setelah melahirkan.</p>
        <h3>1. Perubahan hormon</h3>
        <p>Perubahan hormon selama kehamilan dan setelah melahirkan adalah salah satu faktor penyebab&nbsp;<em>baby blues.&nbsp;</em>Selama kehamilan, terjadi perubahan hormon tertentu pada tubuh ibu. Perubahan hormon tersebut pada saat bayi lahir dapat menyebabkan gejala&nbsp;<em>baby blues.</em></p>
        <h3>2. Stres saat merawat bayi</h3>
        <p>Ibu rentan mengalami stres saat merawat bayi yang baru lahir. Apalagi bila itu merupakan pengalaman pertamanya sebagai ibu. Memiliki bayi membawa perubahan besar dalam hidup. Bisa muncul serangkaian emosi berupa kekhawatiran, kecemasan, keraguan, dan ketakutan pada diri ibu dalam menghadapi perubahan tersebut.</p>
        <div class="exactmetrics-inline-popular-posts exactmetrics-inline-popular-posts-beta exactmetrics-popular-posts-styled">
        <div class="exactmetrics-inline-popular-posts-image"><img class="entered lazyloaded" src="https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-300x169.jpg.webp" srcset="https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-300x169.jpg.webp 300w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-1024x576.jpg.webp 1024w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-768x432.jpg.webp 768w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-1536x864.jpg.webp 1536w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih.jpg.webp 1920w" alt="Pemeriksaan Uroflowmetri untuk Menilai Kesehatan Kandung Kemih" width="300" height="169" data-lazy-srcset="https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-300x169.jpg.webp 300w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-1024x576.jpg.webp 1024w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-768x432.jpg.webp 768w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-1536x864.jpg.webp 1536w,https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih.jpg.webp 1920w" data-lazy-src="https://primayahospital.b-cdn.net/wp-content/uploads/2022/08/Pemeriksaan-Uroflowmetri-untuk-Menilai-Kesehatan-Kandung-Kemih-300x169.jpg.webp" data-ll-status="loaded"></div>
        <div class="exactmetrics-inline-popular-posts-text"><span class="exactmetrics-inline-popular-posts-label">Trending</span>
        <div class="exactmetrics-inline-popular-posts-post"><a class="exactmetrics-inline-popular-posts-title" href="https://primayahospital.com/urologi/pemeriksaan-uroflowmetri/" data-wpel-link="internal">Pemeriksaan Uroflowmetri untuk Menilai Kesehatan Kandung Kemih</a></div>
        </div>
        </div>
        <p>&nbsp;</p>
        <h3>3. Kurang tidur</h3>
        <p>Perawatan bayi baru lahir juga bisa membuat ibu kurang tidur pada malam hari. Dalam sejumlah penelitian, ibu yang kurang tidur setelah melahirkan lebih mungkin mengalami depresi. Risiko ibu mengalami&nbsp;<em>baby blues&nbsp;</em>kian tinggi bila pada trimester ketiga sudah sulit tidur.</p>
        <p>&nbsp;</p>
        <h2>Cara Dokter Mendiagnosis Baby Blues</h2>
        <p>Dalam mendiagnosis&nbsp;<em>baby blues,&nbsp;</em>dokter akan memeriksa gejala yang dialami ibu. Pemeriksaan gejala ini membutuhkan keterbukaan ibu dalam mengungkapkan apa saja yang dirasakannya. Bila ibu terbuka, dokter dapat lebih memastikan kondisi ibu dan memberikan perawatan yang tepat sesuai dengan kondisi tersebut.</p>
        <p>Ibu juga akan diminta mengisi kuesioner atau menjalani tes untuk menguji kondisi psikologis dan menilai apakah ibu mengalami depresi serta seberapa parah depresi tersebut. Selain itu, dokter akan mengecek riwayat kesehatan ibu. Ibu yang pernah mengalami depresi sebelumnya lebih mungkin mengalami&nbsp;<em>baby blues</em>&nbsp;setelah melahirkan.</p>
        <p>Risiko lain yang akan dinilai dokter termasuk:</p>
        <ul>
        <li>Menjalani kehamilan yang tak diinginkan</li>
        <li>Tingkat kepercayaan diri rendah</li>
        <li>Tidak memiliki pasangan</li>
        <li>Merasa kecewa atau tidak puas terhadap pasangan</li>
        <li>Takut terhadap kelahiran bayinya</li>
        <li>Menjalani operasi caesar</li>
        <li>Mengalami stres dan kecemasan saat melahirkan</li>
        <li>Kurang dukungan sosial</li>
        <li>Kurang vitamin dan mineral tertentu</li>
        <li>Berusia muda</li>
        </ul>
        <p>&nbsp;</p>
        <h2>Cara Mengatasi Baby Blues</h2>
        <p>Hal pertama yang perlu ditekankan kepada ibu yang mengalami&nbsp;<em>baby blues&nbsp;</em>adalah perasaan sedih, khawatir, cemas, dan lain-lain itu wajar. Emosi yang campur aduk normal dialami ibu yang baru melahirkan. Ibu dengan dukungan pasangan dan keluarga umumnya dapat mengatasi perasaan tersebut. Berikut ini sejumlah cara mengatasi&nbsp;<em>baby blues&nbsp;</em>bagi ibu:</p>
        <ul>
        <li>Menjaga kesehatan dengan rutin berolahraga dan makan makanan sehat</li>
        <li>Meminta dukungan dari pasangan dan keluarga dalam merawat bayi</li>
        <li>Terbuka pada pasangan dan keluarga, beri tahu bila ada hal yang mengarah ke gejala&nbsp;<em>baby blues</em></li>
        <li>Berbagi tugas dengan pasangan dalam mengerjakan urusan rumah tangga dan merawat bayi</li>
        <li>Manfaatkan waktu luang dengan beristirahat</li>
        <li>Berjalan-jalan mencari udara segar</li>
        <li>Mempraktikkan&nbsp;<em>mindfulness&nbsp;</em>untuk menenangkan pikiran, misalnya lewat yoga atau meditasi</li>
        <li>Mengikuti terapi</li>
        </ul>
        <div><a class="u092c4fa2ce7db432652b4027ac3c3efd" href="https://primayahospital.com/kejiwaan/stres-kerja-tidak-semuanya-buruk/" target="_blank" rel="dofollow noopener" data-wpel-link="internal">
        <div><span class="ctaText">Baca Juga:</span>&nbsp;&nbsp;<span class="postTitle">Kesehatan Mental Yang Baik Untuk Pekerja</span></div>
        </a></div>
        <p>&nbsp;</p>
        <h2>Komplikasi</h2>
        <p>Komplikasi kondisi yang berkembang dari&nbsp;<em>baby blues&nbsp;</em>adalah depresi pasca-persalinan atau&nbsp;<em>postpartum depression.&nbsp;</em>Depresi pasca-persalinan ditandai dengan gejala yang mirip&nbsp;<em>baby blues,&nbsp;</em>tapi tingkatnya sudah dalam level berat.&nbsp;<em>Baby blues&nbsp;</em>dapat hilang dengan sendirinya dengan penanganan mandiri. Sedangkan depresi setelah melahirkan umumnya membutuhkan perawatan medis.</p>
        <p>Depresi pasca-persalinan memunculkan gejala seperti kesedihan yang amat dalam, kehilangan minat atau kesenangan pada hal-hal yang sebelumnya disukai, amarah mudah meledak, sulit menjalin ikatan dengan bayi yang baru dilahirkan, hingga keinginan bunuh diri. Gejala ini akan muncul lebih dari 10 hari bahkan hingga 1 tahun bila tak mendapat penanganan yang memadai.</p>
        <p>&nbsp;</p>
        <h2>Pencegahan</h2>
        <p>Cara mencegah&nbsp;<em>baby blues&nbsp;</em>bisa dilakukan dengan menjalani tes kesehatan mental bagi ibu sebelum dan sesudah melahirkan. Ada berbagai metode tes. Salah satu yang paling sering digunakan adalah Edinburgh Postnatal Depression Scale. Bila hasil tes sebelum melahirkan menunjukkan ada risiko&nbsp;<em>baby blues,&nbsp;</em>dokter dapat memberikan rekomendasi untuk membantu mencegah munculnya kondisi tersebut.</p>
        <p>Ibu dan pasangan pun dapat menyesuaikan diri dan mengantisipasi bila terjadi&nbsp;<em>baby blues&nbsp;</em>di kemudian hari setelah datangnya buah hati. Pasangan memiliki peran penting dalam membantu ibu mencegah&nbsp;<em>baby blues.&nbsp;</em>Dukungan secara fisik dan mental dibutuhkan seorang ibu yang baru melahirkan anaknya. Dukungan ini tak hanya diperlukan setelah persalinan, tapi juga penting selama kehamilan dan saat ibu melahirkan.</p>
        <p>&nbsp;</p>
        <h2>Kapan Harus ke Dokter?</h2>
        <p><em>Baby blues&nbsp;</em>umumnya reda sendiri dalam beberapa hari setelah kelahiran bayi. Bila ibu merasa kewalahan dengan peran barunya ini, konsultasi dengan dokter bisa menjadi solusi. Bila gejala&nbsp;<em>baby blues&nbsp;</em>tak kunjung hilang dan justru makin menjadi-jadi, cepat-cepat temui dokter untuk mendapatkan bantuan profesional.</p>
        <p>&nbsp;</p>';
        return view('Articles.detail', compact('article_detail'));
    }
}
