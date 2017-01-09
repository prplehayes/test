<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PracticePaymentInfoFixture
 *
 */
class PracticePaymentInfoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'practice_payment_info';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'practice_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'first_name' => ['type' => 'string', 'length' => 65, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 65, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'token' => ['type' => 'string', 'length' => 24, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'expiration_month' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'expiration_year' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cvv' => ['type' => 'string', 'length' => 3, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'address_1' => ['type' => 'string', 'length' => 75, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'address_2' => ['type' => 'string', 'length' => 75, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'state' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'zip' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'recurring_active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'practice_id_practice_foriegn_idx' => ['type' => 'index', 'columns' => ['practice_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'practice_id_practice_foriegn' => ['type' => 'foreign', 'columns' => ['practice_id'], 'references' => ['practice', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
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
            'practice_id' => 1,
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit ',
            'expiration_month' => 1,
            'expiration_year' => 1,
            'cvv' => 'L',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'state' => 'Lorem ipsum dolor sit amet',
            'zip' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-03-18 20:31:07',
            'modified' => '2016-03-18 20:31:07',
            'recurring_active' => 1
        ],
    ];
}
