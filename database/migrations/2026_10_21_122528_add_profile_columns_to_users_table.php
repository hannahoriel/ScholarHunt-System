<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal
            $table->string('first_name', 80)->after('id');
            $table->string('middle_name', 80)->nullable()->after('first_name');
            $table->string('surname', 80)->after('middle_name');
            $table->date('birthday')->after('surname');
            $table->unsignedTinyInteger('age')->after('birthday');
            $table->enum('sex', ['male', 'female'])->after('age');
            $table->string('contact_number', 15)->after('sex');

            // Education
            $table->enum('education_level', ['shs', 'college'])->after('contact_number');
            $table->enum('shs_grade', ['11', '12'])->nullable()->after('education_level');
            $table->string('shs_strand', 20)->nullable()->after('shs_grade');
            $table->enum('college_year', ['1', '2', '3', '4', '5'])->nullable()->after('shs_strand');
            $table->string('college_course', 150)->nullable()->after('college_year');
            $table->string('school_name', 150)->after('college_course');
            $table->string('school_address', 255)->after('school_name');

            // Home address
            $table->string('address_street', 150)->after('school_address');
            $table->string('address_barangay', 100)->after('address_street');
            $table->string('address_city', 100)->after('address_barangay');
            $table->string('address_province', 100)->after('address_city');
            $table->char('address_zip', 4)->after('address_province');

            // Drop the catch-all 'name' column; we store first/middle/surname separately.
            // We keep the column but make it nullable so existing rows (if any) aren't broken.
            $table->string('name')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'middle_name', 'surname', 'birthday', 'age', 'sex',
                'contact_number', 'education_level', 'shs_grade', 'shs_strand',
                'college_year', 'college_course', 'school_name', 'school_address',
                'address_street', 'address_barangay', 'address_city',
                'address_province', 'address_zip',
            ]);
            $table->string('name')->nullable(false)->change();
        });
    }
};
