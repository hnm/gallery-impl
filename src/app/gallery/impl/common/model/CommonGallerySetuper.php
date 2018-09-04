<?php
namespace gallery\impl\common\model;

use n2n\context\RequestScoped;
use gallery\core\config\GalleryConfig;

class CommonGallerySetuper implements RequestScoped {
	private $commonGalleryConfig;
	private $galleryConfig;
	
	private function _init(CommonGalleryConfig $commonGalleryConfig, GalleryConfig $galleryConfig) {
		$this->commonGalleryConfig = $commonGalleryConfig;
		$this->galleryConfig = $galleryConfig;
		$this->galleryConfig->getDtc()->assignModule('gallery\impl');
	}
	
	public function setup() {
		if (null !== ($breadCrumbsViewId = $this->commonGalleryConfig->getBreadCrumbsViewId())) {
			$this->galleryConfig->setBreadCrumbsViewId($breadCrumbsViewId);
		}
		
		if (null !== ($galleryViewId = $this->commonGalleryConfig->getGalleryViewId())) {
			$this->galleryConfig->setGalleryViewId($galleryViewId);
		}
		
		if (null !== ($galleryGroupViewId = $this->commonGalleryConfig->getGalleryGroupViewId())) {
			$this->galleryConfig->setGalleryGroupViewId($galleryGroupViewId);
		}
	}
}