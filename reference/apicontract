Siap. Berikut adalah perbaikan **API Contract (RESTful API)** untuk sistem **Neosorogan LMS** berdasarkan struktur data yang sudah diperbaiki sebelumnya. API ini menggunakan prinsip REST dan cocok diimplementasikan di Laravel menggunakan controller-resource.

---

### 🧾 AUTHENTICATION

| Method | Endpoint        | Body / Query Params               | Response          |
| ------ | --------------- | --------------------------------- | ----------------- |
| POST   | `/api/register` | `{ name, email, password, role }` | `201 Created`     |
| POST   | `/api/login`    | `{ email, password }`             | `{ token, user }` |
| POST   | `/api/logout`   | -                                 | `200 OK`          |
| GET    | `/api/me`       | -                                 | `{ user }`        |

---

### 🎓 SISWA

### Get Dashboard Data

| Method | Endpoint               | Response                                                              |
| ------ | ---------------------- | --------------------------------------------------------------------- |
| GET    | `/api/siswa/dashboard` | `{ tugasHariIni, progressKalender, materiTerbaru, punishmentStatus }` |

### CRUD Tugas Harian

| Method | Endpoint          | Body                                                                      | Response                 |
| ------ | ----------------- | ------------------------------------------------------------------------- | ------------------------ |
| GET    | `/api/tugas`      | -                                                                         | `List tugas milik siswa` |
| POST   | `/api/tugas`      | `{ tanggal, kata1, kata2, kata3, kata4, kata5, deskripsi1-5, contoh1-5 }` | `201 Created`            |
| PUT    | `/api/tugas/{id}` | `same as POST`                                                            | `200 OK`                 |
| DELETE | `/api/tugas/{id}` | -                                                                         | `204 No Content`         |

### Kalender Tugas

| Method | Endpoint        | Response                         |
| ------ | --------------- | -------------------------------- |
| GET    | `/api/kalender` | `{ tanggal, status, bintang }[]` |

---

### 👩‍🏫 GURU

### Manajemen Kelas & Siswa

| Method | Endpoint                           | Body             | Response                   |
| ------ | ---------------------------------- | ---------------- | -------------------------- |
| GET    | `/api/kelas`                       | -                | `List kelas yang dikelola` |
| POST   | `/api/kelas`                       | `{ nama_kelas }` | `201 Created`              |
| GET    | `/api/kelas/{id}/siswa`            | -                | `List siswa`               |
| POST   | `/api/kelas/{id}/siswa`            | `{ siswa_id }`   | `201 OK`                   |
| DELETE | `/api/kelas/{id}/siswa/{siswa_id}` | -                | `204 No Content`           |

### Nilai Tugas

| Method | Endpoint                      | Body                                 | Response           |
| ------ | ----------------------------- | ------------------------------------ | ------------------ |
| GET    | `/api/tugas/siswa/{siswa_id}` | -                                    | `List tugas siswa` |
| PUT    | `/api/tugas/{tugas_id}/nilai` | `{ bintang: int, komentar: string }` | `200 OK`           |

### Upload Materi

| Method | Endpoint           | Body                       | Response         |
| ------ | ------------------ | -------------------------- | ---------------- |
| POST   | `/api/materi`      | `{ judul, file (upload) }` | `201 Created`    |
| GET    | `/api/materi`      | -                          | `List materi`    |
| DELETE | `/api/materi/{id}` | -                          | `204 No Content` |

---

### 🧑‍💼 ADMIN

### Manajemen User

| Method | Endpoint                | Body                     | Response          |
| ------ | ----------------------- | ------------------------ | ----------------- |
| GET    | `/api/admin/users`      | -                        | `List semua user` |
| PUT    | `/api/admin/users/{id}` | `{ name, role, status }` | `200 OK`          |
| DELETE | `/api/admin/users/{id}` | -                        | `204 No Content`  |

### Monitoring Aktivitas

| Method | Endpoint    | Response                  |
| ------ | ----------- | ------------------------- |
| GET    | `/api/logs` | `List aktivitas pengguna` |

---

### 🔗 PENGGUNAAN

-   Semua endpoint memerlukan **token Bearer** kecuali `register` dan `login`.
-   Role berdasarkan JWT: `siswa`, `guru`, `admin`
-   File materi dan tugas bisa pakai `multipart/form-data`.

---

Kalau kamu ingin implementasi Laravel-nya (model, controller, route, middleware), saya bisa bantu lanjut juga. Ingin saya bantu generatekan juga?
