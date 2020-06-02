-- ----------------------------
-- [4] 2020-05-31 - Table bucket_lists
CREATE TABLE `tvqhub`.`bucket_lists`  (
    `id` int(0) AUTO_INCREMENT NOT NULL,
    `content` text NULL,
    `description` text NULL,
    `complete_date` timestamp(0) NULL,
    `created_at` timestamp(0) NULL,
    `updated_at` timestamp(0) NULL,
    PRIMARY KEY (`id`)
);

-- ----------------------------
-- [3] 2020-04-18 - Add column google2fa_secret
ALTER TABLE `tvqhub`.`users`
ADD COLUMN `google2fa_secret` varchar(255) NULL AFTER `remember_token`;

-- ----------------------------
-- [2] 2020-04-12 - Add column tumblr_post_id
ALTER TABLE `tvqhub`.`deep_posts`
ADD COLUMN `tumblr_post_id` bigint(0) NULL AFTER `media`;

-- ----------------------------
-- [1] 2020-04-11 - Add index column name for fulltext search
ALTER TABLE fb_friends ADD FULLTEXT `idx_name` (`name`);
