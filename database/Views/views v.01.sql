-- Views

-- Medicine and doses that a user will take
-- Med ID
-- doseID
-- user_id, full name, med name,
-- dose (quantity + dose string => 1 dose)
-- strength, time (12 hours format)
-- Status
-- order by date asc and time desc

-- Join 
DROP VIEW IF EXISTS user_meds;
CREATE VIEW user_meds AS
SELECT u.user_id, 
	d.dose_id,
    m.med_id,
	concat(first_name, ' ' ,last_name) AS 'Name',
    m.med_name AS 'Medicine',
    concat(d.dose_quantity, ' ', t.type) AS 'amount',
    m.strength,
    time_format(d.time_to_take_at, '%h:%i %p') AS 'time_to_take_at',
    d.date,
    s.status
    FROM users u
	INNER JOIN doses d
		USING(user_id)
	INNER JOIN medicines m 
		 USING(med_id)
	INNER JOIN status s
		USING(status_id)
	INNER JOIN med_type t
		USING(type_id);

DROP VIEW IF EXISTS med_details;
CREATE VIEW med_details AS
SELECT 
	u.user_id, 
	d.dose_id,
    m.med_name AS 'Medicine',
    m.strength,
    d.dose_quantity,
    time_format(d.time_to_take_at, '%h:%i %p') AS 'time_to_take_at',
    d.date
    FROM users u
	INNER JOIN doses d
		USING(user_id)
	INNER JOIN medicines m 
		 USING(med_id);


-- joining user_medicial_history with doses and medicines to view history
-- requirements in user history
	-- medicine name
    -- dose quantity
    -- time
    -- date
    -- status of medicines (taken, skipped, missed)
    -- action done
    
DROP VIEW IF EXISTS med_history;
CREATE VIEW med_history AS
SELECT
	h.h_id,
	m.user_id,
	m.dose_id,
	m.strength,
	m.medicine,
	h.dose_quantity,
	time_format(h.time_to_take_at, '%h:%i %p') AS 'time_to_take_at',
	date_format(h.date, '%d-%M-%Y') AS date,
	s.status,
    date_format(action_datetime, '%d-%M-%Y %h:%i %p') as `change occurred at`,
    h.action
from user_medical_history h
join med_details m using(dose_id)
join status s using(status_id)
ORDER BY h_id DESC;
    
-- View of deleted doses
DROP VIEW IF EXISTS deleted_doses_history;
CREATE VIEW deleted_doses_history AS
SELECT
	d.id,
    u.user_id,
    m.med_name,
    m.strength,
	date_format(d.date, '%d-%M-%Y') AS 'dose_date',
    time_format(d.time_to_take_at, '%h:%i %p') AS 'dose_time',
    d.action,
    date_format(d.action_datetime, '%d-%M-%Y %h:%i %p') AS `change occurred at`,
    s.status
 FROM deleted_doses d
	join medicines m using(med_id)
    join users u ON m.added_by_user = u.user_id
	join status s using(status_id)
    ORDER BY id DESC;























