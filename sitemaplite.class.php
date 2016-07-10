<?php

/**
 * @file sitemaplite.class.php
 * @author Kijin Sung <kijin@kijinsung.com>
 * @license GPLv2 or Later <https://www.gnu.org/licenses/gpl-2.0.html>
 * @brief Sitemap Lite Main Class
 */
class SitemapLite extends ModuleObject
{
	/**
	 * Get the configuration of the current module.
	 */
	public function getConfig()
	{
		$config = getModel('module')->getModuleConfig('sitemaplite');
		if (!$config)
		{
			$config = new stdClass;
		}
		
		return $config;
	}
	
	/**
	 * Get the sitemap.xml server-side path.
	 */
	public function getSitemapXmlPath($type = null)
	{
		if (!$type)
		{
			$type = isset($this->getConfig()->sitemap_file_path) ? $this->getConfig()->sitemap_file_path : 'root';
		}
		
		if ($type === 'root')
		{
			return str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '\\/')) . '/sitemap.xml';
		}
		else
		{
			return str_replace('\\', '/', rtrim(_XE_PATH_, '\\/')) . '/sitemap.xml';
		}
	}
	
	/**
	 * Get the sitemap.xml file URL.
	 */
	public function getSitemapXmlUrl($type = null)
	{
		if (!$type)
		{
			$type = isset($this->getConfig()->sitemap_file_path) ? $this->getConfig()->sitemap_file_path : 'root';
		}
		
		if ($type === 'root')
		{
			$dui = parse_url(Context::getDefaultUrl());
			return $dui['scheme'] . '://' . $dui['host'] . ($dui['port'] ? (':' . $dui['port']) : '') . '/sitemap.xml';
		}
		else
		{
			return rtrim(Context::getDefaultUrl(), '\\/') . '/sitemap.xml';
		}
	}
	
	/**
	 * Check if a file is writable.
	 */
	public function isWritable($filename)
	{
		if (@file_exists($filename) && @is_writable($filename))
		{
			return true;
		}
		elseif (!@file_exists($filename) && @is_writable(dirname($filename)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Check triggers.
	 */
	public function checkTriggers()
	{
		$oModuleModel = getModel('module');
		if ($oModuleModel->getTrigger('moduleObject.proc', 'sitemaplite', 'model', 'triggerUpdateSitemapXML', 'after'))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Register triggers.
	 */
	public function registerTriggers()
	{
		if (!$this->checkTriggers())
		{
			$oModuleController = getController('module');
			$oModuleController->insertTrigger('moduleObject.proc', 'sitemaplite', 'model', 'triggerUpdateSitemapXML', 'after');
			return true;
		}
		return false;
	}
	
	public function moduleInstall()
	{
		$this->registerTriggers();
		return new Object();
	}
	
	public function checkUpdate()
	{
		return !$this->checkTriggers();
	}
	
	public function moduleUpdate()
	{
		$this->registerTriggers();
		return new Object(0, 'success_updated');
	}
	
	public function recompileCache()
	{
		// no-op
	}
}
