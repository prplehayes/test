<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PracticePaymentInfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PracticePaymentInfoTable Test Case
 */
class PracticePaymentInfoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PracticePaymentInfoTable
     */
    public $PracticePaymentInfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.practice_payment_info',
        'app.practice',
        'app.practice_status',
        'app.patient',
        'app.claim',
        'app.claim_status',
        'app.notes',
        'app.review',
        'app.cpt_codes',
        'app.claim_cpt_codes',
        'app.icd10_codes',
        'app.claim_icd10_codes',
        'app.patient_info',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.practice_contract',
        'app.rates',
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
        $config = TableRegistry::exists('PracticePaymentInfo') ? [] : ['className' => 'App\Model\Table\PracticePaymentInfoTable'];
        $this->PracticePaymentInfo = TableRegistry::get('PracticePaymentInfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PracticePaymentInfo);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
