 
-- Post New Job Procedure
CREATE PROCEDURE [EMPL_PostNewJob]
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
	INSERT INTO [JobPosts]
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
	-- AND [Applications].[status]  != 'Rejected'
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
CREATE PROCEDURE [EMPL_ViewPost]
	@jobPostID	INT,
	@employerID INT
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
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, COUNT([Applications].[applicationID]) AS [numOfApplicants]
	FROM [JobPosts]
	FULL OUTER JOIN [Applications]
	ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [JobPosts].[jobPostID] = @jobPostID 
	AND [JobPosts].[employerID] = @employerID
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
		, [JobPosts].[dateModified]
		, [JobPosts].[jobPostFlag]
;


-- UpdateJobPost Procedure
CREATE PROCEDURE [EMPL_UpdatePost]
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
	UPDATE [JobPosts]
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
CREATE PROCEDURE [EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
;


-- Update Employer Information Procedure
CREATE PROCEDURE [EMPL_UpdateInfo]
	@employerID			INT,
	@companyName		VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@website			VARCHAR(MAX),
	@description		VARCHAR(MAX)
AS
	UPDATE [Employers]
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
CREATE PROCEDURE [EMPL_ViewAllApplicants]
	@jobPostID   INT
AS
	SELECT [Applications].[applicationID]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [JobSeekers].[jobseekerID] = [Applications].[jobseekerID]
		AND [Applications].[jobPostID] = @jobPostID
;


-- View Applicants Procedure
CREATE PROCEDURE [EMPL_ViewApplicants]
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
		AND [Applications].[jobPostID] = @jobPostID
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
	FROM [Applications]
		INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	INNER JOIN [JobPosts]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
		AND [Applications].[jobPostID] = @jobPostID
;


-- Number of Job Posts Procedure
CREATE PROCEDURE [EMPL_NumOfPosts]
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [postsNum]
	FROM JobPosts 
	WHERE employerID = @employerID
;


-- Hire Applicant Procedure
CREATE PROCEDURE [EMPL_HireApplicant]
	@applicationID INT
AS
	UPDATE [Applications]
	SET [status] = 'Hired'
	WHERE [applicationID] = @applicationID
;


-- Reject Applicant Procedure
CREATE PROCEDURE [EMPL_RejectApplicant]
	@applicationID INT
AS
	UPDATE [Applications]
	SET [status] = 'Rejected'
	WHERE [applicationID] = @applicationID
;


-- Cancel Hiring or Rejecting Procedure
CREATE PROCEDURE [EMPL_CancelHiringOrRejecting]
	@applicationID INT
AS
	UPDATE [Applications]
	SET [status] = 'Pending'
	WHERE [applicationID] = @applicationID
;
