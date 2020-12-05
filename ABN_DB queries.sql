-- CREATE ABN_DB DATABASE
CREATE DATABASE [ABN_DB]

-- USE ABN_DB
USE [ABN_DB]
GO

--------------------------------------------------------

-- UserAccounts Table
CREATE TABLE [UserAccounts] (
	[userID] 
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_userID@UserAccounts PRIMARY KEY
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT UQ_email@UserAccounts UNIQUE
	,
	[password]
		VARCHAR(MAX) NOT NULL
	,
	[userType]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_userType@UserAccounts
			CHECK (userType IN ('Job Seeker', 'Employer'))
	,
	[accountFlag]
		BINARY NOT NULL DEFAULT 1
)


-- JobSeekers Table
CREATE TABLE [JobSeekers] (
	[jobseekerID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_jobseekerID@JobSeekers PRIMARY KEY
	,
	[firstName]
		VARCHAR(MAX) NOT NULL
	,
	[middleName]
		VARCHAR(MAX)
	,
	[lastName]
		VARCHAR(MAX) NOT NULL
	,
	[birthDate]
		DATE NOT NULL
	,
	[gender]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_gender@JobSeekers
			CHECK ([gender] IN (
				'Male', 
				'Female',
				'LGBTQA++',
				'Prefer not to say'
			))
	,
	[street]
		VARCHAR(MAX) NOT NULL
	,
	[brgyDistrict]
		VARCHAR(MAX) NOT NULL
	,
	[cityMunicipality]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(MAX) NOT NULL
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@JobSeekers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
	,
	[description]
		VARCHAR(MAX) NOT NULL
	,
	[skills]
		VARCHAR(MAX) NOT NULL
	,
	[experiences]
		VARCHAR(MAX) NOT NULL
	,
	[education]
		VARCHAR(MAX) NOT NULL
)


-- Employers Table
CREATE TABLE [Employers] (
	[employerID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_employerID@Employers PRIMARY KEY
	,
	[companyName]
		VARCHAR(MAX) NOT NULL
	,
	[street]
		VARCHAR(MAX) NOT NULL
	,
	[brgyDistrict]
		VARCHAR(MAX) NOT NULL
	,
	[cityMunicipality]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(MAX) NOT NULL
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@Employers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
	,
	[website]
		VARCHAR(MAX)
	,
	[description]
		VARCHAR(MAX) NOT NULL
)


-- JobPosts Table
CREATE TABLE [JobPosts] (
	[jobPostID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_jobPostID@JobPosts PRIMARY KEY
	,
	[employerID]
		INT NOT NULL
		CONSTRAINT FK_employerID@JobPosts FOREIGN KEY
			REFERENCES [Employers] ([employerID])
	,
	[jobTitle]
		VARCHAR(MAX) NOT NULL
	,
	[jobType]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_jobType@JobPosts
			CHECK ([jobType] IN (
				'Full Time',
				'Part Time',
				'Internship/OJT',
				'Temporary'
			))
	,
	[industryType]
		VARCHAR(MAX) NOT NULL
	,
	[description]
		VARCHAR(MAX) NOT NULL
	,
	[responsibilities]
		VARCHAR(MAX) NOT NULL
	,
	[skills]
		VARCHAR(MAX) NOT NULL
	,
	[experiences]
		VARCHAR(MAX) NOT NULL
	,
	[education]
		VARCHAR(MAX) NOT NULL
	,
	[minSalary]
		MONEY NOT NULL
		CONSTRAINT CK_minSalary@JobPosts
			CHECK ([minSalary] > 0)
	,
	[maxSalary]
		MONEY NOT NULL
		CONSTRAINT CK_maxSalary@JobPosts
			CHECK ([maxSalary] > 0)
	,
	[dateCreated]
		DATETIME NOT NULL
	,
	[dateModified]
		DATETIME
	,
	[jobPostFlag]
		BINARY NOT NULL
)


-- Applications Table
CREATE TABLE [Applications] (
	[applicationID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_applicationID@Applications PRIMARY KEY
	,
	[jobPostID] 
		INT NOT NULL
		CONSTRAINT FK_jobPostID@Applications FOREIGN KEY
			REFERENCES [JobPosts] ([jobPostID])
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Applications FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
	,
	[status]
		VARCHAR(MAX) NOT NULL DEFAULT 'Pending'
		CONSTRAINT CK_status@Applications
			CHECK ([status] IN (
				'Pending',
				'Hired',
				'Call Back',
				'Rejected'
			))
	,
)


-- Bookmarks Table
CREATE TABLE [Bookmarks] (
	[bookmarkID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_bookmarkID@Bookmarks PRIMARY KEY
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Bookmarks FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
	,
	[jobPostID]
		INT NOT NULL
		CONSTRAINT FK_jobPostID@Bookmarks FOREIGN KEY
			REFERENCES [JobPosts] ([jobPostID])
)


-- Notifications Table
CREATE TABLE [Notifications] (
	[notificationID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_notificationID@Notifications PRIMARY KEY
	,
	[title]
		VARCHAR(MAX) NOT NULL
	,
	[message]
		VARCHAR(MAX) NOT NULL
	,
	[senderID]
		INT NOT NULL
		CONSTRAINT FK_senderID@Notifications FOREIGN KEY
			REFERENCES [UserAccounts] ([userID])
	,
	[receiverID]
		INT NOT NULL
		CONSTRAINT FK_receiverID@Notifications FOREIGN KEY
			REFERENCES [UserAccounts] ([userID])
	,
	[readFlag]
		BINARY NOT NULL DEFAULT 0
)

--------------------------------------------------------

-- Display all procedure //testing purposes

SELECT 
  ROUTINE_SCHEMA,
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE';

-- Drop a procedure // testing purposes

DROP PROCEDURE [dbo].[FindUser]

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
		([companyName]
		,[street]
		,[brgyDistrict]
		,[cityMunicipality]
		,[contactNumber]
		,[email]
		,[website]
		,[description])
	VALUES
		(@companyName
		,@street
		,@brgyDistrict
		,@cityMunicipality
		,@contactNumber
		,@email
		,@website
		,@description)

-- Find User Procedure for Login
CREATE PROCEDURE [dbo].[FindUser]
	@email		VARCHAR(MAX)
AS
	SELECT [email], [password], [userType], [accountFlag]
	FROM [dbo].[UserAccounts]
	WHERE [email] = @email

SELECT * FROM UserAccounts
