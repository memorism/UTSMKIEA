# Laporan Proyek Laravel Service-to-Service

## Judul Proyek
Implementasi Sistem Service-to-Service Berbasis Laravel untuk Pemesanan Produk

## 1. Latar Belakang
Di era modern, integrasi antar layanan menjadi kunci utama dalam membangun sistem informasi yang efisien. Dalam proyek ini, dirancang sistem berbasis arsitektur Service-to-Service menggunakan Laravel untuk menyimulasikan proses pemesanan produk yang melibatkan tiga layanan terpisah: layanan user, produk, dan order.

## 2. Tujuan
- Membangun layanan microservice sederhana berbasis Laravel
- Menghubungkan 3 layanan secara independen menggunakan HTTP
- Menguji komunikasi antar layanan menggunakan Postman

## 3. Desain Arsitektur
+--------------+     +----------------+     +----------------+
| User Service | --> |                |     |                |
|  (port 8001) |     |  Order Service | --> | Product Service|
|              |     |  (port 8003)   |     |   (port 8002)  |
+--------------+     +----------------+     +----------------+

## 4. Detail Setiap Service
a. User Service
- URL: /api/users/{id}
- Port: 8001
- Contoh Response:
{ "id": 1, "name": "Budi", "email": "budi@example.com" }

b. Product Service
- URL: /api/products/{id}
- Port: 8002
- Contoh Response:
{ "id": 101, "name": "Laptop", "price": 8500000 }

c. Order Service
- URL: /api/orders
- Port: 8003
- Method: POST
- Contoh Request:
{ "user_id": 1, "product_id": 101 }
- Contoh Response:
{ "order_id": "1101", "user": {...}, "product": {...}, "total": 8500000 }

## 5. Tools & Teknologi
- Laravel 11
- PHP 8+
- Postman
- REST API
- Arsitektur Service-to-Service

## 6. Pengujian
- Menggunakan Postman untuk request ke masing-masing service
- Validasi endpoint GET dan POST
- Debugging menggunakan try-catch dan response()->json()

## 7. Kesimpulan
Sistem berhasil dibangun dengan komunikasi antar layanan berjalan dengan baik. Proyek ini menunjukkan bahwa Laravel mampu digunakan sebagai pendekatan modular untuk integrasi service-to-service, memudahkan pengembangan sistem yang scalable dan terdistribusi.

