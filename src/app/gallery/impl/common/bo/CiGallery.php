<?php
namespace gallery\impl\common\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\impl\web\ui\view\html\HtmlView;
use gallery\core\config\GalleryConfig;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use gallery\core\bo\Gallery;
use gallery\impl\common\model\CommonGallerySetuper;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoEntityListeners;

class CiGallery extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('gallery_impl_ci_gallery'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('gallery', new AnnoManyToOne(Gallery::getClass()));
	}
	
	private $gallery;
	
	public function getGallery() {
		return $this->gallery;
	}

	public function setGallery($gallery) {
		$this->gallery = $gallery;
	}

	public function createUiComponent(HtmlView $view) {
		$gallerySetuper = $view->lookup(CommonGallerySetuper::class);
		$view->assert($gallerySetuper instanceof CommonGallerySetuper);
		$gallerySetuper->setup();
		
		$galleryConfig = $view->lookup(GalleryConfig::class);
		$view->assert($galleryConfig instanceof GalleryConfig);
		
		return $view->getImport($galleryConfig->getGalleryViewId(),
				array('gallery' => $this->gallery, 'useTemplate' => false));
	}
}