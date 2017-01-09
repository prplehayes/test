<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PracticeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PracticeTable Test Case
 */
class PracticeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PracticeTable
     */
    public $Practice;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Practice') ? [] : ['className' => 'App\Model\Table\PracticeTable'];
        $this->Practice = TableRegistry::get('Practice', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Practice);

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
