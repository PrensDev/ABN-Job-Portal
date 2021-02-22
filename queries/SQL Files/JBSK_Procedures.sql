
-- Display all procedure //testing purposes

/*
SELECT 
  ROUTINE_NAME AS PROCEDURES
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE'
AND ROUTINE_NAME LIKE 'JBSK%'   
ORDER BY ROUTINE_NAME
*/

--------------------------------------------------------

USE [ABN_Job_Portal]
GO

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
		, CONVERT(INT, ROUND(DATEDIFF(hour, [birthDate], GETDATE())/8766.0,0)) AS [age]
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

-- Add Bookmark Procedure
CREATE PROCEDURE [JBSK_AddBookmark]
	@jobseekerID INT,
	@jobPostID	 INT
AS
	INSERT INTO [Bookmarks]
		( [jobseekerID]
		, [jobPostID] )
	VALUES 
		( @jobseekerID
		, @jobPostID )
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
