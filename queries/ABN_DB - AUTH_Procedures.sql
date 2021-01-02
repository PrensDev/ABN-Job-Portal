
-- Display all procedure //testing purposes

SELECT 
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE' AND ROUTINE_NAME LIKE 'AUTH%';

--------------------------------------------------------

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
;

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
;

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
;

-- Find User Account Procedure for Login
CREATE PROCEDURE [AUTH_FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT 
		  [email]
		, [password]
		, [userType]
		, CAST([accountFlag] AS INT) AS [status]
	FROM [UserAccounts]
	WHERE [email] = @email
;

-- Find Job Seeker Procedure
CREATE PROCEDURE [AUTH_FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT *, DATEDIFF(year, [birthDate], getdate()) as [age]
	FROM [JobSeekers]
	WHERE [email] = @email
;

-- Find Employer Procedure
CREATE PROCEDURE [AUTH_FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [Employers]
	WHERE [email] = @email
;

-- Set Account Procedure
CREATE PROCEDURE [AUTH_SetAccountFlag]
	@email VARCHAR(450),
	@flag  INT
AS
	UPDATE [UserAccounts]
	SET [accountFlag] = @flag
	WHERE [email] = @email
;
