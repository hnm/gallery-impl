CREATE TABLE IF NOT EXISTS `gallery_impl_ci_gallery` (
  `id` int(11) NOT NULL,
  `gallery_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_core_ci_gallery_index_1` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `gallery_impl_gallery_group_page_controller` (
  `id` int(11) NOT NULL,
  `root_gallery_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_impl_gallery_group_page_controller_index_1` (`root_gallery_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `gallery_impl_gallery_page_controller` (
  `id` int(11) NOT NULL,
  `gallery_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_impl_gallery_page_controller_index_1` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
