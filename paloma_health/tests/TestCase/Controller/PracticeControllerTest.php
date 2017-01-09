<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PracticeController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PracticeController Test Case
 */
class PracticeControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.practice',
        'app.practice_status',
        'app.patient',
        'app.practice_contract',
        'app.practice_payment_info',
        'app.users',
        'app.user_type',
        'app.notes',
        'app.review'
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
