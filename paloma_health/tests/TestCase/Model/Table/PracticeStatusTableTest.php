<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PracticeStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PracticeStatusTable Test Case
 */
class PracticeStatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PracticeStatusTable
     */
    public $PracticeStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.practice_status',
        'app.practice',
        'app.patient',
        'app.claim',
        'app.claim_status',
        'app.notes',
        'app.review',
        'app.cpt_codes',
        'app.claim_icd10_codes',
        'app.icd10_codes',
        'app.claim_cpt_codes',
        'app.patient_info',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.practice_contract',
        'app.rates',
        'app.practice_payment_info',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PracticeStatus') ? [] : ['className' => 'App\Model\Table\PracticeStatusTable'];
        $this->PracticeStatus = TableRegistry::get('PracticeStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PracticeStatus);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
