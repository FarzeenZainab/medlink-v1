
-- change phone number range in users table from 100 to 20 (users table)
ALTER TABLE users CHANGE COLUMN contact_number contact_number VARCHAR(20) NOT NULL;

-- column name from dose to dose_quantity for better readablity (doses table)
ALTER TABLE doses CHANGE COLUMN dose dose_quantity INT NOT NULL;

-- Add column in user history defining action
 ALTER TABLE user_medical_history ADD COLUMN action VARCHAR(100) NOT NULL;
 
 -- Alter table medicine and add a column of user_id that indicates which user adds which medicines
 ALTER TABLE medicines
	ADD COLUMN added_by_user INT,
    ADD FOREIGN KEY(added_by_user) REFERENCES users(user_id)
		ON UPDATE CASCADE
        ON DELETE NO ACTION;