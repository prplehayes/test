<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClaimFixture
 *
 */
class ClaimFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'claim';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'patient_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'claim_number' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'claim_status_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '2', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dental_verification_upload' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'progress_notes_upload' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 75, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'signature' => ['type' => 'string', 'length' => 75, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'date_of_service' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'string', 'length' => 500, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'claim_patient_id_foriegn_idx' => ['type' => 'index', 'columns' => ['patient_id'], 'length' => []],
            'claim_status_id_claim_status_foriegn_idx' => ['type' => 'index', 'columns' => ['claim_status_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'claim_patient_id_foriegn' => ['type' => 'foreign', 'columns' => ['patient_id'], 'references' => ['patient', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'claim_status_id_claim_status_foriegn' => ['type' => 'foreign', 'columns' => ['claim_status_id'], 'references' => ['claim_status', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'patient_id' => 1,
            'claim_number' => 'Lorem ipsum dolor sit amet',
            'claim_status_id' => 1,
            'dental_verification_upload' => 'Lorem ipsum dolor sit amet',
            'progress_notes_upload' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'signature' => 'Lorem ipsum dolor sit amet',
            'date_of_service' => '2016-03-03',
            'comments' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-03-03 19:10:50',
            'modified' => '2016-03-03 19:10:50'
        ],
    ];
}
