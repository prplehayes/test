<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 *
 */
class NotesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'claim_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note' => ['type' => 'string', 'length' => 300, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'option1' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'option2' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'option3' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'option4' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => 'Review', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'patient_info_patient_id_foriegn_idx' => ['type' => 'index', 'columns' => ['claim_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'claim_id' => ['type' => 'foreign', 'columns' => ['claim_id'], 'references' => ['claim', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'claim_id' => 1,
            'user_id' => 1,
            'note' => 'Lorem ipsum dolor sit amet',
            'option1' => 'Lorem ipsum dolor sit amet',
            'option2' => 'Lorem ipsum dolor sit amet',
            'option3' => 'Lorem ipsum dolor sit amet',
            'option4' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created' => '2016-03-26 20:17:27'
        ],
    ];
}
