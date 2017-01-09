<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaimTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaimTable Test Case
 */
class ClaimTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaimTable
     */
    public $Claim;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.claim',
        'app.patient',
        'app.practice',
        'app.practice_status',
        'app.practice_contract',
        'app.practice_payment_info',
        'app.users',
        'app.user_type',
        'app.notes',
        'app.review',
        'app.patient_info',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.claim_status',
        'app.cpt_codes',
        'app.claim_cpt_codes',
        'app.icd10_codes',
        'app.claim_icd10_codes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Claim') ? [] : ['className' => 'App\Model\Table\ClaimTable'];
        $this->Claim = TableRegistry::get('Claim', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Claim);

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
