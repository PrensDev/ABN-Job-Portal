
-- Display all procedure //testing purposes

SELECT 
  ROUTINE_SCHEMA,
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE';

-- Drop a procedure // testing purposes

DROP PROCEDURE [dbo].[GetJobPosts]

--------------------------------------------------------

-- STORED PROCEDURES

-- Add Job Seeker Account Procedure
CREATE PROCEDURE [dbo].[AddJobseekerAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX)
AS
	INSERT INTO [dbo].[UserAccounts] 
		([email]
		,[password]
		,[userType])
	VALUES 
		(@email
		,@password
		,'Job Seeker')


-- Register Job Seeker Procedure
CREATE PROCEDURE [dbo].[RegisterJobseeker]
	@firstName			VARCHAR(MAX),
	@middleName			VARCHAR(MAX),
	@lastName			VARCHAR(MAX),
	@birthDate			VARCHAR(MAX),
	@gender				VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@email				VARCHAR(450),
	@description		VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX)
AS
	INSERT INTO [dbo].[JobSeekers] 
		([firstName]
		,[middleName]
		,[lastName]
		,[birthDate]
		,[gender]
		,[street]
		,[brgyDistrict]
		,[cityMunicipality]
		,[contactNumber]
		,[email]
		,[description]
		,[skills]
		,[experiences]
		,[education])
	VALUES 
		(@firstName
		,@middleName
		,@lastName
		,@birthDate
		,@gender
		,@street
		,@brgyDistrict
		,@cityMunicipality
		,@contactNumber
		,@email
		,@description
		,@skills
		,@experiences
		,@education);


-- Add Employer Account Procedure
CREATE PROCEDURE [dbo].[AddEmployerAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX)
AS
	INSERT INTO [dbo].[UserAccounts] 
		([email]
		,[password]
		,[userType])
	VALUES 
		(@email
		,@password
		,'Employer')


-- Register Employer Procedure
CREATE PROCEDURE [dbo].[RegisterEmployer]
	@companyName		VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@email				VARCHAR(450),
	@website			VARCHAR(MAX),
	@description		VARCHAR(MAX)
AS
	INSERT INTO [dbo].[Employers]
		( [companyName]
		, [street]
		, [brgyDistrict]
		, [cityMunicipality]
		, [contactNumber]
		, [email]
		, [website]
		, [description] )
	VALUES
		(@companyName
		,@street
		,@brgyDistrict
		,@cityMunicipality
		,@contactNumber
		,@email
		,@website
		,@description)


