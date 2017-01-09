<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CptCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CptCodesTable Test Case
 */
class CptCodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CptCodesTable
     */
    public $CptCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cpt_codes',
        'app.claim_icd10_codes',
        'app.claim',
        'app.patient',
        'app.practice',
        'app.practice_status',
        'app.practice_contract',
        'app.rates',
        'app.practice_payment_info',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups',
        'app.notes',
        'app.review',
        'app.patient_info',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.claim_status',
        'app.claim_cpt_codes',
        'app.icd10_codes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CptCodes') ? [] : ['className' => 'App\Model\Table\CptCodesTable'];
        $this->CptCodes = TableRegistry::get('CptCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CptCodes);

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
