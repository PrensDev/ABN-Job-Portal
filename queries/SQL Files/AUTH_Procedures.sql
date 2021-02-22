
-- Display all procedure //testing purposes

/*
SELECT 
  ROUTINE_NAME AS PROCEDURES
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE'
-- AND ROUTINE_NAME LIKE 'AUTH%'   
ORDER BY ROUTINE_NAME
*/

--------------------------------------------------------

USE [ABN_Job_Portal]
GO

-- Add Job Seeker Account Procedure
CREATE PROCEDURE [AUTH_AddUserAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX),
	@userType			VARCHAR(MAX)
AS
	INSERT INTO [UserAccounts] 
		( [email]
		, [password]
		, [userType] )
	VALUES 
		( @email
		, @password
		, @userType )
GO

-- Register Job Seeker Procedure
CREATE PROCEDURE [AUTH_RegisterJobseeker]
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450)
AS
	INSERT INTO [JobSeekers] 
		( [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, [gender]
		, [cityProvince]
		, [contactNumber]
		, [email] )
	VALUES 
		( @firstName
		, @middleName
		, @lastName
		, @birthDate
		, @gender
		, @cityProvince
		, @contactNumber
		, @email )
GO

-- Register Employer Procedure
CREATE PROCEDURE [AUTH_RegisterEmployer]
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	INSERT INTO [Employers]
		( [companyName]
		, [street]
		, [brgyDistrict]
		, [cityProvince]
		, [contactNumber]
		, [email]
		, [website]
		, [description] )
	VALUES
		( @companyName
		, @street
		, @brgyDistrict
		, @cityProvince
		, @contactNumber
		, @email
		, @website
		, @description )
GO

-- Find User Account Procedure for Login
CREATE PROCEDURE [AUTH_FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT
		  [userID]
		, [email]
		, [password]
		, [userType]
	FROM [UserAccounts]
	WHERE [email] = @email
GO

-- Find Job Seeker Procedure
CREATE PROCEDURE [AUTH_FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT *, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
	FROM [JobSeekers]
	WHERE [email] = @email
GO

-- Find Employer Procedure
CREATE PROCEDURE [AUTH_FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [Employers]
	WHERE [email] = @email
GO

-- Update Password
CREATE PROCEDURE [AUTH_UpdatePassword]
	@email		VARCHAR(450),
	@password	VARCHAR(MAX)
AS
	UPDATE [UserAccounts]
	SET [password] = @password
	WHERE [email] = @email
GO

-- Create JBSK Notifications
CREATE PROCEDURE [AUTH_CreateJBSKNotification]
	@jobseekerID		INT,
	@title				VARCHAR(MAX),
	@message			VARCHAR(MAX),
	@notificationType	VARCHAR(MAX),
	@link				VARCHAR(MAX)
AS
	INSERT INTO [JBSK_Notifications] 
		( [jobseekerID]
		, [title]
		, [message]
		, [notificationType]
		, [link] )
	VALUES
		( @jobseekerID
		, @title
		, @message
		, @notificationType
		, @link )
GO

-- Get User Password
CREATE PROCEDURE [AUTH_GetUserPassword]
	@email VARCHAR(450)
AS
	SELECT [password] FROM [UserAccounts]
	WHERE [email] = @email
GO

-- Change User Email
CREATE PROCEDURE [AUTH_UpdateEmail]
	@email		VARCHAR(450),
	@newEmail	VARCHAR(450)
AS
	UPDATE [UserAccounts]
	SET [email] = @newEmail
	WHERE [email] = @email
GO

-- Notify JobSeeker To Its Application
CREATE PROCEDURE [AUTH_NotifyJBSKStatus]
	@applicationID INT
AS
	INSERT INTO [JBSK_StatusNotifications] ([applicationID])
	VALUES (@applicationID)
GO

-- Remove JobSeeker Status Notification
CREATE PROCEDURE [AUTH_RemoveJBSKStatusNotification]
	@applicationID INT
AS
	DELETE FROM [JBSK_StatusNotifications]
	WHERE [applicationID] = @applicationID
GO
