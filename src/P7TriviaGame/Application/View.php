<?php
declare(strict_types=1);
/**
 * Simple view class
 *
 * - rendering (HTML) content
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Application;


use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Core\Factory;
use P7TriviaGame\Core\Utility;


class View
{

    /**
     *
     */
    const DOCUMENT_TEMPLATE = 'document.php';

    /**
     *
     */
    const DOCUMENT_WO_FORM_TEMPLATE = 'document_wo_form.php';

    /**
     * Document's body content
     *
     * @var string
     */
    protected string $content = '';

    /**
     * Currently used theme's name
     *
     * @var string
     */
    protected string $theme = '';

    /**
     * Optional suffix for title element of current document
     *
     * @var string
     */
    protected string $titleSuffix = ' version ' . Configuration::APPLICATION_VERSION;

    /**
     * Title element of current document
     *
     * @var string
     */
    protected string $title = '';

    /**
     * Instance of current configuration
     *
     * @var \P7TriviaGame\Application\Configuration|null
     */
    protected ?Configuration $configuration = null;

    /**
     * Calculated rendering time for current request
     *
     * @var float
     */
    protected float $renderTime = 0.0;

    /**
     * Array for dynamically assigned properties
     *
     * @var array
     */
    protected array $properties = [];


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


    /**
     * View constructor function
     *
     */
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

    /**
     * Rendering complete document
     *
     * @param $content
     * @return false|string
     */
    public function renderDocument($content, $document = self::DOCUMENT_TEMPLATE)
    {
        $this->content = $content;
        $this->renderTime = Utility::stopMeasuring();
        return $this->render($document);
    }

    /**
     * Rendering template
     *
     * @param string $templateName
     * @return false|string
     */
    public function render(string $templateName)
    {
        ob_start();
        require $this->configuration->getTemplatePath() . $templateName;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     * @return View
     */
    public function setTheme(string $theme): View
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return \P7TriviaGame\Application\Configuration|null
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param \P7TriviaGame\Application\Configuration|null $configuration
     * @return View
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @return float
     */
    public function getRenderTime(): float
    {
        return $this->renderTime;
    }

    /**
     * @param float $renderTime
     * @return View
     */
    public function setRenderTime(float $renderTime): View
    {
        $this->renderTime = $renderTime;
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function setProperty(string $key, $value)
    {
        $this->properties[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getProperty(string $key)
    {
        return $this->properties[$key] ?? null;
    }


}