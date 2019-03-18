<?php namespace Zombiecorp\Brdocs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddAddressToUser extends Migration
{
    public function up()
    {
        if (Schema::hasColumns('users', [
            'cnpj', 'rg', 'cnh', 'titulo_de_eleitor',
            'passaporte', 'pis', 'nis'
        ])) {
            return;
        }

        Schema::table('users', function($table)
        {
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('cnh')->nullable();
            $table->string('titulo_de_eleitor')->nullable();
            $table->string('passaporte')->nullable();
            $table->string('pis')->nullable();
            $table->string('nis')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                $table->dropColumn([
                    'cpf', 'rg', 'cnh', 'titulo_de_eleitor',
                    'passaporte', 'pis', 'nis'
                ]);
            });
        }
    }
}
