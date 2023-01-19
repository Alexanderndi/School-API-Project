<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $usersSeedValue = [];

    public function __construct()
    {
        $usersSeedValue = [
            [
                'name' => 'Eduo Ndifreke',
                'email' => 'eduondifreke@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => now()
            ],
            [
                'name' => 'Eduo Ndi',
                'email' => 'ndieduo@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => now()
            ]
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $usersSeedValue = [
            [
                'name' => 'Eduo Ndifreke',
                'email' => 'eduondifreke@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => now()
            ],
            [
                'name' => 'Eduo Ndi',
                'email' => 'ndieduo@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => now()
            ]
        ];
        DB::table("users")->insert($usersSeedValue);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->whereIn(
            'email',
            array_map(
                function ($row) {
                    return $row["email"];
                },
                $this->usersSeedValue
            )
        )->delete();
    }
};
