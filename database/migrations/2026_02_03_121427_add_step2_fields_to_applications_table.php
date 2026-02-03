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
            $table->integer('application_step')->default(1)->after('user_id');
            $table->text('address')->nullable()->after('category');
            $table->string('category_certificate_no')->nullable()->after('category');
            $table->enum('aadhaar_pan_type', ['aadhaar', 'pan'])->nullable();
            $table->string('aadhaar_pan_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn([
                'application_step',
                'address',
                'category_certificate_no',
                'aadhaar_pan_type',
                'aadhaar_pan_no',
            ]);
        });
    }
};
