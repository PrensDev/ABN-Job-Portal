/* ============================================================================== */
/*                               INSTRUCTIONS                                     */
/* ============================================================================== */
/* Just execute this script. Nothing to create the [ABN_Job_Portal] database.	  */
/* ============================================================================== */

USE [master]
GO

-- CREATE DATABASE [ABN_Job_Portal]
CREATE DATABASE [ABN_Job_Portal]
GO

-- USE [ABN_Job_Portal]
USE [ABN_Job_Portal]
GO

/* ============================================================================== */
/*                                    TABLES                                      */
/* ============================================================================== */

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
			CHECK (userType IN ('Jobseeker', 'Employer'))
)
GO

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
			CHECK (
				[gender] IN (
					'Male', 
					'Female',
					'LGBTQA+',
					'Prefer not to say'
				)
			)
	,
	[cityProvince]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(450) NOT NULL
		CONSTRAINT UQ_contactNumber@JobSeekers UNIQUE
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@JobSeekers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
		ON UPDATE CASCADE
	,
	[profilePic]
		VARCHAR(MAX)
)
GO

-- Resumes Table
CREATE TABLE [Resumes] (
	[resumeID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_resumeID@Resumes PRIMARY KEY
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Resumes FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
		CONSTRAINT UK_jobseekerID@Resumes UNIQUE
	,
	[headline]
		VARCHAR(MAX)
	,
	[description]
		VARCHAR(MAX)
	,
	[skills]
		VARCHAR(MAX)
	,
	[experiences]
		VARCHAR(MAX)
	,
	[education]
		VARCHAR(MAX)
	,
	[resumeFile]
		VARCHAR(MAX)
	,
	[lastUpdated]
		DATETIME NOT NULL DEFAULT GETDATE()
	,
	[resumeFlag]
		BINARY NOT NULL DEFAULT 1
)
GO

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
	[cityProvince]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(450) NOT NULL
		CONSTRAINT UQ_contactNumber@Employers UNIQUE
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@Employers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
		ON UPDATE CASCADE
	,
	[website]
		VARCHAR(MAX)
	,
	[description]
		VARCHAR(MAX) NOT NULL
	,
	[profilePic]
		VARCHAR(MAX)
)
GO

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
			CHECK (
				[jobType] IN (
					'Full Time',
					'Part Time',
					'Intern/OJT',
					'Temporary'
				)
			)
	,
	[field]
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
		DATETIME NOT NULL DEFAULT GETDATE()
	,
	[dateModified]
		DATETIME
	,
	[jobPostFlag]
		BINARY NOT NULL
)
GO

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
		ON DELETE CASCADE
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Applications FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
	,
	[headline]
		VARCHAR(MAX)
	,
	[description]
		VARCHAR(MAX)
	,
	[education]
		VARCHAR(MAX)
	,
	[skills]
		VARCHAR(MAX)
	,
	[experiences]
		VARCHAR(MAX)
	,
	[resumeFile]
		VARCHAR(MAX)
	,
	[lastUpdated]
		VARCHAR(MAX)
	,
	[status]
		VARCHAR(MAX) NOT NULL DEFAULT 'Pending'
		CONSTRAINT CK_status@Applications
			CHECK (
				[status] IN (
					'Pending',
					'Hired',
					'Interviewing',
					'Rejected'
				)
			)
	,
	[dateApplied]
		DATETIME NOT NULL DEFAULT GETDATE()
	,
	[dateStatus]
		DATETIME
)
GO

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
		ON DELETE CASCADE
	,
	[jobPostID]
		INT NOT NULL
		CONSTRAINT FK_jobPostID@Bookmarks FOREIGN KEY
			REFERENCES [JobPosts] ([jobPostID])
	,
	[dateBookmarked]
		DATETIME NOT NULL DEFAULT GETDATE()
)
GO

-- JBSK_StatusNotifications Table
CREATE TABLE [JBSK_StatusNotifications] (
	[notificationID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_notificationID@JBSK_StatusNotifications PRIMARY KEY
	,
	[applicationID]
		INT NOT NULL
		CONSTRAINT FK_aaplicationID@JBSK_StatusNotifications FOREIGN KEY
			REFERENCES [Applications] ([applicationID])
	,
	[readFlag]
		BINARY NOT NULL DEFAULT 0
)
GO

/* ============================================================================== */
/*                                    VIEWS                                       */
/* ============================================================================== */

-- Posts View
CREATE VIEW [Posts] 
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict]
		, [Employers].[cityProvince]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		 AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[jobPostFlag] = 1
GO

-- Job Details
CREATE VIEW [JobDetails]
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
GO 

