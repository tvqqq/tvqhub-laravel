-- ----------------------------
-- Add index column name for fulltext search
-- ----------------------------
ALTER TABLE fb_friends ADD FULLTEXT `idx_name` (`name`);
