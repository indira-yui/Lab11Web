|   INDIRA ALINE    |   TI.20 A.1   |
|-------------------|---------------|
|  Pemrograman Web  |   312010042   |

---
Daftar Isi :
- [Praktikum 11 PHP Framework (Codeigniter)](#praktikum-11-php-framework-codeigniter)
- [Praktikum 12 Framework Lanjutan (CRUD)](#praktikum-12-framework-lanjutan-crud)
- [Praktikum 13 Framework Lanjutan (Modul Login)](#praktikum-13-framework-lanjutan-modul-login)

---

# Lab11Web

Dalam praktikum ini akan membuat program sederhana menggunakan Framework Codeigniter 4.

# Praktikum 11 PHP Framework (Codeigniter)

# Langkah - langkah praktikum

## 1). Mengaktifkan ekstentsi tersebut, melalu XAMPP Control Panel, pada bagian apache klik Config -> PHP.ini

![xampp](img/mysql_server.png)

## 2). Pada bagian extention, hilangkan tanda ; (titik koma) pada ekstensi yang akan diaktifkan. Kemudian simpan kembali filenya dan restart Apache web server.

![extension](img/extension.png)

## 3). Instalasi Codeigniter 4
Untuk melakukan instalasi Codeigniter 4 dapat dilakukan dengan dua cara, yaitu cara manual dan menggunakan composer. Pada praktikum ini kita menggunakan cara manual.
Buka browser dengan alamat http://localhost/Lab11Web/lab11_php_ci/ci4/public/

![install](img/instalasi.png)

## 4). Menjalankan CLI (Command Line Interface)
Menjalankan CLI (Command Line Interface) Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses CLI buka terminal/command prompt.

![CLI](img/run-cli.png)

Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat
(xampp/htdocs/Lab11Web/lab11_php_ci/ci4)
Perintah yang dapat dijalankan untuk memanggil CLI Codeigniter adalah:
```CLI
php spark
```

![spark](img/php_spark.png)

## 5). Mengaktifkan Mode Debugging
Codeigniter 4 menyediakan fitur debugging untuk memudahkan developer untuk mengetahui pesan error apabila terjadi kesalahan dalam membuat kode program. Secara default fitur ini belum aktif. Ketika terjadi error pada aplikasi akan ditampilkan pesan kesalahan seperti berikut.

![debug](img/debugging.png)

Semua jenis error akan ditampilkan sama. Untuk memudahkan mengetahui jenis errornya, maka perlu diaktifkan mode debugging dengan mengubah nilai konfigurasi pada environment variable CI_ENVIRONMENT menjadi development.

![env](img/env.png)

Ubah nama file env menjadi .env kemudian buka file tersebut dan ubah nilai variable CI_ENVIRONMENT menjadi development.

![parse](img/parse.png)

Contoh error yang terjadi. Untuk mencoba error tersebut, ubah kode pada file app/Controller/Home.php hilangkan titik koma pada akhir kode.

![error](img/home.png)

## 6). Membuat Routes Baru
Tambahkan code pada routes.php
```php
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```

![routes](img/routescode.png)

Untuk mengetahui route yang ditambahkan sudah benar, buka CLI dan jalankan
perintah berikut.
```CLI
php spark routes
```

![cmd](img/routes.png)

Selanjutnya coba akses route yang telah dibuat dengan mengakses alamat url http://localhost:8080/about

![about](img/404.png)

Ketika diakses akan mucul tampilan error 404 file not found, itu artinya file/page tersebut tidak ada. Untuk dapat mengakses halaman tersebut, harus dibuat terlebih dahulu Contoller yang sesuai dengan routing yang dibuat yaitu Contoller Page.

## 7). Membuat Controller
Selanjutnya adalah membuat Controller Page. Buat file baru dengan nama page.php pada direktori Controller kemudian isi kodenya seperti berikut.

```php
<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        echo "Ini halaman About";
    }
    public function contact()
    {
        echo "Ini halaman Contact";
    }
    public function faqs()
    {
        echo "Ini halaman FAQ";
    }
}
```

Berikut hasil run

![controller](img/about1.png)

## 8). Auto Routing
Secara default fitur autoroute pada Codeiginiter sudah aktif. Untuk mengubah status autoroute dapat mengubah nilai variabelnya. Untuk menonaktifkan ubah nilai true menjadi false.

```php
$routes->setAutoRoute(true);
```
Tambahkan method baru pada Controller Page seperti berikut.

```php
  public function tos()
    {
        echo "ini halaman Term of Services";
    }
```

Method ini belum ada pada routing, sehingga cara mengaksesnya dengan menggunakan
alamat:http://localhost:8080/page/tos

![tos](img/page.png)

## 9). Membuat View
Selanjutnya adalam membuat view untuk tampilan web agar lebih menarik. Buat file baru dengan nama about.php pada direktori view (app/view/about.php) kemudian isi kodenya seperti berikut.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>
<body>
    <h1><?= $title; ?></h1>
    <hr>
    <p><?= $content; ?></p>
</body>
</html>
```

Ubah method about pada class Controller Page menjadi seperti berikut:

```php
public function about()
    {
        return view('about', [
            'title' => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }
```

Refresh halaman tersebut

![about](img/about2.png)

## 10). Membuat Layout Web dengan CSS
Pada dasarnya layout web dengan css dapat diimplamentasikan dengan mudah pada codeigniter. Yang perlu diketahui adalah, pada Codeigniter 4 file yang menyimpan asset css dan javascript terletak pada direktori public.

Buat file css pada direktori public dengan nama style.css (copy file dari praktikum lab4_layout. Kita akan gunakan layout yang pernah dibuat pada praktikum 4.

![folder](img/copy.png)

Kemudian buat folder template pada direktori view kemudian buat file header.php dan footer.php

File app/views/template/header.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Layout Sederhana</h1>
    </header>
    <nav>
        <a href="<?= base_url('/');?>" class="active">Home</a>
        <a href="<?= base_url('/artikel');?>">Artikel</a>
        <a href="<?= base_url('/about');?>">About</a>
        <a href="<?= base_url('/contact');?>">Kontak</a>
    </nav>
<section id="wrapper">
    <section id="main">

```

File app/views/template/footer.php
```php
    </section>
    <aside id="sidebar">
        <div class="widget-box">
            <h3 class="title">Widget Header</h3>
            <ul>
                <li><a href="#">Widget Link</a></li>
                <li><a href="#">Widget Link</a></li>
            </ul>
        </div>
        <div class="widget-box">
            <h3 class="title">Widget Text</h3>
            <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada
tincidunt arcu. Proin in leo fringilla, vestibulum mi porta, faucibus felis.
Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
        </div>
    </aside>
</section>
<footer>
    <p>&copy; 2022 - Universitas Pelita Bangsa</p>
</footer>
</div>
</body>
</html>
```

Kemudian ubah file app/view/about.php seperti berikut.

```php
<?= $this->include('template/header'); ?>

<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>

<?= $this->include('template/footer'); ?>
```
Refresh halaman tersebut

![hasil](img/css.png)

---
---

# Praktikum 12 Framework Lanjutan (CRUD)

## Langkah - Langkah Praktikum :

## Persiapan
Untuk Memulai membuat aplikasi CRUD sederhana, yang perlu disiapkan adalah database server menggunakan MySQL. Pastikan MySQL Server sudah dapat dijalankan melalui XAMPP Control Panel.

## Membuat Database 
```
CREATE DATABASE lab_ci4;
```

![New_Database](img/newdatabase.png)

## Membuat Tabel
```
CREATE TABLE artikel (
  id INT(11) auto_increment,
  judul VARCHAR(200) NOT NULL,
  isi TEXT,
  gambar VARCHAR(200),
  status TINYINT(1) DEFAULT 0,
  slug VARCHAR(200),
  PRIMARY KEY(id)
);
```

![New_table](img/newtable.png)

![Tabke](img/table.png)

## Konfigurasi Koneksi Database
Selanjutnya membuat konfigurasi untuk menghubungkan dengan database server. Konfigurasi dapat dilakukan dengan dua acara, yaitu pada file **app/config/database.php** atau menggunakan file **.env**. Pada praktikum ini kita gunakan konfigurasi pada file **.env**.

![img](img/env1.png)

## Membuat Model
Selanjutnya adalah membuat Model untuk memproses data Artikel. Buat file baru pada direktori **app/Models** dengan nama **ArtikelModel.php**.

![img](img/artikelmodel.png)

## Membuat Controller
Buat Controllers baru dengan nama **Artikel.php** pada direktori **app/Controllers**.

![img](img/artikel.png)

## membuat View
Buat direktori baru dengan nama **artikel** pada direktori **app/view**, kemudian buat file baru dengan nama **index.php**.

![img](img/index.png)

Selanjutnya buka browser kembali, dengan mengakses url `http://localhost:8080/artikel`

![img](img/belumadadata.png)

Belum ada data yang ditampilkan. Kemudian tambahkan beberapa data pada database agar dapat ditampilkan dataya.

![img](img/data.png)

```
INSERT INTO artikel (judul, isi, slug) VALUE 
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun.', 'artikel-kedua');
 ```

Refresh kembali browser, sehingga akan ditampilkan hasilnya.

![img](img/artikel2.png)

## Membuat Tampilan Detail Artikel
Tampilan pada saat judul berita di klik maka akan diarahkan ke halaman yang berbeda. Tambahkan fungsi baru pada **Controller Artikel** dengan nama **view()**.

![img](img/view.png)

## Membuat View Detail
Buat view baru untuk halaman detail dengan nama **app/view/artikel/detail.php**

![img](img/detail.png)

## Membuat Routing Untuk Artikel Detail
Buka kembali file **app/config/Routes.php**, kemudian tambahkan routing untuk artikel detail.

![img](img/rounting.png)

Untuk melihat hasilnya bisa dengan mengklik salah satu artikelnya.

![img](img/artikelpertama.png)

![img](img/artikelkedua.png)

## Membuat Menu Admin
Menu admin adalah untuk proses CRUD data artikel. Buat method baru pada **Controller/Artikel** dengan nama **admin_index()**.

![img](img/adminindex.png)

Selanjutnya buat view untuk tampilan admin pada **Views/artikel** dengan nama **admin_index.php**

![img](img/adminindex2.png)

Tambahkan routing untuk menu admin seperti berikut :

![img](img/routingadmin.png)

Untuk mengakses menu admin bisa dengan menggunakan url `http://localhost:8080/admin/artikel`

![img](img/tampilanadmin.png)

## Menambahkan Data Artikel
Tambahkan fungsi/methode baru pada **Controller/Artikel** dengan nama **add()**.

![img](img/add.png)

Kemudian buat view untuk form tambahan dengan nama **form_add.php**.

![img](img/formedit.png)

Untuk mengakses menu add bisa dengan menggunakan url `http://localhost:8080/admin/artikel/add`

![img](img/tambahartikel.png)

## Mengubah Data
Tambahkan fungsi/methode baru pada **Controller/Admin** dengan nama **edit()**.

![img](img/controledit.png)

Untuk mengakses menu add bisa dengan menggunakan url `http://localhost:8080/admin/artikel/edit/...(nama artikel yang ingin di edit)`

![img](img/editartikel.png)

## Menghapus Data
Tambahkan fungsi/methode baru pada **Controller/Artikel** dengan nama **delet()**.

![img](img/formdelete.png)

Untuk menghapus suatu artikel dapat melalui menu artikel kemudain pilih artikel yang ingin di hapus dengan mengklik tombol **Hapus**.

![img](img/hapusartikel.png)


---
---

# Praktikum 13 Framework Lanjutan (Modul Login)

## Langkah - Langkah Praktikum

Untuk mmemulai membuat Modul Login, yang perlu disiapkan adalah database serber menggunakan MySQL. Pastikan MySQL Server sudah dapat dijalankan melalui XAMPP

## Membuat Tabel user Login

![img](img/usertable.png)

```
CREATE TABLE user (
  id INT(11) auto_increment,
  username VARCHAR(200) NOT NULL,
  useremail VARCHAR(200),
  userpassword VARCHAR(200),
  PRIMARY KEY(id) 
);
```

## Membuat Model User
Selanjutnya membuat Model untuk memproses data Login. Buat file baru pada direktori **app/Models** dengan nama **UserModel.php**

![img](img/usermodel.png)

## Membuat Controller User
Membuat Controller baru dengan nama **User.php** pada direktori **app/Controllers**. Kemudian tambahkan methode **index()**untuk menampilkan daftar user, dan methode **login()** untuk proses login.

```php
<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $user = $model->findALL();
        return view('user/index', compact('user', 'title'));
    }

    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        if (!$email)
        {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();
        $login = $model->where('useremail', $email)->first(); 
        if ($login)
        {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass))
            {
                $login_data = [
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                ];
                $session->set($login_data);
                return redirect('admin/artikel');
            }
            else
            {
                $session->setFlashdata("flash_msg", "Password salah");
                return redirect()->to('/user/login');
            }
        }
        else
        {
            $session->setFlashdata("flash_msg", "email tidak terdaftar.");
            return redirect()->to('/user/login');
        }        
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}
```

## Membuat View Login
Buat direktri baru dengan nama **user** pada direktori **app/views**, kemudian buat file baru dengan nama **login.php**

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="login-wrapper">
        <h1>Sign In</h1>
        <br>
        <?php if(session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('flash_msg') ?>
            </div>
        <?php endif;?>
        
        <form action="" method="post">
            <div class="mb-3">
                <!-- <label for="InputForEmail" class="form-label">Email address</label> <br> -->
                <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>" placeholder="Email address">
            </div>
            <div class="mb-3">
                <!-- <label for="InputForPassword" class="form-label">Password</label><br> -->
                <input type="password" name="password" class="form-control" id="InputForPassword" placeholder="Password"> 
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    
</body>
</html>
```

## Membuat Database Seeder
Database seeder digunakan untuk membuat data dummy. Untuk keperluan ujicoba modul login, kita perlu memasukan data user dan password kedalam database. Untuk itu buat database seeder untuk tabel user. Buka CLI, kemudain tulis perintah berikut :

```
php spark make:seeder UserSeeder
```

![img](img/seeder.png)

Selanjutnya, buka file **UserSeeder.php** yang berada di lokasi direktori **/app/Database/Seeds/UserSeeder.php** kemudian isi dengan kode berikut :

```php
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
		$model->insert([
			'username' => 'admin',
			'useremail' => 'admin@email.com',
			'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
		]);
    }
}
```

Selanjutnya buka kembali CLI dan ketik peritah berikut

```
php spark db:seed UserSeeder
```

![img](img/cliuserseeder.png)

Selanjutnya untuk ujicoba login dengan memasukan url berikut http://localhost:8080/user/login

![img](img/login.png)

## Menambahkan Auth Filter
Selanjutnya membuat filter untuk halaman admin. Buat file baru dengan nama **Auth.php** pada direktori **app/Filters**.

![img](img/authphp.png)

Selanjutnya buka file **app/Config/Filters.php** tambahkan kode berikut :

``` php
'auth' => App\Filters\Auth::class
```

![img](img/filterphp.png)

Selanjutnya buka file **app/Config/Routes.php** dan sesuaikan kodenya.

![img](img/configroutes.png)

Buka url berikut `http://localhost:8080/admin/artikel` ketika alamat tersebut diakses maka akan dimunculkan halaman login terlebih dahulu atau bisa juga melalui tombol login pada menu artikel.

![img](img/teslogin.png)

Berikut tampilan halaman admin/artikel ketika sudah masuk atau login menggunakan email : admin@email.com , dan password : admin123

![img](img/loginsukses.png)

## Fungsi Logout
Tambahkan methode logout pada **Controller/User** seperti berikut :

![img](img/controllerslogout.png)

Berikut tampilan tombol logout

![img](img/logoutclick.jpg)