<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PracticeContractTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PracticeContractTable Test Case
 */
class PracticeContractTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PracticeContractTable
     */
    public $PracticeContract;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.practice_contract',
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
        'app.practice_payment_info',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups',
        'app.rates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PracticeContract') ? [] : ['className' => 'App\Model\Table\PracticeContractTable'];
        $this->PracticeContract = TableRegistry::get('PracticeContract', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PracticeContract);

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
