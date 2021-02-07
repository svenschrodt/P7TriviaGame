<?php
declare(strict_types=1);
/**
 * Simple view class managing
 * - rendering (HTML) content
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Application;


use P7TriviaGame\Core\Factory;
use P7TriviaGame\Application\Configuration;

class View
{

    const DOCUMENT_TEMPLATE = 'document.php';

    protected string $content = '';

    /**
     * @return string
     */
    public function getTitleSuffix(): string
    {
        return $this->titleSuffix;
    }

    /**
     * @param string $titleSuffix
     */
    public function setTitleSuffix(string $titleSuffix): void
    {
        $this->titleSuffix = $titleSuffix;
    }


    protected string $theme = '';

    protected string $titleSuffix = ' version ' . Configuration::APPLICATION_VERSION;

    protected string $title = '';
    protected ?Configuration $configuration = null;

    public function __construct()
    {
        $this->configuration = Factory::get('Configuration');
        $this->title = Configuration::APPLICATION_NAME . $this->getTitleSuffix();
        $this->theme = $this->configuration->getCurrentTheme();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function parseDocument($content)
    {
        $this->content = $content;
        return $this->render(self::DOCUMENT_TEMPLATE);
    }
    public function render(string $templateName)
    {
        ob_start();
        require $this->configuration->getTemplatePath() . $templateName;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}