
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


-- Get Posted Jobs Procedure
CREATE PROCEDURE [dbo].[EMPL_GetPosts] 
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
