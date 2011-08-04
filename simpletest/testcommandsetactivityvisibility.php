<?php

/**
 * Workflow block tests
 *
 * @package    block
 * @subpackage workflow
 * @copyright  2011 Lancaster University Network Services Limited
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page
}

// Include our test library so that we can use the same mocking system for
// all tests
require_once(dirname(__FILE__) . '/lib.php');

class test_block_workflow_command_setactivityvisibility extends block_workflow_testlib {
    public function test_setactivityvisibility() {
        $command = new block_workflow_command_setactivityvisibility();
        $this->assertIsA($command, 'block_workflow_command');
    }

    public function test_parse_no_state_hidden() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);

        // This should change the visibility to hidden
        $args = 'hidden';

        // Try parsing without a context
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step);

        // $result should have data
        $this->assertNotNull($result);

        // There should be no errors
        $this->assertEqual(count($result->errors), 0);

        // $result should have a visibility state of 0
        $this->assertEqual($result->visibility, 0);

        // $result should have no id
        $this->assertFalse(isset($result->id));
    }

    public function test_parse_no_state_visible() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);

        // This should change the visibility to visible
        $args = 'visible';

        // Try parsing without a context
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step);

        // $result should have data
        $this->assertNotNull($result);

        // There should be no errors
        $this->assertEqual(count($result->errors), 0);

        // $result should have a visibility state of 0
        $this->assertEqual($result->visibility, 1);

        // $result should have no id
        $this->assertFalse(isset($result->id));
    }

    public function test_parse_no_state_invalid_state() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);

        // This should change the visibility to invalid
        $args = 'invalid';

        // Try parsing without a context
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step);

        // $result should have data
        $this->assertNotNull($result);

        // There should be one error
        $this->assertEqual(count($result->errors), 1);

        // $result should have no visible
        $this->assertFalse(isset($result->visibility));

        // $result should have no id
        $this->assertFalse(isset($result->id));
    }

    public function test_parse_no_state_appliestocourse() {
        $workflow = $this->create_workflow(false);
        $step     = $this->create_step($workflow);

        // This should change the visibility to hidden
        $args = 'hidden';

        // Try parsing without a context
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step);

        // $result should have data
        $this->assertNotNull($result);

        // There should be one error
        $this->assertEqual(count($result->errors), 1);

        // $result should have no id
        $this->assertFalse(isset($result->id));
    }

    public function test_parse_with_state_hidden() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);
        $state    = $this->assign_workflow($workflow);

        // This should change the visibility to hidden
        $args = 'hidden';

        // Try parsing with a state
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step, $state);

        // $result should have data
        $this->assertNotNull($result);

        // There should be no errors
        $this->assertEqual(count($result->errors), 0);

        // $result should have a visibility state of 0
        $this->assertEqual($result->visibility, 0);

        // $result should have a context, step, workflow and cm
        $this->assertNotNull($result->context);
        $this->assertNotNull($result->step);
        $this->assertNotNull($result->workflow);
        $this->assertNotNull($result->cm);
    }

    public function test_parse_with_state_visible() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);
        $state    = $this->assign_workflow($workflow);

        // This should change the visibility to visible
        $args = 'visible';

        // Try parsing with a state
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step, $state);

        // $result should have data
        $this->assertNotNull($result);

        // There should be no errors
        $this->assertEqual(count($result->errors), 0);

        // $result should have a visibility state of 0
        $this->assertEqual($result->visibility, 1);

        // $result should have a context, step, workflow and cm
        $this->assertNotNull($result->context);
        $this->assertNotNull($result->step);
        $this->assertNotNull($result->workflow);
        $this->assertNotNull($result->cm);
    }

    public function test_parse_with_state_invalid_state() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);
        $state    = $this->assign_workflow($workflow);

        // This should change the visibility to invalid
        $args = 'invalid';

        // Try parsing with a state
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step, $state);

        // $result should have data
        $this->assertNotNull($result);

        // There should be one error
        $this->assertEqual(count($result->errors), 1);

        // $result should have no visibility
        $this->assertFalse(isset($result->visibility));

        // $result should have a context, step, workflow and cm
        $this->assertNotNull($result->context);
        $this->assertNotNull($result->step);
        $this->assertNotNull($result->workflow);
        $this->assertNotNull($result->cm);
    }

    public function test_parse_with_state_appliestocourse() {
        $workflow = $this->create_workflow(false);
        $step     = $this->create_step($workflow);
        $state    = $this->assign_workflow($workflow);

        // This should change the visibility to hidden
        $args = 'hidden';

        // Try parsing without a context
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $result = $class->parse($args, $step, $state);

        // $result should have data
        $this->assertNotNull($result);

        // There should be one error
        $this->assertEqual(count($result->errors), 1);
    }

    public function test_execute_hidden() {
        $workflow = $this->create_activity_workflow('quiz', false);
        $step     = $this->create_step($workflow);
        $state    = $this->assign_workflow($workflow);

        // This should change the visibility to hidden
        $args = 'hidden';

        // Check that the parent course is visible
        $check = $this->testdb->get_record('course', array('id' => $this->courseid));
        $this->assertEqual($check->visible, 1);

        $module = $workflow->appliesto;
        $sql = "SELECT cm.id
                FROM {" . $module . "} AS m
                INNER JOIN {course_modules} AS cm ON cm.instance = m.id
                INNER JOIN {context} AS c ON c.instanceid = cm.id
                INNER JOIN {modules} AS md ON md.id = cm.module
                WHERE md.name = ? AND cm.course = ? LIMIT 1";
        $instance = $this->testdb->get_record_sql($sql, array($module, $this->courseid));

        // Check that the activity visibility is currently visible
        $check = $this->testdb->get_record('course_modules', array('id' => $instance->id));
        $this->assertEqual($check->visible, 1);

        // Execute
        $class = block_workflow_command::create('block_workflow_command_setactivityvisibility');
        $class->execute($args, $state);

        // Check that the activity visibility is now hidden
        $check = $this->testdb->get_record('course_modules', array('id' => $instance->id));
        $this->assertEqual($check->visible, 0);

        // This should not have affected the parent courses visibility
        $check = $this->testdb->get_record('course', array('id' => $this->courseid));
        $this->assertEqual($check->visible, 1);
    }
}
