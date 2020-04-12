-- ----------------------------
-- Add column tumblr_post_id
-- ----------------------------
ALTER TABLE `tvqhub`.`deep_posts`
ADD COLUMN `tumblr_post_id` bigint(0) NULL AFTER `media`;
