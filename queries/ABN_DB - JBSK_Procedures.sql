
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
CREATE PROCEDURE [JBSK_ViewAllRecentPosts]
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
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
	UPDATE [JobSeekers]
	SET
		  [firstName] 		 = @firstName
		, [middleName] 		 = @middleName
		, [lastName] 		 = @lastName
		, [birthDate] 		 = @birthDate
		, [gender] 			 = @gender
		, [street] 			 = @street
		, [brgyDistrict] 	 = @brgyDistrict
		, [cityMunicipality] = @cityMunicipality
		, [contactNumber] 	 = @contactNumber
		, [description]		 = @description
		, [skills] 			 = @skills
		, [experiences] 	 = @experiences
		, [education] 		 = @education
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
	VALUES 
		( @jobPostID
		, ( SELECT [jobseekerID]	FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [headline]		FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [description]	FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [education]		FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [skills]			FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [experiences]	FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [resumeFile]		FROM [Resumes] WHERE [resumeID] = @resumeID )
		, ( SELECT [lastUpdated]	FROM [Resumes] WHERE [resumeID] = @resumeID )
		)
;

-- Cancel Application Procedure
CREATE PROCEDURE [JBSK_CancelApplication]
	@applicationID INT
AS
	DELETE FROM [Applications]
	WHERE [applicationID] = @applicationID
;



-- All Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AllAppliedJobs]
	@jobseekerID INT
AS
	SELECT [JobPosts].[jobPostID]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	INNER JOIN [Resumes]
		ON [Applications].[jobseekerID] = [Resumes].[jobseekerID]
		AND [Resumes].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
;

-- Applied Jobs Procedure
CREATE PROCEDURE [JBSK_AppliedJobs]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT
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
		AND [Resumes].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;

-- Number of Applied Jobs Procedure
CREATE PROCEDURE [JBSK_NumOfAppliedJobs]
	@jobseekerID INT
AS
	SELECT COUNT([Applications].[JobPostID]) AS [appliedJobsNum]
	FROM [Applications]
	INNER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
		AND [Resumes].[jobseekerID] = @jobseekerID
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

-- Get All Bookmarks
CREATE PROCEDURE [JBSK_GetAllBookmarks]
	@jobseekerID INT
AS
	SELECT [Bookmarks].[bookmarkID]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
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
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [Bookmarks].[dateBookmarked] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROW ONLY
;

-- Number of Bookmarks
CREATE PROCEDURE [JBSK_NumOfBookmarks]
	@jobseekerID INT
AS
	SELECT COUNT([bookmarkID]) AS [bookmarksNum]
	FROM [Bookmarks]
	WHERE [jobseekerID] = @jobseekerID
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
		AND [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[jobPostFlag] = 1
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
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
		AND [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	LEFT OUTER JOIN [Resumes]
		ON [Resumes].[resumeID] = [Applications].[resumeID]
		AND [Resumes].[resumeID] = @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
