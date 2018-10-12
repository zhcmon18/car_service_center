<?php
use Migrations\AbstractSeed;

/**
 * Clients seed.
 */
class ClientsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Pavel Zaharciuc',
                'slug' => 'Pavel-Zaharciuc',
                'telephone' => '450-333-3336',
                'address' => '111 Rue Test',
                'email' => 'pavelz@mail.com',
                'created' => '2018-10-11 15:23:32',
                'modified' => '2018-10-11 15:25:26',
            ],
            [
                'id' => '2',
                'name' => 'Michel Schreyer',
                'slug' => 'Michel-Schreyer',
                'telephone' => '450-222-3434',
                'address' => '1600 Rue Street',
                'email' => 'schreyerm@mail.com',
                'created' => '2018-10-11 15:26:51',
                'modified' => '2018-10-11 15:26:51',
            ],
            [
                'id' => '3',
                'name' => 'Yousef Bokari',
                'slug' => 'Yousef-Bokari',
                'telephone' => '514-545-2323',
                'address' => '3455 Rue Quelquepart',
                'email' => 'bokariy@mail.com',
                'created' => '2018-10-11 15:37:34',
                'modified' => '2018-10-11 15:37:34',
            ],
        ];

        $table = $this->table('clients');
        $table->insert($data)->save();
    }
}
