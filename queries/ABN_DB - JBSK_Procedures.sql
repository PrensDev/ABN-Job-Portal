
-- View Resume Procedure
CREATE PROCEDURE [JBSK_ViewResume]
	@jobseekerID INT
AS
	SELECT
		  [Resumes].[resumeID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[experiences]
		, [Resumes].[skills]
		, [Resumes].[lastUpdated]
		, CAST([Resumes].[resumeFlag] AS INT) AS [status]
		, [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, DATEDIFF(YEAR, [JobSeekers].[birthDate], GETDATE()) as [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
	FROM [Resumes]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
;

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
;

-- Remove Resume Procedure
CREATE PROCEDURE [JBSK_RemoveResume]
	@resumeID INT
AS
	DELETE FROM [Resumes] WHERE [resumeID] = @resumeID
;

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
;

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
;

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
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
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
;

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
		  [firstName] 		 = @firstName
		, [middleName] 		 = @middleName
		, [lastName] 		 = @lastName
		, [birthDate] 		 = @birthDate
		, [gender] 			 = @gender
		, [cityProvince] = @cityProvince
		, [contactNumber] 	 = @contactNumber
	WHERE [jobseekerID] = @jobseekerID
;

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
;

-- Cancel Application Procedure
CREATE PROCEDURE [JBSK_CancelApplication]
	@applicationID INT
AS
	DELETE FROM [Applications]
	WHERE [applicationID] = @applicationID
;


-- Number of Applied Jobs Procedure
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
	INNER JOIN [Resumes]
		ON [Applications].[jobseekerID] = [Resumes].[jobseekerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
;

-- Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AppliedJobsToStatus]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [Bookmarks].[bookmarkID]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	INNER JOIN [Resumes]
		ON [Applications].[jobseekerID] = [Resumes].[jobseekerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;

-- Number of Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AppliedJobsNum]
	@jobseekerID INT
AS
	SELECT COUNT([Applications].[JobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobseekerID] = @jobseekerID
;

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
;

-- Remove Bookmark Procedure
CREATE PROCEDURE [JBSK_RemoveBookmark]
	@bookmarkID INT
AS
	DELETE FROM [Bookmarks] WHERE [bookmarkID] = @bookmarkID
;

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
;

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
;

-- View Job Details 
CREATE PROCEDURE [JBSK_ViewJobDetails]
	@jobPostID	 INT,
	@jobseekerID INT
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
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
		, [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, [JobSeekers].[gender]
		, DATEDIFF(YEAR, [JobSeekers].[birthDate], GETDATE()) AS [age]
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
		, [Applications].[status]
		, [Applications].[dateStatus]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
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
		AND [JobPosts].[jobPostFlag] = 1
;

-- Set Profile Pic
CREATE PROCEDURE [JBSK_SetProfilePic]
	@jobseekerID INT,
	@profilePic	 VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET [profilePic] = @profilePic
	WHERE [jobseekerID] = @jobseekerID
;

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
;

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
		AND ([Employers].[brgyDistrict] LIKE '%' + @location + '%'
		OR [Employers].[cityProvince] LIKE '%' + @location + '%')
;

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
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
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
		AND ([Employers].[brgyDistrict] LIKE '%' + @location + '%'
		OR [Employers].[cityProvince] LIKE '%' + @location + '%')
	ORDER BY [JobPosts].[dateCreated]
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;

