<?php
namespace gallery\impl\common\bo;

use n2n\reflection\annotation\AnnoInit;
use page\bo\PageController;
use page\annotation\AnnoPage;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\persistence\orm\annotation\AnnoTable;
use gallery\core\bo\Gallery;
use gallery\core\controller\GalleryController;
use gallery\impl\common\model\CommonGallerySetuper;

class GalleryPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('gallery_impl_gallery_page_controller'));
		$ai->m('galleryPage', new AnnoPage());
		$ai->p('gallery', new AnnoManyToOne(Gallery::getClass()));
	}

	private $gallery;

	public function galleryPage(CommonGallerySetuper $setuper, GalleryController $galleryController, array $params = null) {
		$setuper->setup();
		$galleryController->setGallery($this->gallery);
		$this->assignHttpCacheControl(new \DateInterval('PT30M'));
		$this->assignResponseCacheControl(new \DateInterval('P10D'));
		$this->delegate($galleryController);
	}

	/**
	 * @return Gallery
	 */
	public function getGallery() {
		return $this->gallery;
	}

	/**
	 * @param Gallery $gallery
	 */
	public function setGallery(Gallery $gallery) {
		$this->gallery = $gallery;
	}
}