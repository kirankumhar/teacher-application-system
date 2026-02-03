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
        Schema::table('applicants', function (Blueprint $table) {
            $table->boolean('already_applied')->default(false)->after('user_id');
            $table->date('dob')->nullable()->after('gender');
            $table->string('mobile', 15)->nullable()->after('dob');
            $table->string('handicapped_remark')->nullable()->after('handicapped');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn([
                'already_applied',
                'dob',
                'mobile',
                'handicapped_remark',
            ]);
        });
    }
};
