<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('mahasiswa', 'kelas_id')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->dropColumn('kelas');
                $table->unsignedBigInteger('kelas_id')->nullable();
                $table->foreign('kelas_id')->references('id')->on('kelas');
            });
        }
//        Schema::table('mahasiswa', function (Blueprint $table) {
//            $table->dropColumn('kelas_id');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa',function (Blueprint $table){
//            $table->bigInteger('kelas_id')->unsigned()->nullable();
            $table->string('kelas');
            $table->dropColumn('kelas_id');
            $table->dropForeign(['kelas_id']);
        });
    }
};
