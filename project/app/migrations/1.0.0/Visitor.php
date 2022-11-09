<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class VisitorMigration_100
 */
class VisitorMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Visitor', [
                'columns' => [
                    new Column(
                        'v_event_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'v_user_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'v_event_id'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('v_event_id', ['v_event_id'], ''),
                    new Index('v_user_id', ['v_user_id'], '')
                ],
                'references' => [
                    new Reference(
                        'visitor_ibfk_1',
                        [
                            'referencedSchema' => 'fycphalcon',
                            'referencedTable' => 'Event',
                            'columns' => ['v_event_id'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'visitor_ibfk_2',
                        [
                            'referencedSchema' => 'fycphalcon',
                            'referencedTable' => 'User',
                            'columns' => ['v_user_id'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8mb4_unicode_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
