<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatesTable Test Case
 */
class RatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RatesTable
     */
    public $Rates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rates',
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
        $config = TableRegistry::exists('Rates') ? [] : ['className' => 'App\Model\Table\RatesTable'];
        $this->Rates = TableRegistry::get('Rates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rates);

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
