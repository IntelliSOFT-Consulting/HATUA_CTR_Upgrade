-- Backfill Screening stages stuck as Current after a screening query was raised.
-- Same logic as Console/cake screening_backfill: close Screening on the date of
-- the first non-applicant query and open ScreeningSubmission from that date.
-- Run step 1 first and review the rows before running steps 2 and 3.

-- 1. Preview
SELECT a.protocol_no, s.application_id, s.id AS screening_stage_id, s.start_date,
       DATE(MIN(c.created)) AS first_query_date,
       EXISTS (SELECT 1 FROM application_stages x
               WHERE x.application_id = s.application_id AND x.stage = 'ScreeningSubmission') AS has_response_stage
FROM application_stages s
JOIN applications a ON a.id = s.application_id
JOIN comments c ON c.foreign_key = s.id AND c.model = 'ApplicationStage' AND c.category = 'external'
               AND c.deleted IS NULL AND (c.user_id IS NULL OR c.user_id <> a.user_id)
WHERE s.stage = 'Screening' AND s.status = 'Current' AND s.end_date IS NULL
GROUP BY a.protocol_no, s.application_id, s.id, s.start_date;

START TRANSACTION;

DROP TEMPORARY TABLE IF EXISTS tmp_stuck_screening;
CREATE TEMPORARY TABLE tmp_stuck_screening AS
SELECT s.id, s.application_id, DATE(MIN(c.created)) AS query_date
FROM application_stages s
JOIN applications a ON a.id = s.application_id
JOIN comments c ON c.foreign_key = s.id AND c.model = 'ApplicationStage' AND c.category = 'external'
               AND c.deleted IS NULL AND (c.user_id IS NULL OR c.user_id <> a.user_id)
WHERE s.stage = 'Screening' AND s.status = 'Current' AND s.end_date IS NULL
GROUP BY s.id, s.application_id;

-- 2. Close Screening on the first query date
UPDATE application_stages s
JOIN tmp_stuck_screening t ON t.id = s.id
SET s.status = 'Complete', s.comment = 'Backfill: first screening query',
    s.end_date = t.query_date, s.modified = NOW();

-- 3. Open Response to Queries where it is missing
INSERT INTO application_stages (application_id, stage, status, comment, start_date, created, modified)
SELECT t.application_id, 'ScreeningSubmission', 'Current', 'Backfill: first screening query', t.query_date, NOW(), NOW()
FROM tmp_stuck_screening t
WHERE NOT EXISTS (SELECT 1 FROM application_stages x
                  WHERE x.application_id = t.application_id AND x.stage = 'ScreeningSubmission');

DROP TEMPORARY TABLE tmp_stuck_screening;

COMMIT;
