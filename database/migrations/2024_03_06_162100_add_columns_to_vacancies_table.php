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
        Schema::table('vacancies', function (Blueprint $table) {

            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('salary_id')->constrained()->onDelete('cascade');
            $table->string('company');
            $table->date('last_day');
            $table->text('description');
            $table->string('image');// name y ubicacion de la imagen
            $table->integer('published')->default(1);// saber si ha sido publicado, para revertirlo ono
            $table->foreignId('user_id')->constrained()->onDelete('cascade');// saber quien lo publico

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            //eliminar las claves foraneas, evitando el error que produce el constrained por seguridad
            $table->dropForeign('vacancies_category_id_foreign');
            $table->dropForeign('vacancies_salary_id_foreign');
            $table->dropForeign('vacancies_user_id_foreign');
            // aqui ya puedes eliminarlos sin problemas
            $table->dropColumn([
                'title',
                'category_id',
                'salary_id',
                'company',
                'last_day',
                'description',
                'image',
                'published',
                'user_id',
            ]);
        });
    }
};
