
-- Post New Job Procedure
CREATE PROCEDURE [dbo].[EMPL_PostNewJob]
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
;


-- Get All Posts Procedure
CREATE PROCEDURE [dbo].[EMPL_GetAllPosts] 
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
;


-- Get Limited Posts Procedure
CREATE PROCEDURE [dbo].[EMPL_GetPosts] 
	@offsetRows  INT,
	@fetchedRows INT,
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
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
		, [JobPosts].[industryType]
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
CREATE PROCEDURE [dbo].[EMPL_ViewPost]
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
;


-- UpdateJobPost Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdatePost]
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
;


-- Delete Job Post Procedure
CREATE PROCEDURE [dbo].[EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [dbo].[JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
;


-- Update Employer Information Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdateInfo]
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
;


-- View All Applicants Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewAllApplicants]
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, [JobSeekers].[brgyDistrict]
		, [JobSeekers].[cityMunicipality]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [Applications]
	INNER JOIN [JobSeekers]
	ON [JobSeekers].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobPostID] = @jobPostID
;


-- View Applicants Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, [JobSeekers].[brgyDistrict]
		, [JobSeekers].[cityMunicipality]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [Applications]
	INNER JOIN [JobSeekers]
	ON [JobSeekers].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobPostID] = @jobPostID
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;


-- View Applicant Profile Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewApplicantProfile]
	@jobseekerID INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[birthDate]
		, DATEDIFF(year, [JobSeekers].[birthDate], getdate()) as [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[street]
		, [JobSeekers].[brgyDistrict]
		, [JobSeekers].[cityMunicipality]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [JobSeekers].[description]
		, [JobSeekers].[skills]
		, [JobSeekers].[experiences]
		, [JobSeekers].[education]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [JobPosts].[jobTitle]
	FROM [dbo].[Applications]
	INNER JOIN [dbo].[JobSeekers]
	ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	INNER JOIN [dbo].[JobPosts]
	ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	AND [JobSeekers].[jobseekerID] = @jobseekerID
	AND [Applications].[jobPostID] = @jobPostID
;


SELECT * FROM Applications ORDER BY jobseekerID
