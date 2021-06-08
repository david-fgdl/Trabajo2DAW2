-- 3.7.10 

ALTER TABLE `#__spmedia` MODIFY `created_on` datetime NULL DEFAULT NULL;
ALTER TABLE `#__spmedia` MODIFY `modified_on` datetime NULL DEFAULT NULL;
ALTER TABLE `#__sppagebuilder` MODIFY `created_on` datetime NULL DEFAULT NULL;
ALTER TABLE `#__sppagebuilder` MODIFY `modified` datetime NULL DEFAULT NULL;
ALTER TABLE `#__sppagebuilder` MODIFY `checked_out_time` datetime NULL DEFAULT NULL;
ALTER TABLE `#__sppagebuilder_sections` MODIFY `created` datetime NULL DEFAULT NULL;
ALTER TABLE `#__sppagebuilder_addons` MODIFY `created` datetime NULL DEFAULT NULL;


UPDATE `#__spmedia` SET `created_on` = NULL WHERE `created_on` = '0000-00-00 00:00:00';
UPDATE `#__spmedia` SET `modified_on` = NULL WHERE `modified_on` = '0000-00-00 00:00:00';

UPDATE `#__sppagebuilder` SET `created_on` = NULL WHERE `created_on` = '0000-00-00 00:00:00';
UPDATE `#__sppagebuilder` SET `modified` = NULL WHERE `modified` = '0000-00-00 00:00:00';
UPDATE `#__sppagebuilder` SET `checked_out_time` = NULL WHERE `checked_out_time` = '0000-00-00 00:00:00';

UPDATE `#__sppagebuilder_sections` SET `created` = NULL WHERE `created` = '0000-00-00 00:00:00';
UPDATE `#__sppagebuilder_addons` SET `created` = NULL WHERE `created` = '0000-00-00 00:00:00';