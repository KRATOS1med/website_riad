<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chambre', function (Blueprint $table) {
            $table->unsignedBigInteger('riad_id')->nullable()->after('disponibilite');
            // Optionally, add foreign key constraint if you have a riads table:
            // $table->foreign('riad_id')->references('id')->on('riads')->onDelete('set null');
            });
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('chambre', function (Blueprint $table) {
                $table->dropColumn('riad_id');
            });
        }
    };