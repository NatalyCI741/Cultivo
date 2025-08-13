<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cultivos', function (Blueprint $table) {
            // Agregar la columna user_id como nullable primero
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Asignar un user_id válido a los registros existentes
        // Obtener el primer usuario admin disponible
        $adminUser = DB::table('users')->where('role', 'admin')->first();
        
        if ($adminUser) {
            // Asignar todos los cultivos existentes al primer admin
            DB::table('cultivos')->whereNull('user_id')->update(['user_id' => $adminUser->id]);
        } else {
            // Si no hay admin, asignar al primer usuario disponible
            $firstUser = DB::table('users')->first();
            if ($firstUser) {
                DB::table('cultivos')->whereNull('user_id')->update(['user_id' => $firstUser->id]);
            }
        }

        // Ahora hacer la columna NOT NULL y agregar la foreign key
        Schema::table('cultivos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('cultivos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};