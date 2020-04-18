-- ----------------------------
-- Add column google2fa_secret
-- ----------------------------
ALTER TABLE `tvqhub`.`users`
ADD COLUMN `google2fa_secret` varchar(255) NULL AFTER `remember_token`;
