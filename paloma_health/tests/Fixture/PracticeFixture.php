<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PracticeFixture
 *
 */
class PracticeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'practice';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Identifier' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'contact_name' => ['type' => 'string', 'length' => 80, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'contact_phone' => ['type' => 'string', 'length' => 22, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'contact_email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'website' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'practitioner_count' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'mpi_number' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'practice_status_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'practice_modified_by_foriegn_idx' => ['type' => 'index', 'columns' => ['modified_by'], 'length' => []],
            'practice_practice_status_foriegn_idx' => ['type' => 'index', 'columns' => ['practice_status_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'Identifier_UNIQUE' => ['type' => 'unique', 'columns' => ['Identifier'], 'length' => []],
            'practice_modified_by_foriegn' => ['type' => 'foreign', 'columns' => ['modified_by'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'practice_practice_status_foriegn' => ['type' => 'foreign', 'columns' => ['practice_status_id'], 'references' => ['practice_status', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'Identifier' => 'Lorem ipsum dolor sit amet',
            'contact_name' => 'Lorem ipsum dolor sit amet',
            'contact_phone' => 'Lorem ipsum dolor si',
            'contact_email' => 'Lorem ipsum dolor sit amet',
            'website' => 'Lorem ipsum dolor sit amet',
            'practitioner_count' => 1,
            'mpi_number' => 'Lorem ipsum dolor sit amet',
            'practice_status_id' => 1,
            'created' => '2016-03-03 19:10:23',
            'modified' => '2016-03-03 19:10:23',
            'modified_by' => 1
        ],
    ];
}
