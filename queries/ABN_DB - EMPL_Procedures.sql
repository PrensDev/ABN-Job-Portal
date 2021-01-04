 
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
;

-- Get All Posts Procedure
CREATE PROCEDURE [EMPL_GetAllPosts] 
	@employerID INT
AS
	SELECT [jobPostID]
	FROM [JobPosts]
	WHERE [employerID] = @employerID
;

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
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, COUNT([Applications].[applicationID]) AS [numOfApplicants]
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
;

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
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, COUNT([Applications].[applicationID]) AS [numOfApplicants]
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
;

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
;

-- Delete Job Post Procedure
CREATE PROCEDURE [EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
;

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
;

-- View All Applicants Procedure
CREATE PROCEDURE [EMPL_ViewAllApplicants]
	@jobPostID   INT
AS
	SELECT [Applications].[applicationID]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [JobPosts].[jobPostID] = @jobPostID
	LEFT OUTER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
;

-- View Applicants Procedure
CREATE PROCEDURE [EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, DATEDIFF(YEAR, [JobSeekers].[birthDate], GETDATE()) as [age]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [JobPosts].[jobPostID] = @jobPostID
	LEFT OUTER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;

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
		, DATEDIFF(year, [JobSeekers].[birthDate], getdate()) as [age]
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
;

-- Number of Job Posts Procedure
CREATE PROCEDURE [EMPL_NumOfPosts]
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [postsNum]
	FROM JobPosts 
	WHERE employerID = @employerID
;

-- Set Applicant Status Procedure
CREATE PROCEDURE [EMPL_SetApplicantStatus]
	@applicationID INT,
	@status		   VARCHAR(MAX)
AS
	UPDATE [Applications]
	SET [status] = @status
	WHERE [applicationID] = @applicationID
;

-- Set Profile Pic
CREATE PROCEDURE [EMPL_SetProfilePic]
	@employerID INT,
	@profilePic	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET [profilePic] = @profilePic
	WHERE [employerID] = @employerID
;

SELECT * FROM UserAccounts
SELECT * FROM Employers
