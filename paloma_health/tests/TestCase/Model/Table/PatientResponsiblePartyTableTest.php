<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatientResponsiblePartyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatientResponsiblePartyTable Test Case
 */
class PatientResponsiblePartyTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatientResponsiblePartyTable
     */
    public $PatientResponsibleParty;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.patient_responsible_party',
        'app.patient',
        'app.practice',
        'app.practice_status',
        'app.practice_contract',
        'app.practice_payment_info',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups',
        'app.notes',
        'app.review',
        'app.claim',
        'app.claim_status',
        'app.cpt_codes',
        'app.claim_cpt_codes',
        'app.icd10_codes',
        'app.claim_icd10_codes',
        'app.patient_info',
        'app.img_photos',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PatientResponsibleParty') ? [] : ['className' => 'App\Model\Table\PatientResponsiblePartyTable'];
        $this->PatientResponsibleParty = TableRegistry::get('PatientResponsibleParty', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PatientResponsibleParty);

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
