DELIMITER $$

-- ON INSERT in doses table
DROP TRIGGER IF EXISTS doses_on_insert$$
CREATE TRIGGER doses_on_insert
	AFTER INSERT ON doses
    FOR EACH ROW
BEGIN
	INSERT INTO user_medical_history VALUES(
    DEFAULT,
	NEW.dose_id, 
    NEW.dose_quantity,
    NEW.med_id,
    NEW.user_id,
    NEW.date,
    NEW.time_to_take_at,
    NEW.frequency,
    NEW.status_id,
    DEFAULT,
    'New Dose Added'
	);
END$$

-- ON UPDATE in doses table
DROP TRIGGER IF EXISTS doses_on_update$$
CREATE TRIGGER doses_on_update
	AFTER UPDATE ON doses
    FOR EACH ROW
BEGIN
	INSERT INTO user_medical_history VALUES(
    DEFAULT,
	NEW.dose_id, 
    NEW.dose_quantity,
    NEW.med_id,
    NEW.user_id,
    NEW.date,
    NEW.time_to_take_at,
    NEW.frequency,
    NEW.status_id,
    DEFAULT,
    case 
		when status_id = 1 then 'Dose marked as taken'
		when status_id = 2 then 'Dose marked as skipped'
        when status_id = 3 then 'Dose updated'
    end
	);
END$$

-- below case will determin if the dose is marked as taken, skipped. If the status_id is 3 then it
-- means that user only updated the dose details but not marked as taken or skipped

-- ON DELETE in doses table
DROP TRIGGER IF EXISTS doses_on_deleted$$
CREATE TRIGGER doses_on_deleted
	BEFORE DELETE ON doses
    FOR EACH ROW
BEGIN
	INSERT INTO deleted_doses VALUES(
    DEFAULT,
	OLD.user_id, 
    OLD.med_id,
    OLD.date,
    OLD.time_to_take_at,
    OLD.status_id,
    DEFAULT,
    'Dose Deleted'
	);
END$$

DELIMITER ;