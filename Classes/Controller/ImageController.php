<?php
namespace T3T\T3tBackstretch\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Elvis Tavasja <tavasja@gmail.com>, www.typo3tutorials.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ImageController
 */
class ImageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
		
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 */
	protected $configurationManager;
	
	
	/**
	 * imageRepository
	 *
	 * @var \T3T\T3tBackstretch\Domain\Repository\ImageRepository
	 * @inject
	 */
	protected $imageRepository = NULL;
	

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$configuration = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);
		
		if(isset($configuration['persistence']['storagePid'])){
			$storagePid = intval($configuration['persistence']['storagePid']);
		}else{	
			$storagePid = 1;
		}
		$currentPid = $GLOBALS["TSFE"]->id;
		$imageCount = $this->imageRepository->findByPid($currentPid)->count();
		
		if($imageCount > 0){
			$images = $this->imageRepository->findByPid($currentPid);
		}else{
			$images = $this->imageRepository->findByPid($storagePid);
		}

	    
		//$images = $this->imageRepository->findByIdentifier($identifier);
		$this->view->assign('images', $images);
	}

}