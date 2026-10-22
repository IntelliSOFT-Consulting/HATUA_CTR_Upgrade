-- Adds `trial_status_date` to `applications` - when the trial status
-- (`trial_status_id`) last changed. Shown as the "Date Stopped" /
-- "Date Suspended" on the public Stopped / Suspended lists and on the
-- public report view. (Approved / Rejected use the existing
-- `approval_date`, which manager_approve() already stamps.)
--
-- Stamped automatically by Application::beforeSave() (see
-- _stampTrialStatusDate()) whenever trial_status_id actually changes -
-- whether through ApplicationsController::admin_suspend() or an
-- applicant updating their trial status - never hand-entered.
--
-- Safe to re-run - idempotent-guarded via information_schema checks, same
-- pattern as the other *.sql migrations in this folder.

SET @col_exists := (
  SELECT COUNT(*) FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'applications' AND COLUMN_NAME = 'trial_status_date'
);
SET @sql := IF(@col_exists = 0,
  'ALTER TABLE `applications` ADD COLUMN `trial_status_date` datetime DEFAULT NULL AFTER `trial_status_id`',
  'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Back-fill currently Suspended / Stopped applications from the most recent
-- matching audit trail entry written by admin_suspend()
-- ("... has been Suspended by ..." / "... has been Stopped by ...").
-- Applications an applicant marked Stopped/Suspended themselves have no
-- such entry and stay NULL (shown as "Not recorded") rather than getting
-- a guessed date such as `modified`, which moves on every edit.

UPDATE `applications` a
  JOIN `trial_statuses` ts ON ts.id = a.trial_status_id AND TRIM(ts.name) = 'Suspended'
  JOIN (
    SELECT foreign_key, MAX(created) AS action_date
    FROM `audit_trails`
    WHERE model = 'Application' AND message LIKE '%has been Suspended by%'
    GROUP BY foreign_key
  ) t ON t.foreign_key = a.id
SET a.trial_status_date = t.action_date
WHERE a.trial_status_date IS NULL;

UPDATE `applications` a
  JOIN `trial_statuses` ts ON ts.id = a.trial_status_id AND TRIM(ts.name) = 'Stopped'
  JOIN (
    SELECT foreign_key, MAX(created) AS action_date
    FROM `audit_trails`
    WHERE model = 'Application' AND message LIKE '%has been Stopped by%'
    GROUP BY foreign_key
  ) t ON t.foreign_key = a.id
SET a.trial_status_date = t.action_date
WHERE a.trial_status_date IS NULL;