/* ============================================================================== */
/*                            STORED PROCEDURES                                   */
/* ============================================================================== */

/**
  * MAIN STORED PROCEDURES
  * 
  * The MAIN Stored Procedures are for all users, even no session
  */

-- Get Number of Active Posts
CREATE PROCEDURE [MAIN_RecentPostsNum]
AS 
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
GO

-- View Active Posts
CREATE PROCEDURE [MAIN_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT * FROM [Posts]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO

-- View Job Details Procedure
CREATE PROCEDURE [MAIN_JobDetails]
	@jobPostID	INT
AS
	SELECT * FROM [JobDetails]
	WHERE jobPostID = @jobPostID
GO

-- View Employer Details Procedure
CREATE PROCEDURE [MAIN_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityProvince] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
GO

-- Get Number of Available Jobs
CREATE PROCEDURE [MAIN_AvailableJobsNum]
	@employerID  INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE [employerID] = @employerID
GO

-- View Available Jobs
CREATE PROCEDURE [MAIN_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE [employerID] = @employerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO


-- Get Number of Search Result
CREATE PROCEDURE [MAIN_SearchResultNum]
	@jobTitle VARCHAR(MAX),
	@location VARCHAR(MAX)
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
GO

--  Get Search Result
CREATE PROCEDURE [MAIN_GetSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO


/**
  * AUTH STORED PROCEDURES
  * 
  * The AUTH Stored Procedures are for authorized users, namely JobSeekers and 
  * Employers that has session
  */

-- Add User Account Procedure
CREATE PROCEDURE [AUTH_AddUserAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX),
	@userType			VARCHAR(MAX)
AS
	-- Check if UserAccount is not exists by email to prevent duplication
	IF NOT EXISTS (
		SELECT * FROM [UserAccounts]
		WHERE [email] = @email
	)
	BEGIN
		INSERT INTO [UserAccounts] 
			( [email]
			, [password]
			, [userType] )
		VALUES 
			( @email
			, @password
			, @userType )
	END
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
	-- Check if Jobseeker is not exist by email to prevent duplication
	IF NOT EXISTS (
		SELECT * FROM [JobSeekers]
		WHERE [email] = @email
	)
	BEGIN
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
	END
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
	-- Check if Employer is not exists by email to prevent duplication
	IF NOT EXISTS (
		SELECT * FROM [Employers]
		WHERE [email] = @email
	)
	BEGIN
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
	END
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


/**
  * JBSK STORED PROCEDURES
  * 
  * The JBSK Stored Procedures are exclusive only for jobseekers
  */

-- View Resume Procedure
CREATE PROCEDURE [JBSK_ViewResume]
	@jobseekerID INT
AS
	SELECT
		  [Resumes].[resumeID]
		, [Resumes].[jobseekerID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[experiences]
		, [Resumes].[skills]
		, [Resumes].[lastUpdated]
		, CAST([Resumes].[resumeFlag] AS INT) AS [resumeFlag]
		, [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
	FROM [Resumes]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
GO

-- Create Resume Procedure
CREATE PROCEDURE [JBSK_CreateResume]
	@jobseekerID	INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	IF NOT EXISTS (
		SELECT * FROM [Resumes] WHERE [jobseekerID] = @jobseekerID
	)
	BEGIN
		INSERT INTO [Resumes]
			( [jobseekerID]
			, [headline]
			, [description]
			, [education]
			, [skills]
			, [experiences]
			, [resumeFlag] )
		VALUES
			( @jobseekerID
			, @headline
			, @description
			, @education
			, @skills
			, @experiences
			, @resumeFlag )
	END
GO

-- Remove Resume Procedure
CREATE PROCEDURE [JBSK_RemoveResume]
	@resumeID INT
AS
	DELETE FROM [Resumes] WHERE [resumeID] = @resumeID
GO

-- Update Resume Procedure
CREATE PROCEDURE [JBSK_UpdateResume]
	@resumeID INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	UPDATE [Resumes]
	SET 
		  [headline]	= @headline
		, [description]	= @description
		, [education]	= @education
		, [skills]		= @skills
		, [experiences] = @experiences
		, [resumeFlag]	= @resumeFlag
	WHERE [resumeID] = @resumeID
GO

-- View All Recent Posts
CREATE PROCEDURE [JBSK_RecentPostsNum]
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
GO

-- View Recent Posts
CREATE PROCEDURE [JBSK_ViewRecentPosts]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- Update Job Seeker Information Procedure
CREATE PROCEDURE [JBSK_UpdateInfo]
	@jobseekerID	INT,
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET
		  [firstName] 		= @firstName
		, [middleName] 		= @middleName
		, [lastName] 		= @lastName
		, [birthDate] 		= @birthDate
		, [gender] 			= @gender
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
	WHERE [jobseekerID]		= @jobseekerID
GO

-- Submit Application Procedure
CREATE PROCEDURE [JBSK_SubmitApplication]
	@jobPostID INT,
	@resumeID  INT
AS
	-- Check if application is already exists to prevent duplication
	-- happens when user try to click button multiple times while waiting+
	IF NOT EXISTS (
		SELECT * FROM [Applications]
		WHERE jobPostID = @jobPostID
			AND jobseekerID = (
				SELECT [JobSeekers].[jobseekerID] FROM [JobSeekers]
				INNER JOIN [Resumes]
					ON [JobSeekers].[jobseekerID] = [Resumes].[jobseekerID]
					AND [Resumes].[resumeID] = @resumeID
			)
	)
	BEGIN
		INSERT INTO [Applications]
			( [jobPostID]
			, [jobseekerID]
			, [headline]
			, [description]
			, [education]
			, [skills] 
			, [experiences] 
			, [resumeFile]
			, [lastUpdated] )
		SELECT
			  [JobPosts].[jobPostID]
			, [Resumes].[jobseekerID]
			, [Resumes].[headline]
			, [Resumes].[description]
			, [Resumes].[education]
			, [Resumes].[skills]
			, [Resumes].[experiences]
			, [Resumes].[resumeFile]
			, [Resumes].[lastUpdated]
		FROM [Resumes]
		LEFT OUTER JOIN [JobPosts]
			ON [JobPosts].[jobPostID] = @jobPostID
		WHERE
			[Resumes].[resumeID] = @resumeID
	END
GO

-- Cancel Application Procedure
CREATE PROCEDURE [JBSK_CancelApplication]
	@applicationID INT
AS
	DELETE FROM [Applications]
	WHERE [applicationID] = @applicationID
GO

-- Number of Applied Jobs Based on Status Procedure
CREATE PROCEDURE [JBSK_AppliedJobsToStatusNum]
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
GO

-- Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AppliedJobsToStatus]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- Number of Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AppliedJobsNum]
	@jobseekerID INT
AS
	SELECT COUNT([Applications].[JobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobseekerID] = @jobseekerID
GO

SELECT * FROM Bookmarks

-- Add Bookmark Procedure
CREATE PROCEDURE [JBSK_AddBookmark]
	@jobseekerID INT,
	@jobPostID	 INT
AS
	-- Check if bookmark is not exists based on jobseekerID and jobpostID to prevent duplication
	IF NOT EXISTS (
		SELECT * FROM [Bookmarks]
		WHERE [jobseekerID] = @jobseekerID
			AND [jobPostID] = @jobPostID
	)
	BEGIN
		INSERT INTO [Bookmarks]
			( [jobseekerID]
			, [jobPostID] )
		VALUES 
			( @jobseekerID
			, @jobPostID )
	END
GO

-- Remove Bookmark Procedure
CREATE PROCEDURE [JBSK_RemoveBookmark]
	@bookmarkID INT
AS
	DELETE FROM [Bookmarks] WHERE [bookmarkID] = @bookmarkID
GO

-- Get Number of Bookmarks
CREATE PROCEDURE [JBSK_BookmarksNum]
	@jobseekerID INT
AS
	SELECT COUNT([Bookmarks].[bookmarkID]) AS [count]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID
GO

-- Get Bookmarks
CREATE PROCEDURE [JBSK_GetBookmarks]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [Bookmarks].[bookmarkID]
		, [Bookmarks].[dateBookmarked]
		, [Bookmarks].[jobseekerID]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Applications].[status]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Bookmarks].[dateBookmarked] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROW ONLY
GO

-- View Job Details 
CREATE PROCEDURE [JBSK_ApplicationStatus]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	SELECT
		  [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[dateApplied]
		, [Applications].[status] AS [applicationStatus]
		, [Applications].[dateStatus]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[jobPostID] = @jobPostID 
GO

-- Set Profile Pic
CREATE PROCEDURE [JBSK_SetProfilePic]
	@jobseekerID INT,
	@profilePic	 VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET [profilePic] = @profilePic
	WHERE [jobseekerID] = @jobseekerID
GO

-- View Available Jobs
CREATE PROCEDURE [JBSK_ViewAvailableJobs]
	@jobseekerID INT,
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO

-- Number of Search Result
CREATE PROCEDURE [JBSK_SearchResultNum]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)
GO

-- View Search Result
CREATE PROCEDURE [JBSK_ViewSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)
	ORDER BY [JobPosts].[dateCreated]
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- Get Status Notifcations
CREATE PROCEDURE [JBSK_GetStatusNotifications]
	@jobseekerID	INT,
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT
		  [N].[notificationID]
		, [N].[applicationID]
		, CAST([N].[readFlag] AS INT) AS [readFlag]
		, [A].[status]
		, [A].[dateStatus]
		, [P].[jobPostID]
		, [P].[jobTitle]
		, [E].[companyName]
		, [E].[profilePic]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]
	ORDER BY [A].[dateStatus] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- Get Status Notifications Count
CREATE PROCEDURE [JBSK_StatusNotificationsNum]
	@jobseekerID INT
AS
	SELECT COUNT([notificationID]) AS [count]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]
