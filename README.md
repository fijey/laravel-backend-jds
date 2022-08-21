# Express Backend JDS

## About
Aplikasi ini dibuat untuk memenuhi soal tes dari JABAR DIGITAL SERVICE disini ada 2 app yang sudah disatukan
1. [Authenticate App](https://github.com/fijey/laravel-backend-jds)
Dibuat menggunakan PHP Laravel Framework
2. [Fetch App](https://github.com/fijey/express-jds)
Dibuat Menggunakan Express JS

#Teknis
ketika menjalankan POST express.visualkreatif.com/api/auth/signup ataupun express.visualkreatif.com/api/auth/signin  maka akan di teruskan ke Authenticate App Laravel menggunakan API, setelah mengembalikan token maka akan disimpanoleh express sebagai keperluan authenticate di halaman yang memerlukan midleware authenticate
