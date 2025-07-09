<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'target_rank')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('target_rank')->after('requirements');
            });
        }
    }


    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['target_rank', 'additional_notes']);
        });
    }
};