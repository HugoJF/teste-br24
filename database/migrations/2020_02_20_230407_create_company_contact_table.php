<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_contact', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('company_cnpj');
            $table->foreign('company_cnpj')->references('cnpj')->on('companies');

            $table->unsignedBigInteger('contact_cpf');
            $table->foreign('contact_cpf')->references('cpf')->on('contacts');

            $table->unique(['company_cnpj', 'contact_cpf']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_contact');
    }
}
