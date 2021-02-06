<?php
/**
 * Unit testing \P7TriviaGame\Core\System
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

class SystemTest extends \P7TriviaGame\Core\TestCase
{

    public function testCheckSystemRequirementsAreOk()
    {
        $checked = \P7TriviaGame\Core\System::checkSystemRequirements();
        $this->assertTrue(count($checked)==1);
        $this->assertTrue( $checked[0] === \P7TriviaGame\Core\System::MESSAGE_SYSTEM_REQUIREMENT_OK);

        $this->assertTrue(\P7TriviaGame\Core\System::isSystemReady());
    }


}