-- Find User Account Procedure for Login
CREATE PROCEDURE [dbo].[FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT [email], [password], [userType], CAST([accountFlag] AS INT) AS [status]
	FROM [dbo].[UserAccounts]
	WHERE [email] = @email


-- Find Job Seeker Procedure
CREATE PROCEDURE [dbo].[FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT
		  [jobseekerID]
		, [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, DATEDIFF(year, [birthDate], getdate()) as [age]
		, [gender]
		, [street]
		, [brgyDistrict]
		, [cityMunicipality]
		, [contactNumber]
		, [email]
		, [description]
		, [skills]
		, [experiences]
		, [education]
	FROM [dbo].[JobSeekers]
	WHERE [email] = @email


-- Find Employer Procedure
CREATE PROCEDURE [dbo].[FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [dbo].[Employers]
	WHERE [email] = @email


-- Post New Job Procedure
CREATE PROCEDURE [dbo].[PostNewJob]
	@employerID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@industryType		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	INSERT INTO [dbo].[JobPosts]
		( [employerID]
		, [jobTitle]
		, [jobType]
		, [industryType]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [jobPostFlag])
	VALUES
		( @employerID
		, @jobTitle			
		, @jobType			
		, @industryType		
		, @description	
		, @responsibilities
		, @skills		
		, @experiences	
		, @education	
		, @minSalary		
		, @maxSalary		
		, @jobPostFlag )

-- Get Posted Jobs Procedure
CREATE PROCEDURE [dbo].[GetJobPosts] 
	@employerID INT
AS
	SELECT
		  [jobPostID]
		, [employerID]
		, [jobTitle]
		, [jobType]
		, [industryType]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [dateCreated]
		, CAST([jobPostFlag] AS INT) AS [status]
	FROM [dbo].[JobPosts]
	WHERE [employerID] = @employerID
	ORDER BY [dateCreated] DESC


-- View Job Post
CREATE PROCEDURE [dbo].[ViewJobPost]
	@jobPostID	INT,
	@employerID INT
AS
	SELECT
		  [jobPostID]
		, [employerID]
		, [jobTitle]
		, [jobType]
		, [industryType]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [dateCreated]
		, [dateModified]
		, CAST([jobPostFlag] AS INT) AS [status]
	FROM [dbo].[JobPosts]
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID


-- Deactivate Account Procedure
CREATE PROCEDURE [dbo].[DeactivateAccount]
	@email VARCHAR(450)
AS
	UPDATE [dbo].[UserAccounts]
	SET [accountFlag] = 0
	WHERE [email] = @email

-- Activate Account Procedure
CREATE PROCEDURE [dbo].[ActivateAccount]
	@email VARCHAR(450)
AS
	UPDATE [dbo].[UserAccounts]
	SET [accountFlag] = 1
	WHERE [email] = @email


-- UpdateJobPost Procedure
CREATE PROCEDURE [dbo].[UpdateJobPost]
	@jobPostID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@industryType		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	UPDATE [dbo].[JobPosts]
	SET
		  [jobTitle] 			= @jobTitle
		, [jobType] 			= @jobType
		, [industryType] 		= @industryType
		, [description] 		= @description
		, [responsibilities] 	= @responsibilities
		, [skills] 				= @skills
		, [experiences] 		= @experiences
		, [education] 			= @education
		, [minSalary] 			= @minSalary
		, [maxSalary] 			= @maxSalary
		, [dateModified] 		= getdate()
		, [jobPostFlag] 		= @jobPostFlag
	WHERE [jobPostID]			= @jobPostID


-- Delete Job Post Procedure
CREATE PROCEDURE [dbo].[DeleteJobPost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [dbo].[JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID


-- Update Employer Information Procedure
CREATE PROCEDURE [dbo].[UpdateEmployerInfo]
	@employerID			INT,
	@companyName		VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@website			VARCHAR(MAX),
	@description		VARCHAR(MAX)
AS
	UPDATE [dbo].[Employers]
	SET
		  [companyName] 	 = @companyName
		, [street] 			 = @street
		, [brgyDistrict] 	 = @brgyDistrict
		, [cityMunicipality] = @cityMunicipality
		, [contactNumber] 	 = @contactNumber
		, [website] 		 = @website
		, [description] 	 = @description
	WHERE [employerID] = @employerID


-- Update Job Seeker Information Procedure
CREATE PROCEDURE [dbo].[UpdateJobseekerInfo]
	@jobseekerID		INT,
	@firstName			VARCHAR(MAX),
	@middleName			VARCHAR(MAX),
	@lastName			VARCHAR(MAX),
	@birthDate			VARCHAR(MAX),
	@gender				VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX)
AS
	UPDATE [dbo].[JobSeekers]
	SET
		 [firstName] 		= @firstName
		,[middleName] 		= @middleName
		,[lastName] 		= @lastName
		,[birthDate] 		= @birthDate
		,[gender] 			= @gender
		,[street] 			= @street
		,[brgyDistrict] 	= @brgyDistrict
		,[cityMunicipality] = @cityMunicipality
		,[contactNumber] 	= @contactNumber
		,[description] 		= @description
		,[skills] 			= @skills
		,[experiences] 		= @experiences
		,[education] 		= @education
	WHERE [jobseekerID] = @jobseekerID


-- View Recent Posts Procedure
CREATE PROCEDURE [dbo].[ViewRecentPosts]
AS
	SELECT TOP 10 
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [dbo].[JobPosts]
	INNER JOIN [dbo].[Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	WHERE [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC

SELECT DAY(GETDATE())