GO

-- Get Unread Status Notifications Count
CREATE PROCEDURE [JBSK_UnreadStatusNotificationsNum]
	@jobseekerID INT
AS
	SELECT COUNT([notificationID]) AS [count]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]
	WHERE [N].[readFlag] = 0
GO

-- Set Notification Read Flag
CREATE PROCEDURE [JBSK_SetNotificationReadFlag]
	@notificationID INT,
	@readFlag		INT
AS
	UPDATE [JBSK_StatusNotifications]
	SET [readFlag] = @readFlag
	WHERE [notificationID] = @notificationID
GO


/**
  * EMPL STORED PROCEDURES
  * 
  * The EMPL Stored Procedures are exclusive only for employers
  */

-- Post New Job Procedure
CREATE PROCEDURE [EMPL_PostNewJob]
	@employerID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	INSERT INTO [JobPosts]
		( [employerID]
		, [jobTitle]
		, [jobType]
		, [field]
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
		, @field		
		, @description	
		, @responsibilities
		, @skills		
		, @experiences	
		, @education	
		, @minSalary		
		, @maxSalary		
		, @jobPostFlag )
GO

-- Number of Posts
CREATE PROCEDURE [EMPL_PostsNum] 
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [JobPosts]
	WHERE [employerID] = @employerID
