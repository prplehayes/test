<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Icd10CodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Icd10CodesTable Test Case
 */
class Icd10CodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Icd10CodesTable
     */
    public $Icd10Codes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.icd10_codes',
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
        'app.cpt_codes',
        'app.claim_icd10_codes',
        'app.claim_cpt_codes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Icd10Codes') ? [] : ['className' => 'App\Model\Table\Icd10CodesTable'];
        $this->Icd10Codes = TableRegistry::get('Icd10Codes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Icd10Codes);

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
