<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->nullable();
        });
        
        // Générer des UUIDs pour les réservations existantes
        // Ajout de orderBy('id') pour éviter l'erreur
        DB::table('reservations')->whereNull('uuid')->orderBy('id')->each(function ($reservation) {
            DB::table('reservations')
                ->where('id', $reservation->id)
                ->update(['uuid' => Str::uuid()]);
        });
        
        Schema::table('reservations', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->change();
            $table->unique('uuid');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropUnique(['uuid']);
            $table->dropColumn('uuid');
        });
    }
};
