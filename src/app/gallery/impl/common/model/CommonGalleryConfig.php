<?php
namespace gallery\impl\common\model;

use n2n\context\RequestScoped;

class CommonGalleryConfig implements RequestScoped {
	public function getGalleryViewId() {
		return '\gallery\impl\bs\view\gallery.html';
	}
	
	public function getGalleryGroupViewId() {
		return '\gallery\impl\bs\view\galleryGroup.html';
	}
	
	public function getBreadCrumbsViewId() {
		return '\gallery\impl\bs\view\inc\breadCrumbs.html';
	}
}