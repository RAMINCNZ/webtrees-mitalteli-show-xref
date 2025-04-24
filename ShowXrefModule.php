<?php

declare(strict_types=1);

namespace Mitalteli\Webtrees\Module\ShowXref;

use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\View;
use Fisharebest\Webtrees\Gedcom;
use Fisharebest\Webtrees\GedcomRecord;
use Fisharebest\Webtrees\Individual;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleSidebarTrait;
use Fisharebest\Webtrees\Module\ModuleSidebarInterface;
use Fisharebest\Webtrees\Module\ModuleGlobalInterface;
use Fisharebest\Webtrees\Webtrees;
use Fisharebest\Webtrees\Services\ModuleService;
use Fisharebest\Webtrees\Registry;

/**
 * Display media objects as in webtrees 2.0
 */
class ShowXrefModule extends AbstractModule implements ModuleCustomInterface, ModuleSidebarInterface, ModuleGlobalInterface
{
    use ModuleCustomTrait;
    use ModuleSidebarTrait;
    public ModuleService $module_service;

    /**
     *
     * @param ModuleService $module_service
     */
    public function __construct(ModuleService $module_service)
    {
        $this->module_service = $module_service;
    }

     /**
     * @var string
     */
    public const CUSTOM_AUTHOR = 'elysch';

    /**
     * @var string
     */
    public const CUSTOM_VERSION = '3.1.0';
     /**
     * @var string
     */
    public const GITHUB_REPO = 'webtrees-mitalteli-show-xref';

     /**
     * @var string
     */
    public const AUTHOR_WEBSITE = 'https://github.com/elysch/webtrees-mitalteli-show-xref/';

     /**
     * @var string
     */
    public const CUSTOM_SUPPORT_URL = self::AUTHOR_WEBSITE . 'issues';

    /**
     * Method to evaluate if exists method firstUID is defined in GedcomRecord class
     *
     * @return boolean
     */
    static function firstUidMethodExists(): bool
    {
        return (bool) method_exists(GedcomRecord::class, "firstUid");
    }

    /**
     * How should this module be identified in the control panel, etc.?
     *
     * @return string
     */
    public function title(): string
    {

        /* I18N: Name of a module */
        return I18N::translate('XREF values module.');
    }

    /**
     * A sentence describing what this module does.
     *
     * @return string
     */
    public function description(): string
    {
        return I18N::translate('A sidebar to show XREF values.');
    }

    /**
     * {@inheritDoc}
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleAuthorName()
     */
    public function customModuleAuthorName(): string
    {
        return self::CUSTOM_AUTHOR;
    }

    /**
     * {@inheritDoc}
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleVersion()
     */
    public function customModuleVersion(): string
    {
        return self::CUSTOM_VERSION;
    }

    /**
     * A URL that will provide the latest stable version of this module.
     *
     * @return string
     */
    public function customModuleLatestVersionUrl(): string
    {
        return 'https://raw.githubusercontent.com/' . self::CUSTOM_AUTHOR . '/' . self::GITHUB_REPO . '/main/latest-version.txt';
    }

     /**
     * {@inheritDoc}
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleSupportUrl()
     */
    public function customModuleSupportUrl(): string
    {
        return self::AUTHOR_WEBSITE;
    }

    /**
     * Bootstrap the module
     */
    public function boot(): void
    {
        // Register a namespace for our views.
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
    }

     /**
     * Where does this module store its resources
     *
     * @return string
     */
    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    /**
     * Raw content, to be added at the end of the <head> element.
     * Typically, this will be <link> and <meta> elements.
     *
     * @return string
     */
    public function headContent(): string
    {
        return "\n" . '<link rel="stylesheet" href="' . e($this->assetUrl('css/style.css')) . '">' . "\n";
    }

    /**
     * Raw content, to be added at the end of the <body> element.
     * Typically, this will be <script> elements.
     *
     * https://getbootstrap.com/docs/5.2/components/tooltips/#enable-tooltips
     *
     * @return string
     */
    public function bodyContent(): string
    {
        return '';
    }

    /**
     * The text that appears on the sidebar's title.
     *
     * @return string
     */
    public function sidebarTitle(Individual $individual): string
    {
        return view($this->name() . '::sidebar-header', [
            'module'   => $this,
            'with_uid' => ShowXrefModule::firstUidMethodExists(),
        ]);
    }

    /**
     * The default position for this sidebar.  It can be changed in the control panel.
     *
     * @return int
     */
    public function defaultSidebarOrder(): int
    {
        return 10;
    }

    /**
     * Does this sidebar have anything to display for this individual?
     *
     * @param Individual $individual
     *
     * @return bool
     */
    public function hasSidebarContent(Individual $individual): bool
    {
        return true;
    }

    /**
     * Load this sidebar synchronously.
     *
     * @param Individual $individual
     *
     * @return string
     */
    public function getSidebarContent(Individual $individual): string
    {
        $expand_sidebar     = (bool) $this->getPreference('expand-sidebar');

        return view($this->name() . '::sidebar', [
            'expand_sidebar'  => $expand_sidebar,
            'individual'      => $individual,
            'tree'            => $individual->tree(),
            'module_basename' => $this->name(),
            'with_uid' => ShowXrefModule::firstUidMethodExists(),
        ]);
    }

    /**
     * A breaking change in webtrees 2.2.0 changes how the classes are retrieved.
     * This function allows support for both 2.1.X and 2.2.X versions
     * @param $class
     * @return mixed
     */
    static function getClass($class)
    {
        if (version_compare(Webtrees::VERSION, '2.2.0', '>=')) {
            return Registry::container()->get($class);
        } else {
            return app($class);
        }
    }
};
