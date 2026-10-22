-- Adds `deadline_alert_checked_on` to `reviews` - a per-review "already
-- evaluated today" watermark for ReviewDeadlineAlertShell
-- (the `review_deadline_alert` cron job, see docker/crontab).
--
-- This is NOT a "resume from last run" cursor - the shell's escalation
-- (Day 1/14/21/28/overdue reminders, CAPA auto-creation) is driven by pure
-- date arithmetic against each review's acceptance date, not by "what
-- changed since last run": an overdue review must be re-evaluated every
-- single day forever until it's submitted, so no review can ever be
-- permanently excluded from the scan. What CAN safely be skipped is
-- re-evaluating a review more than once on the *same* calendar day (e.g.
-- the shell being re-run manually while testing, or a cron double-fire).
--
-- ReviewDeadlineAlertShell::_markChecked() stamps this column with
-- today's date at the end of _processReview(), whatever the outcome
-- (reminder sent, already sent, inactive reviewer, submitted, nothing
-- due). main()'s query then excludes any review already stamped for
-- today, so a same-day rerun only touches reviews it hasn't looked at
-- yet - while a new day naturally resets everyone (this column no longer
-- matches CURDATE()) for correct re-evaluation.
--
-- Safe to re-run - idempotent-guarded via information_schema checks, same
-- pattern as the capas_*.sql migrations in this folder.

SET @col_exists := (
  SELECT COUNT(*) FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reviews' AND COLUMN_NAME = 'deadline_alert_checked_on'
);
SET @sql := IF(@col_exists = 0,
  'ALTER TABLE `reviews` ADD COLUMN `deadline_alert_checked_on` date DEFAULT NULL AFTER `modified`',
  'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- No backfill needed: NULL means "never checked", which is exactly what
-- every pre-existing row should be so it gets picked up on the very next
-- run.
