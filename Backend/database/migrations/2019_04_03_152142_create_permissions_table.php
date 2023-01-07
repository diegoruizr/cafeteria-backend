<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('parent')->nullable();
            $table->string('action')->nullable()->default('');
            $table->string('description');
            $table->string('view')->nullable()->default('');
            $table->string('route')->nullable()->default('');
            $table->integer('is_group');
            $table->integer('code');
            $table->integer('state');
            $table->integer('id_configurations')->nullable()->comment("Id de la tabla configurations a relacionar en permisos");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
