<?php
namespace gallery\impl\common\bo;

use page\bo\PageController;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use page\annotation\AnnoPage;
use n2n\persistence\orm\annotation\AnnoTable;
use gallery\core\bo\GalleryGroup;
use gallery\core\controller\GalleryGroupController;
use gallery\impl\common\model\CommonGallerySetuper;

class GalleryGroupPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('gallery_impl_gallery_group_page_controller'));
		$ai->m('galleryGroupPage', new AnnoPage());
		$ai->p('rootGalleryGroup', new AnnoManyToOne(GalleryGroup::getClass()));
	}

	private $rootGalleryGroup;

	public function galleryGroupPage(CommonGallerySetuper $setuper, 
			GalleryGroupController $galleryGroupController, array $params = null) {
		$setuper->setup();
		$galleryGroupController->setRootGalleryGroup($this->rootGalleryGroup);
		$this->assignHttpCacheControl(new \DateInterval('PT30M'));
		$this->assignResponseCacheControl(new \DateInterval('P10D'));
		$this->delegate($galleryGroupController);
	}

	/**
	 * @return GalleryGroup
	 */
	public function getRootGalleryGroup() {
		return $this->rootGalleryGroup;
	}

	/**
	 * @param GalleryGroup $rootGalleryGroup
	 */
	public function setRootGalleryGroup(GalleryGroup $rootGalleryGroup = null) {
		$this->rootGalleryGroup = $rootGalleryGroup;
	}
}