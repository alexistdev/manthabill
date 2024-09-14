NOTE: Sedang dalam pengembangan Manthabill versi 2 dengan menggunakan Laravel 11 : <a href="https://github.com/alexistdev/manthabill/tree/development">Link</a>

Manthabill adalah software manajemen billing /invoice untuk pemilik Hosting atau yang sedang menjalankan bisnis Hosting. Software ini gratis, tapi mohon untuk tidak menghilangkan link copyrightnya.<br>
Dikembangkan dengan:<br>
<ul>
	<li>Framework : Codeigniter 3</li>
	<li>Template : https://adminlte.io/</li>
	<li>PHP version : PHP 5.6 <a href="https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.3/" target="_blank">Download disini</a></li>
</ul>
<br><br>

Installasi di Hosting:</br>
1. git clone https://github.com/alexistdev/manthabill.git</br>
2. Upload dan pastikan ubah PHP version menjadi 5.6.
3. Buat database dan upload database di folder dengan nama file: manthabill.sql</br>
4. Buka file config/database dan lakukan pengaturan username, database, dan passwordnya.</br>
5. Buka file config/email lakukan pengaturan smtp untuk mengirimkan email.</br>
6. pasang cronjob di cpanel anda dengan contoh penulisan spt ini wget -qO- http://manthabill.com/Cronjob > /dev/null 2>&1
</br></br>

Installasi di Localhost:</br>
1. Pastikan system anda sudah menggunakan php 5.6, ketik di cmd : php -v
2. Buat database manthabill dan import database manthabill.sql
3. Buka file config/database.php dan lakukan pengaturan konfigurasi database, username, password
4. Buka file config/config.php dan ubah url menjadi dibawah ini (pastikan sama dengan url saat aplikasi anda diakses):
<pre>
$config['base_url'] = 'http://localhost/manthabill/'; </pre>

5. login dengan info berikut:
<pre>
Administrator
URL: http://localhost/manthabill/staff
username: admin
password: admin

User
URL http://localhost/manthabill/
silahkan registrasi untuk dapat login</pre>


Catatan:</br>
Ongoing development untuk versi laravel 11

Silahkan digunakan, jika ada yang butuh bantuan bisa kontak saya di email: alexistdev@gmail.com</br>
atau buka saja issue di github


Gambar:</br>

#### Gambar:Halaman Administrator:
<br />
<img src="https://github.com/alexistdev/manthabill/blob/master/Photo/gambar1.png?raw=true" width="1200px">
<br />

#### Gambar:Halaman Client:
<br />
<img src="https://github.com/alexistdev/manthabill/blob/master/Photo/gambar2.png?raw=true" width="1200px">
<br />

#### Gambar:Halaman Service:
<br />
<img src="https://github.com/alexistdev/manthabill/blob/master/Photo/gambar3.png?raw=true" width="1200px">
<br />

#### Gambar:Halaman Detail User:
<br />
<img src="https://github.com/alexistdev/manthabill/blob/master/Photo/gambar4.png?raw=true" width="1200px">
<br />

#### Gambar:Halaman Detail Invoice:
<br />
<img src="https://github.com/alexistdev/manthabill/blob/master/Photo/gambar5.png?raw=true" width="1200px">
<br />
