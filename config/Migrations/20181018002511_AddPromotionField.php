<?php
use Migrations\AbstractMigration;

class AddPromotionField extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('clients');
        $table->addColumn('promotion_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->update();
    }
}
