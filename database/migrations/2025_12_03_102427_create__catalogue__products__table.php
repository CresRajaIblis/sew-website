<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nama kelas unik untuk menghindari bentrokan
class CreateCatalogueProductsTable extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'products' untuk menyimpan data katalog.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Kunci utama otomatis (ID Produk)
            
            // Informasi Dasar Produk
            $table->string('name', 255)->comment('Nama produk, contoh: Dress Formal Elegant');
            $table->text('description')->nullable()->comment('Deskripsi singkat produk');
            $table->unsignedInteger('price')->comment('Harga jual produk (tanpa diskon)');
            $table->unsignedInteger('old_price')->nullable()->comment('Harga lama untuk indikasi diskon');
            
            // Klasifikasi
            $table->string('category', 50)->comment('Kategori produk (formal, casual, batik, premium)');
            $table->enum('gender', ['pria', 'wanita'])->comment('Target gender (pria atau wanita)');
            $table->string('badge', 20)->nullable()->comment('Badge produk (hot, new, sale)');
            
            // Data Visual & Keterangan
            $table->float('rating', 2, 1)->default(0.0)->comment('Rating produk (0.0 - 5.0)');
            $table->unsignedInteger('reviews_count')->default(0)->comment('Jumlah ulasan');
            $table->string('image_url')->nullable()->comment('URL gambar utama produk');
            $table->string('bg_class', 50)->nullable()->comment('Class CSS untuk background preview produk');

            // Opsi Variasi (Disimpan sebagai JSON, contoh: ["black", "white", "navy"])
            $table->json('colors')->nullable()->comment('Daftar warna yang tersedia dalam format JSON');
            
            $table->timestamps(); // kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan (rollback) migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}