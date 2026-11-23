# Dashboard Transportasi dan Infrastruktur Jawa Tengah (2020–2021)

Proyek ini mengintegrasikan data transportasi, infrastruktur jalan, dan kecelakaan lalu lintas di Provinsi Jawa Tengah pada periode 2020–2021. Data dari berkas Excel, CSV, dan API Badan Pusat Statistik (BPS) diolah melalui proses *Extract, Transform, Load* (ETL) menggunakan Python, disimpan dalam data warehouse MySQL, dan disajikan melalui dashboard interaktif berbasis Laravel dan ApexCharts.

Proyek ini dikerjakan oleh **Kelompok B** sebagai tugas mata kuliah **Integrasi Aplikasi Korporasi (IAK)**, Program Studi S1 Teknologi Sains Data, Universitas Airlangga.

## Tujuan Proyek

- Mengintegrasikan data transportasi dari berbagai sumber dan format.
- Menyusun data dalam tabel dimensi dan fakta agar dapat digunakan secara konsisten.
- Menghasilkan indikator terkait debarkasi penumpang, kendaraan bermotor, panjang jalan, dan kecelakaan lalu lintas.
- Menyajikan hasil analisis dalam dashboard interaktif.

## Teknologi yang Digunakan

| Komponen | Teknologi |
| --- | --- |
| Ekstraksi, pembersihan, dan transformasi data | Python 3.11, pandas, NumPy, Requests |
| Pemuatan dan verifikasi data | SQLAlchemy, PyMySQL |
| Pembacaan berkas Excel | openpyxl, xlrd |
| Data warehouse | MySQL |
| Aplikasi web | PHP, Laravel |
| Visualisasi | ApexCharts |
| Pengembangan | Jupyter Notebook, Visual Studio Code, Git |

## Sumber Data

Data berasal dari publikasi dan layanan data Badan Pusat Statistik (BPS).

| Dataset | Periode | Format |
| --- | --- | --- |
| Debarkasi penumpang penerbangan domestik | 2020–2021 | Excel (`.xlsx`) |
| Debarkasi penumpang angkutan laut | 2020–2021 | API BPS (JSON) |
| Kecelakaan lalu lintas, korban, dan kerugian materiil | 2020–2021 | Excel (`.xls`) |
| Panjang jalan menurut tingkat kewenangan | 2020–2021 | CSV |
| Kendaraan bermotor menurut jenis dan kabupaten/kota | 2020–2021 | CSV |

Data berbasis wilayah mencakup **35 kabupaten/kota di Jawa Tengah**. Kabupaten dan kota dengan nama yang serupa dibedakan berdasarkan wilayah administratifnya.

## Alur Pengolahan Data

```text
Excel / CSV / API BPS
        |
        v
Ekstraksi data dengan Python
        |
        v
Pembersihan dan standardisasi data
        |
        v
Pembentukan tabel dimensi dan fakta
        |
        v
Perhitungan indikator dan validasi
        |
        v
Pemuatan data ke MySQL
        |
        v
Verifikasi hasil pemuatan
        |
        v
Dashboard Laravel + ApexCharts
```

Proses ETL meliputi pembacaan data dari sumber yang berbeda, pembersihan dan penyeragaman struktur, transformasi data dari format *wide* ke *long*, pembentukan tabel dimensi dan fakta, serta perhitungan indikator turunan. Hasil pengolahan dimuat ke MySQL dengan urutan tabel dimensi sebelum tabel fakta, lalu diverifikasi terhadap DataFrame hasil transformasi.

## Struktur Data Warehouse

Data warehouse terdiri dari **7 tabel dimensi** dan **4 tabel fakta**.

### Tabel Dimensi

| Tabel | Keterangan |
| --- | --- |
| `dim_tahun` | Tahun pengamatan |
| `dim_bulan` | Bulan dan kuartal |
| `dim_lokasi` | Kabupaten/kota |
| `dim_jenis_transportasi` | Moda transportasi |
| `dim_jenis_kendaraan` | Jenis kendaraan bermotor |
| `dim_jenis_jalan` | Kategori kewenangan jalan |
| `dim_indikator_kecelakaan` | Indikator kecelakaan dan dampaknya |

### Tabel Fakta

| Tabel | Tingkat perincian | Jumlah baris |
| --- | --- | ---: |
| `fakta_transportasi` | Bulan × tahun × jenis transportasi | 48 |
| `fakta_kecelakaan` | Kabupaten/kota × tahun × indikator | 350 |
| `fakta_kepadatan` | Kabupaten/kota × tahun × jenis kendaraan | 280 |
| `fakta_risiko` | Kabupaten/kota × tahun | 70 |

