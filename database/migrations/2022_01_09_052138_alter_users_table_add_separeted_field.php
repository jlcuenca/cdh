<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddSeparetedField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('name');
            $table->string('paternal_lastname')->nullable()->after('name');
            $table->string('maternal_lastname')->nullable()->after('name');
            $table->string('gender')->default('unknown')->after('email');
            $table->string('state_name')->nullable()->after('is_active');
            $table->string('city_name')->nullable()->after('is_active');
            $table->text('address')->nullable()->after('is_active');
            $table->date('date_of_birth')->nullable()->after('is_active');
            $table->string('phone')->nullable()->after('is_active');
            $table->string('postal_code')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'firstname',
                'paternal_lastname',
                'maternal_lastname',
                'gender',
                'state_name',
                'city_name',
                'address',
                'date_of_birth',
                'phone',
                'postal_code',
            ]);
        });
    }
}
