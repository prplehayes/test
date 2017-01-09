<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GroupsController Test Case
 */
class GroupsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.groups',
        'app.users',
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
        'app.practice_payment_info',
        'app.user_type'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