Ketujuh tabel dimensi memuat **63 baris**, sedangkan keempat tabel fakta memuat **748 baris**, sehingga total hasil pemuatan adalah **811 baris**.

### Indikator Turunan

- **Kendaraan per kilometer jalan:** jumlah kendaraan berdasarkan jenis dibagi total panjang jalan (km) pada wilayah dan tahun terkait.
- **Kecelakaan per kilometer jalan:** jumlah kejadian kecelakaan dibagi total panjang jalan (km) pada wilayah dan tahun terkait.

Kedua indikator tersebut bersifat deskriptif dan tidak secara langsung mengukur kemacetan atau probabilitas kecelakaan.

## Validasi dan Kualitas Data

Validasi dilakukan untuk memastikan kelengkapan dan konsistensi data sebelum dimuat ke MySQL. Pemeriksaan meliputi nilai kosong, duplikasi, identitas wilayah, relasi antara tabel dimensi dan fakta, serta hasil perhitungan indikator.

Beberapa karakteristik data sumber yang menjadi perhatian selama pengolahan meliputi:

- **Konsistensi data kendaraan:** terdapat perbedaan antara total kendaraan yang dilaporkan dan jumlah berdasarkan kategori kendaraan pada salah satu wilayah.
- **Kelengkapan data panjang jalan:** beberapa komponen tidak tersedia atau tidak sesuai dengan total yang dilaporkan. Perhitungan indikator menggunakan total panjang jalan yang tercantum pada sumber.
- **Standardisasi wilayah:** kabupaten dan kota dengan nama serupa dipetakan sebagai wilayah administratif yang berbeda.
- **Standardisasi satuan:** nilai kerugian materiil dinyatakan dalam juta rupiah untuk penyajian pada dashboard.

Setelah pemuatan, jumlah baris, integritas kunci, kelengkapan kombinasi data, dan kesesuaian nilai diperiksa kembali terhadap hasil transformasi Python. **Seluruh 11 tabel berhasil dimuat dan diverifikasi.**

## Fitur Dashboard

Dashboard menampilkan:

1. Tren debarkasi penumpang per kuartal dengan filter tahun.
2. Proporsi debarkasi penumpang berdasarkan moda transportasi dan tahun.
3. Jumlah kecelakaan lalu lintas menurut kabupaten/kota dan tahun.
4. Lima kabupaten/kota dengan jumlah korban meninggal terbanyak.
5. Lima kabupaten/kota dengan kerugian materiil tertinggi.
6. Jumlah mobil penumpang, bus, dan truk menurut tahun.
7. Lima kabupaten/kota dengan rasio sepeda motor per kilometer jalan tertinggi.
8. Rasio kecelakaan per kilometer jalan menurut kabupaten/kota.

Visualisasi menggunakan data yang diambil dari MySQL melalui aplikasi Laravel.

## Tampilan Dashboard

![Tampilan Dashboard Transportasi 1](screenshots/Transportasi%20Dashboard%20%281%29.png)

![Tampilan Dashboard Transportasi 2](screenshots/Transportasi%20Dashboard%20%282%29.png)

![Tampilan Dashboard Transportasi 3](screenshots/Transportasi%20Dashboard%20%283%29.png)

## Berkas Proyek

| Berkas atau direktori | Keterangan |
| --- | --- |
| `transportation_etl.ipynb` | Notebook pengolahan data: ekstraksi, transformasi, pembentukan tabel, validasi, dan pemuatan data |
| `requirements.txt` | Daftar dependensi Python yang digunakan pada notebook ETL |
| `app/`, `routes/`, `resources/` | Komponen aplikasi dashboard Laravel |
| `database/` | Direktori basis data pada proyek Laravel |
| `screenshots/` | Dokumentasi tampilan dashboard |

## Batasan Analisis

- Data yang dianalisis mencakup periode 2020–2021.
- Jumlah kendaraan merupakan data kendaraan yang tercatat, bukan volume kendaraan yang melintas pada ruas jalan tertentu.
- Rasio kendaraan dan kecelakaan terhadap panjang jalan digunakan untuk perbandingan deskriptif antarwilayah.

## Kontributor

**Kelompok B — Integrasi Aplikasi Korporasi (IAK)**  
Program Studi S1 Teknologi Sains Data, Fakultas Teknologi Maju dan Multidisiplin, Universitas Airlangga

- Aura Najma Kustiananda
- Fitra Shafa Humaira
- Pradipta Deska Pryanda
- Ulvi Azzahra

## Kredit

- **Sumber data:** Badan Pusat Statistik (BPS).
- **Template antarmuka:** [Soft UI Dashboard Laravel](https://www.creative-tim.com/product/soft-ui-dashboard-laravel) oleh Creative Tim dan UPDIVISION, yang digunakan sebagai dasar tampilan aplikasi.
