<?php

namespace Dgame\Conditional\Info;

use Dgame\Conditional\Browser;
use Dgame\Conditional\Builder\BrowserBuilder;
use Dgame\Conditional\OS;

/**
 * Class BrowserInfo
 * @package Dgame\Conditional\Info
 */
final class BrowserInfo
{
    /**
     * @var null|BrowserInfo
     */
    private static $instance = null;

    /**
     * @var null|string
     */
    private $agent = null;
    /**
     * @var Browser|null
     */
    private $browser = null;

    /**
     * Browser constructor.
     */
    private function __construct()
    {
        $builder = new BrowserBuilder();

        if (!EnvironmentInfo::Instance()->isOnConsole()) {
            $this->agent = $_SERVER['HTTP_USER_AGENT'];

            $this->determinePlatform($builder);
            $this->determineBrowserName($builder);
        }

        $this->browser = $builder->build();
    }

    /**
     * @return BrowserInfo
     */
    public static function Instance() : BrowserInfo
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param BrowserBuilder $builder
     */
    private function determinePlatform(BrowserBuilder $builder)
    {
        if (preg_match('#linux#i', $this->agent)) {
            $builder->setPlatform(OS::LINUX);
        } elseif (preg_match('#macintosh|mac os x#i', $this->agent)) {
            $builder->setPlatform(OS::OSX);
        } elseif (preg_match('#windows|win32#i', $this->agent)) {
            $builder->setPlatform(OS::WINDOWS);
        }
    }

    /**
     * @param BrowserBuilder $builder
     */
    private function determineBrowserName(BrowserBuilder $builder)
    {
        if (preg_match('/MSIE/i', $this->agent) && !preg_match('/Opera/i', $this->agent)) {
            $builder->setBrowserName('Internet Explorer');
            $builder->setBrowserAlias('MSIE');
        } elseif (preg_match('/Firefox/i', $this->agent)) {
            $builder->setBrowserName('Mozilla Firefox');
            $builder->setBrowserAlias('Firefox');
        } elseif (preg_match('/Chrome/i', $this->agent)) {
            $builder->setBrowserName('Google Chrome');
            $builder->setBrowserAlias('Chrome');
        } elseif (preg_match('/Safari/i', $this->agent)) {
            $builder->setBrowserName('Apple Safari');
            $builder->setBrowserAlias('Safari');
        } elseif (preg_match('/Opera/i', $this->agent)) {
            $builder->setBrowserName('Opera');
            $builder->setBrowserAlias('Opera');
        } elseif (preg_match('/Netscape/i', $this->agent)) {
            $builder->setBrowserName('Netscape');
            $builder->setBrowserAlias('Netscape');
        }

        $this->determineBrowserVersion($builder);
    }

    /**
     * @param BrowserBuilder $builder
     */
    private function determineBrowserVersion(BrowserBuilder $builder)
    {
        $str     = ['version', $builder->getBrowserAlias(), 'other'];
        $pattern = '#(?<browser>' . implode('|', $str) . ')[/ ]+(?<version>[0-9.|a-z.]*)#i';
        if (preg_match_all($pattern, $this->agent, $matches)) {
            if (count($matches['browser']) > 1) {
                if (strripos($this->agent, 'version') < strripos($this->agent, $builder->getBrowserAlias())) {
                    $builder->setBrowserVersion($matches['version'][0]);
                } else {
                    $builder->setBrowserVersion($matches['version'][1]);
                }
            } else {
                $builder->setBrowserVersion($matches['version'][0]);
            }
        }
    }

    /**
     * @return null|string
     */
    public function getUserAgent() : string
    {
        return $this->agent;
    }

    /**
     * @return Browser|null
     */
    public function getCurrentBrowser() : Browser
    {
        return $this->browser;
    }
}