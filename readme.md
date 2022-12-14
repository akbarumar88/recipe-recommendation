							**LAPORAN PENJELASAN**
**DESKRIPSI APLIKASI**

**1. Deskripsi Aplikasi Web Utama**

   Adalah sebuah web untuk menonton film yang dimana membantu para pengguna untuk menonton sebuah film lokal maupun luar negri. Website ini merupakan website gratis untuk  penikmat film. Terdapat banyak genre film yang ada pada website ini, mulai dari drama,romace,aciton,dll. Pada websie ini,user atau pengguna diwajibkan untuk login ataupun mendaftar untuk bisa mendapatkan akses untuk menonton film.

**2.Deskripsi Aplikasi Web Admin**

Website admin adalah adalah sebuah website yang digunakan untuk admin untuk mengisi ataupun mengelola film terbaru yang akan dimasukkan kedalam website tersebut. Pada website admin ini berfungsi untuk mengupdate,menambakan ataupun menghapus film pada website.

**SITEMAP/HIRARKI MENU APLIKASI BESERTA PENJELASANNYA**
![FLOWCHART PW](https://user-images.githubusercontent.com/96807815/147766963-89415a8a-2126-468b-8070-8108b633c0ab.png)

**Fitur- Fitur**

**1.  Login**

User perlu melakukan login untuk mendapatkan fitur-fitur secara lengkap, diantaranya dapat menikmati film dengan kualitas HD. Sebelum bisa login, user harus mendaftarkan diri dulu pada menu Register.

**2.  Pencarian Film berdasarkan keyword**

Pencarian film berdasarkan keyboard adalah sebuah fitur yang diperuntukan untuk memudahkan pengguna dalam mencari film yang ingin dicari/dilihat oleh pengguna.

**3.  Pencarian Film bedasarkan Genre**

Pencarian film berdasarkan genre adalah sebuah fitur yang diperuntukan untuk memudahkan pengguna untuk mecari ataupun melihat film yang akan diakses, Pencarian berdasarkan genre juga memudahkan untuk memilih genre film yang disukai oleh pengguna.

**4.  Fitur Watch Later & Film Favorit (Untuk User yang sudah register)**

Fitur Watch Later adalah untuk membantu pengguna untuk melihat film ya ng ingin dilihat pada waktu tertentu. Film favorit juga dapat memudahkan pengguna untuk memilih film yang pengguna sukai. Pada fitur ini hanya pengguna yang sudah melakukan registrasi yang dapat mengakses fitur tersebut.

**5.  Kekhususan Untuk User yang sudah Register**

Kekhususan untuk user yang sudah register adalah fitur yang didapat jika user sudah melakukan registrasi.

**6.  Kualitas Film HD**

Kualitas film HD adalah resousi film yang dilihat oleh pengguna,untuk pengguna yang belum melakukan login maka akan hanya bisa melihat kualitas film SD. Jika user sudah melakukan login maka user dapat melihat film dengan kualitas yang HD.

**7.  Histori Lihat Film**

Histori adalah sebuah fitur untuk membantu pengguna dalam melihat riwayat film yang pernah dilihat oleh pengguna. 8.  Komentar.

Komentar adalah sebuah fitur untuk pengguna jika ingin memberikan komentar pada film yang sudah dilihat oleh pengguna.

**8.  Saran Video Terkait.**

Ketika user menonton film tertentu, maka pada bagian bawah akan menampilkan saran-saran film lainnya berdasarkan dari film yang sedang user tonton saat ini. Pengambilannya berdasarkan genre yang mirip.

**TEKNOLOGI YANG DIGUNAKAN**
**1. Codelgniter**
CodeIgniter adalah salah satu framework PHP yang ringan dan bersifat open-source. Framework ini memungkinkan Anda untuk mengembangkan aplikasi web dengan fitur lengkap secara lebih cepat. Hal itu berkat dukungan library yang beragam. CodeIgniter 3 merupakan pengembangan dari versi sebelumnya, yaitu CodeIgniter 2. Masih dengan konsep _Model-_View-Controller , CodeIgniter 3 menawarkan antarmuka dan struktur project yang sederhana. Sehingga, penulisan kode pemrograman bisa lebih konsisten dan terstruktur. Selain itu, performanya yang cepat dan konfigurasi yang minim juga menjadi alasan CodeIgniter 3 populer di kalangan web developer.

Guna dari CI3 pada web admin dan utama yang kita buat yaitu untuk mengkonfigurasi environment, membuat koneksi ke database, membuat CRUD.

**2. Jquery**

Jquery adalah library JavaScript yang cukup andal, ringkas, dan mempunyai fitur yang cukup lengkap. Library ini membuat pemrosesan di HTML seperti perubahan dan manipulasi dokumen, _event handling_, animasi, dan Ajax dapat menjadi lebih sederhana. Hal ini didukung dengan API yang mudah digunakan dan dapat bekerja di berbagai macam browser. Menggunakan kombinasi _versatility_ (keserbagunaan) dan _extensibillty_ (bisa dikembangkan), jQuery sudah mengubah cara ribuan bahkan jutaan developer menggunakan bahasa pemrograman JavaScript. Ini membuktikan bahwa jQuery merupakan salah satu library yang cukup populer di JavaScript.

Fungsi Jquery pada web admin dan utama yaitu sebagai library javascript yang membantu mengatur interaksi javascript dengan HTML yang berjalan.

**3. Json** _(JavaScript Object Notation)_

Json adalah format berbasis teks standar untuk merepresentasikan data terstruktur berdasarkan sintaks objek JavaScript. Ini biasanya digunakan untuk menyimpan dan mengirimkan data dalam aplikasi web.

Fungsi dari json ini pada aplikasi web admin dan utama yaitu untuk menyimpan data dan mentransfer data dan juga menampilkan in formasi yang dapat diperbarui tanpa harus memuat ulang halaman tersebut.

**4. JavaScript (JS)**

JavaScript yaitu Bahasa pemrograman yang digunakan dalam pengembangan website, aplikasi, dll. JS biasanya digunakan untuk membuat tampilan situs dengan konsep website yang dinamis dan interaktif.

Fungsi JS dalam aplikasi web utama dan admin yaitu membuat tampilan website lebih menarik, dan juga fitur penunjuk alamat lokasi sekolah. Misal saat aplikasi dijalankan kita mengklik fitur penunjuk rute diaktifkan, maka google maps dapat terus mengupdate posisi anda secara realtime tanpa melakukan reload/memuat halaman ulang.

**5. CSS**

CSS adalah kepanjangan dari Cascading Style Sheet yang berfungsi untuk mengatur tampilan elemen yang tertulis dalam bahasa markup. Selain itu CSS berfungsi untuk memisahkan konten dari tampilan visual dalam sebuah website.

Fungsi CSS dalam aplikasi web utama dan admin ini yaitu untuk mengatur style dan sebagainya, menentukan warna dan ukuran teks dalam aplikasi web, dan menerapkan warna ke latar belakang, dsb.

**CARA MENJALANKAN APLIKASI**

**- Cara Menjalankan Aplikasi Website Utama**

1. Masuk ke website MOOVEE

2. Untuk user biasa bisa melakukan login maupun tidak. Namun jika tidak login, maka tidak akan bisa menikmati keseluruhan fitur dari MOVEE.

3. Pada halaman utama, user diberikan film-film terbaru dan film-film yang baru saja ditambahkan.

4. User bisa melakukan pencarian Film berdasarkan Keyword dan berdasarkan Genre.

5. Klik film yang hendak ditonton untuk menontonnya

6. Pada halaman detail film akan ditampilkan kualitas film yang tersedia. Untuk user yang sudah login, maka akan tersedia kualitas hingga HD, namun untuk user yang belum login, maka hanya tersedia hingga SD saja.

**Cara Menjalankan Aplikasi Website Admin**

1. Masuk website MOOVEE

2. Klik Login untuk melakukan login sebagai Admin

3. Login menggunakan User Admin MOOVEE.

4. Akan diarahkan ke halaman Admin untuk mengelola film-film MOOVEE

5. Dapat menambah, mengubah, serta menghapus film.

**FITUR-FITUR YANG DITAWARKAN BESERTA SCREENSHOT PROGRAM**

a.	Menampilkan Film-film Terbaru dan film yang baru saja ditambahkan
![gambar1](https://user-images.githubusercontent.com/96807815/147767192-4574e213-8a9e-41a6-ac39-913ea096f99a.png)

b.	Pencarian Film berdasarkan Keyword
![pencarian](https://user-images.githubusercontent.com/96807815/147767568-436e0146-2739-4136-9aa4-fdc4bb38f5e1.png)

c.	Pencarian Film berdasarkan Genre Film
![pencarian genre](https://user-images.githubusercontent.com/96807815/147767724-a655e954-928e-4497-8ae1-a6b06650c06e.png)

d.	Opsi kualitas film (kualitas HD hanya tersedia untuk user yang sudah logged in)
![opsi kualitas](https://user-images.githubusercontent.com/96807815/147767811-57c99da0-0b1d-4559-8246-acab303b402a.png)

e.	Film Terkait
![film terkait](https://user-images.githubusercontent.com/96807815/147767977-d541ddba-45cf-4ec3-be9a-9d7879128f4b.png)

7.	KODE-KODE INTI BESERTA PENJELASANNYA

a.	Site Controller
![image](https://user-images.githubusercontent.com/96807815/147768347-df43eb9d-429b-4e42-871c-1c0cc2b12d21.png)
Ini merupakan controller dari Halaman Utama MOOVEE. Disini menghandle halaman seperti indeks, pencarian keyword, pencarian genre, detail Film dsb.

b.	Model Movie
![model movie](https://user-images.githubusercontent.com/96807815/147768824-8adfe9a5-589c-451f-8efa-9f3b75ec222c.png)
Berikut merupakan Model Movie. Model yang bertugas menghandle kueri-kueri seputar Film seperti Film index, film terbaru, detail film, film terkait dsb.

c.	Auth Controller
![auth controller](https://user-images.githubusercontent.com/96807815/147768943-fe877a48-46a1-47ee-9fef-009918c17cb7.png)
Merupakan controller yang bertugas untuk menangani masalah autentikasi yaitu login dan register. Fungsionalitas login dan register ada pada controller ini.

d.	View index website MOOVEE
![view index](https://user-images.githubusercontent.com/96807815/147769069-c068d48e-e8be-4fbd-a3ed-f1acd0982b50.png)
Merupakan view yang menghandle tampilan awal website MOOVEE. Ini untuk menampilkan film-film terbaru serta film-film yang baru ditambahkan


e.	Model User
![model user](https://user-images.githubusercontent.com/96807815/147769356-ffaae45f-a7b8-4636-a438-eb3e459e98a1.png)
Model yang bertugas untuk menangani kueri-kueri seputar User. Fungsionalitas login dan register juga ada di dalam Model User ini.




