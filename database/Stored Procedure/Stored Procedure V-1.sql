USE `medlink`;

DELIMITER $$
-- Check user email
DROP PROCEDURE IF EXISTS check_user_email$$
CREATE PROCEDURE check_user_email(p_email VARCHAR(200))
BEGIN
	SELECT email
    FROM users u
    WHERE p_email = u.email; 
END$$

-- Check user password
DROP PROCEDURE IF EXISTS get_user_password$$
CREATE PROCEDURE get_user_password(p_email VARCHAR(200))
BEGIN
	SELECT `password`
    FROM users u
    WHERE p_email = u.email; 
END$$

-- get user id
DROP PROCEDURE IF EXISTS get_user_id$$
CREATE PROCEDURE get_user_id(p_email VARCHAR(200))
BEGIN
	SELECT user_id
    FROM users u
    WHERE email = p_email; 
END$$

-- get user full name
DROP PROCEDURE IF EXISTS get_full_name$$
CREATE PROCEDURE get_full_name(p_id INT)
BEGIN
	SELECT CONCAT(first_name, ' ',last_name) AS `Full Name`
    FROM users 
    WHERE user_id = p_id;
END$$



-- Register
DROP PROCEDURE IF EXISTS register_new_user$$
CREATE PROCEDURE register_new_user(
	p_first_name VARCHAR(50),
	p_last_name VARCHAR(50),
	p_age INT,
    p_DOB DATE,
    p_email VARCHAR(200),
    p_password VARCHAR(200),  
    p_contact VARCHAR(100),
    p_gender VARCHAR(10))
BEGIN
	INSERT INTO users VALUES(
		DEFAULT,
        p_first_name,
        p_last_name,
        p_age,
        p_DOB,
        p_email,
        p_password,
        p_contact,
        p_gender
    );
END$$

-- Today Medicines List
DROP PROCEDURE IF EXISTS medicine_schedule_today$$
CREATE PROCEDURE medicine_schedule_today(p_user_id INT)
BEGIN
	SELECT *
    FROM user_meds m
    WHERE m.user_id = p_user_id
		AND m.date = date(now());
END$$

-- Add medicine
DROP PROCEDURE IF EXISTS add_med$$
CREATE PROCEDURE add_med(
    p_med_name VARCHAR(250),
    p_med_strength VARCHAR(100),
    p_med_type INT,
    p_user_id INT
)
BEGIN
	-- Insert into medicine data in medicine table
	INSERT INTO medicines VALUES(
	DEFAULT, 
	p_med_name,
    p_med_strength,
    date(now()),
    p_med_type,
    p_user_id
	);
    
    -- get the id of the medicine just inserted
    SET @medicine_id = (SELECT med_id FROM medicines 
    WHERE med_id = last_insert_id());
    
    SELECT @medicine_id AS medicine_id;
    
END$$

DROP PROCEDURE IF EXISTS add_med_doses$$
CREATE PROCEDURE add_med_doses(
	p_dose_quantity INT,
    p_med_id INT,
    p_user_id INT,
    p_date DATE,
    p_time TIME,
    p_freq INT
)

BEGIN
	-- insert into doses
    INSERT INTO doses VALUES(
	DEFAULT, 
	p_dose_quantity,
    p_med_id,
    p_user_id,
    p_date,
    p_time,
    p_freq,
    p_date,
    p_time,
    3
	);
END$$

-- Take Medicine
DROP PROCEDURE IF EXISTS take_medicine$$
CREATE PROCEDURE take_medicine(p_dose_id INT, p_user_id INT)
BEGIN
	UPDATE doses d set status_id = 1
	WHERE d.dose_id = p_dose_id AND d.user_id = p_user_id;
END$$

-- skip Medicine
DROP PROCEDURE IF EXISTS skip_medicine$$
CREATE PROCEDURE skip_medicine(p_dose_id INT, p_user_id INT)
BEGIN
	UPDATE doses d set status_id = 2
	WHERE d.dose_id = p_dose_id AND d.user_id = p_user_id;
END$$

-- delete medicine
DROP PROCEDURE IF EXISTS delete_medicine$$
CREATE PROCEDURE delete_medicine(p_dose_id INT, p_user_id INT)
BEGIN 
	DELETE FROM doses
	WHERE dose_id = p_dose_id AND user_id = p_user_id;
END$$

-- total weekly doses
DROP PROCEDURE IF EXISTS doses_this_week$$
CREATE PROCEDURE doses_this_week(p_user_id INT)
BEGIN
	SELECT
    COUNT(DISTINCT dose_id) AS doses
	FROM user_meds where user_id = p_user_id
    AND
		date > date_sub(now(), INTERVAL 1 WEEK)
	AND 
		date < date_add(now(), INTERVAL 1 WEEK);
END$$

-- doses taken
DROP PROCEDURE IF EXISTS taken_this_week$$
CREATE PROCEDURE taken_this_week(p_user_id INT)
BEGIN
	SELECT
    COUNT(DISTINCT dose_id) AS `doses taken`
	FROM user_meds where user_id = p_user_id
    AND
		date > date_sub(now(), INTERVAL 1 WEEK)
	AND 
		date < date_add(now(), INTERVAL 1 WEEK)
	AND status = 'taken';
END$$

-- doses skipped
DROP PROCEDURE IF EXISTS skipped_this_week$$
CREATE PROCEDURE skipped_this_week(p_user_id INT)
BEGIN
	SELECT
    COUNT(DISTINCT dose_id) AS `doses skipped`
	FROM user_meds where user_id = p_user_id
    AND
		date > date_sub(now(), INTERVAL 1 WEEK)
	AND 
		date < date_add(now(), INTERVAL 1 WEEK)
	AND status = 'skipped';
END$$

-- edit medicine
DROP PROCEDURE IF EXISTS edit_med$$
CREATE PROCEDURE edit_med(p_dose_id INT, p_user_id INT, p_time TIME, p_date DATE, p_quantity INT)
BEGIN	
	UPDATE doses SET 
	time_to_take_at = p_time, 
	remind_at_time = p_time,
    date = p_date,
    remind_at_date = p_date,
    dose_quantity = p_quantity
    WHERE dose_id = p_dose_id
		AND user_id = p_user_id;
END$$

-- get user medical history
DROP PROCEDURE IF EXISTS get_history$$
CREATE PROCEDURE get_history(p_user_id INT)
 BEGIN
 	SELECT * FROM med_history
 		WHERE user_id = p_user_id LIMIT 200;
END$$

-- get user medical history of deleted doses
DROP PROCEDURE IF EXISTS get_history_doses_deleted$$
CREATE PROCEDURE get_history_doses_deleted(p_user_id INT)
 BEGIN
 	SELECT * FROM deleted_doses_history
 		WHERE user_id = p_user_id LIMIT 200;
END$$

DELIMITER ;



