GO

-- Get Limited Posts Procedure
CREATE PROCEDURE [EMPL_GetPosts] 
	@offsetRows  INT,
	@fetchedRows INT,
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	FULL OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- View Job Post
CREATE PROCEDURE [EMPL_ViewPost]
	@jobPostID	INT,
	@employerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, [JobPosts].[jobPostFlag]
GO

-- Update Job Post Procedure
CREATE PROCEDURE [EMPL_UpdatePost]
	@jobPostID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	UPDATE [JobPosts]
	SET
		  [jobTitle] 			= @jobTitle
		, [jobType] 			= @jobType
		, [field] 				= @field
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
GO

-- Delete Job Post Procedure
CREATE PROCEDURE [EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
GO

-- Update Employer Information Procedure
CREATE PROCEDURE [EMPL_UpdateInfo]
	@employerID		INT,
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET
		  [companyName] 	= @companyName
		, [street] 			= @street
		, [brgyDistrict] 	= @brgyDistrict
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
		, [website] 		= @website
		, [description] 	= @description
	WHERE [employerID] = @employerID
GO

-- View All Applicants Procedure
CREATE PROCEDURE [EMPL_ApplicantsNum]
	@jobPostID INT,
	@status	   VARCHAR(MAX)
AS
	SELECT COUNT([Applications].[applicationID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
GO

-- View Applicants Procedure
CREATE PROCEDURE [EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO

-- View Applicant Profile Procedure
CREATE PROCEDURE [EMPL_ViewApplicantProfile]
	@jobseekerID INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[birthDate]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[resumeFile]
		, [JobPosts].[jobTitle]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	WHERE [Applications].[jobPostID] = @jobPostID
GO

-- Set Applicant Status Procedure
CREATE PROCEDURE [EMPL_SetApplicantStatus]
	@applicationID INT,
	@status		   VARCHAR(MAX)
AS
	IF @status = 'Pending'
		BEGIN
			UPDATE [Applications]
			SET 
				[status]	 = @status,
				[dateStatus] = NULL
			WHERE [applicationID] = @applicationID
		END
	ELSE
		BEGIN
			UPDATE [Applications]
			SET 
				[status]	 = @status,
				[dateStatus] = GETDATE()
			WHERE [applicationID] = @applicationID
		END
GO

-- Set Profile Pic
CREATE PROCEDURE [EMPL_SetProfilePic]
	@employerID INT,
	@profilePic	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET [profilePic] = @profilePic
	WHERE [employerID] = @employerID
GO
